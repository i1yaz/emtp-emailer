<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Repositories\EmailRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Flash;
use Response;

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
        $emails = $this->emailRepository->paginate(10);

        return view('emails.index')
            ->with('emails', $emails);
    }

    /**
     * Show the form for creating a new Email.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::get();
        return view('emails.create', compact('users'));
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
        $input = $request->all();

        $email = $this->emailRepository->create($input);

        Flash::success('Email saved successfully.');

        return redirect(route('emails.index'));
    }

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
