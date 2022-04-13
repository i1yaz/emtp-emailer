<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Repositories\EmailRepository;
use App\Http\Controllers\AppBaseController;
use App\Jobs\SendEmailJob;
use App\Models\Contact;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Str;

class EmailController extends AppBaseController
{
    /** @var EmailRepository $emailRepository*/
    private $emailRepository;

    public function __construct(EmailRepository $emailRepo)
    {
        $this->emailRepository = $emailRepo;
    }

    /**
     * Display a listing of the Email.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $failedJobs = \DB::table('failed_jobs')->select('*')->paginate(10);
        return view('emails.index')
            ->with('failedJobs', $failedJobs);
    }

    // public function getFailedJob()
    // {
    //     #Fetch all the failed jobs
    //     $jobs = \DB::table('failed_jobs')->select('*')->get(10);
    //     $data = [];
    //     #Loop through all the failed jobs and format them for json printing
    //     foreach ($jobs as $job) {
    //         $jsonpayload = json_decode($job->payload);
    //         $payloadCommand = unserialize($jsonpayload->data->command);
    //         $user = $payloadCommand->data['user'];
    //         $exception  = explode("\n", $job->exception);
    //         $data['jsonpayload'] = $jsonpayload;
    //         $data['user'] = $user;
    //         $data['exception'] = $exception;
    //     }
    //     return $data;
    // }

    /**
     * Show the form for creating a new Email.
     *
     * @return Response
     */
    public function create()
    {
        $contact = [];
        $contacts = Contact::get();
        foreach ($contacts as  $value) {
            $contact[$value->id] = $value->email;
        }
        return view('emails.create', compact('contact'));
    }

    /**
     * Store a newly created Email in storage.
     *
     * @param CreateEmailRequest $request
     *
     * @return Response
     */
    public function store(CreateEmailRequest $request)
    {
        $data = [];
        $contacts = Contact::find($request->to);
        $subject = $request->subject;
        $body = bodyImageUpload($request->body);
        $attachments = attachmentUpload($request);
        foreach ($contacts as  $contact) {
            $vars = array(
                "{{{first_name}}}" => $contact->first_name,
                "{{{last_name}}}" => $contact->last_name,
                "{{{recipient_name}}}" => $contact->recipient_name,
                "{{{email}}}" => $contact->email,
                "{{{phone}}}" => $contact->phone,
            );
            $body = strtr($body, $vars);
            $data['body'] =  $body;
            $data['contact'] =  $contact;
            $data['subject'] =  $subject;
            $data['attachments'] =  $attachments;
            dispatch(new SendEmailJob($data));
        }


        Flash::success('Email saved successfully.');

        return redirect(route('emails.index'));
    }
    // public function attachmentUpload($request)
    // {
    //     $files = [];
    //     if ($request->has('attachments')) {
    //         //Year in YYYY format.
    //         $year = date("Y");

    //         //Month in mm format, with leading zeros.
    //         $month = date("m");

    //         //Day in dd format, with leading zeros.
    //         $day = date("d");
    //         //The folder path for our file should be YYYY/MM/DD
    //         $directory = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR) . $year . DIRECTORY_SEPARATOR . $month . DIRECTORY_SEPARATOR . $day . DIRECTORY_SEPARATOR;
    //         //If the directory doesn't already exists.
    //         if (!is_dir($directory)) {
    //             //Create our directory.
    //             mkdir($directory, 755, true);
    //         }

    //         foreach ($request->file('attachments') as $attachment) {
    //             $extension = $attachment->getClientOriginalExtension();
    //             $random = Str::random(20);
    //             $path = Storage::putFileAs("public/$year/$month/$day", $attachment, $random . "." . $extension);
    //             $path = Storage::url($path);
    //             $files[] = url($path);
    //         }
    //     }
    //     return $files;
    // }
    // public function bodyImageUpload($content)
    // {
    //     try {
    //         $dom = new \DomDocument();
    //         $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    //         $imageFile = $dom->getElementsByTagName('imageFile');

    //         foreach ($imageFile as $item => $image) {
    //             $data = $image->getAttribute('src');
    //             list($type, $data) = explode(';', $data);
    //             list(, $data)      = explode(',', $data);
    //             $imgeData = base64_decode($data);
    //             $image_name = "/upload/" . time() . $item . '.png';
    //             $path = public_path() . $image_name;
    //             file_put_contents($path, $imgeData);

    //             $image->removeAttribute('src');
    //             $image->setAttribute('src', $image_name);
    //         }

    //         return $dom->saveHTML();
    //     } catch (\Throwable $th) {
    //         return $content;
    //     }
    //     return $content;
    // }

    /**
     * Display the specified Email.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            Flash::error('Email not found');

            return redirect(route('emails.index'));
        }

        return view('emails.show')->with('email', $email);
    }

    /**
     * Show the form for editing the specified Email.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            Flash::error('Email not found');

            return redirect(route('emails.index'));
        }

        return view('emails.edit')->with('email', $email);
    }

    /**
     * Update the specified Email in storage.
     *
     * @param int $id
     * @param UpdateEmailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmailRequest $request)
    {
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            Flash::error('Email not found');

            return redirect(route('emails.index'));
        }

        $email = $this->emailRepository->update($request->all(), $id);

        Flash::success('Email updated successfully.');

        return redirect(route('emails.index'));
    }

    /**
     * Remove the specified Email from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            Flash::error('Email not found');

            return redirect(route('emails.index'));
        }

        $this->emailRepository->delete($id);

        Flash::success('Email deleted successfully.');

        return redirect(route('emails.index'));
    }
}
