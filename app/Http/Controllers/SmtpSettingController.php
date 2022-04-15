<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSmtpSettingRequest;
use App\Http\Requests\UpdateSmtpSettingRequest;
use App\Repositories\SmtpSettingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\ActiveSmtp;
use App\Models\SmtpSetting;

class SmtpSettingController extends AppBaseController
{
    /** @var SmtpSettingRepository $smtpSettingRepository*/
    private $smtpSettingRepository;

    public function __construct(SmtpSettingRepository $smtpSettingRepo)
    {
        $this->smtpSettingRepository = $smtpSettingRepo;
    }

    /**
     * Display a listing of the SmtpSetting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $smtpSettings = SmtpSetting::withCount('activeSmtp as activeSmtp_count')->orderBy('activeSmtp_count', 'desc')->paginate(10);
        return view('smtp_settings.index')
            ->with(['smtpSettings' => $smtpSettings]);
    }

    /**
     * Show the form for creating a new SmtpSetting.
     *
     * @return Response
     */
    public function create()
    {
        return view('smtp_settings.create');
    }

    /**
     * Store a newly created SmtpSetting in storage.
     *
     * @param CreateSmtpSettingRequest $request
     *
     * @return Response
     */
    public function store(CreateSmtpSettingRequest $request)
    {
        $input = $request->all();

        $smtpSetting = $this->smtpSettingRepository->create($input);

        Flash::success('Smtp Setting saved successfully.');

        return redirect(route('smtpSettings.index'));
    }

    /**
     * Display the specified SmtpSetting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $smtpSetting = $this->smtpSettingRepository->find($id);

        if (empty($smtpSetting)) {
            Flash::error('Smtp Setting not found');

            return redirect(route('smtpSettings.index'));
        }

        return view('smtp_settings.show')->with('smtpSetting', $smtpSetting);
    }

    /**
     * Show the form for editing the specified SmtpSetting.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $smtpSetting = $this->smtpSettingRepository->find($id);

        if (empty($smtpSetting)) {
            Flash::error('Smtp Setting not found');

            return redirect(route('smtpSettings.index'));
        }

        return view('smtp_settings.edit')->with('smtpSetting', $smtpSetting);
    }

    /**
     * Update the specified SmtpSetting in storage.
     *
     * @param int $id
     * @param UpdateSmtpSettingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSmtpSettingRequest $request)
    {
        $smtpSetting = $this->smtpSettingRepository->find($id);

        if (empty($smtpSetting)) {
            Flash::error('Smtp Setting not found');

            return redirect(route('smtpSettings.index'));
        }

        $smtpSetting = $this->smtpSettingRepository->update($request->all(), $id);

        Flash::success('Smtp Setting updated successfully.');

        return redirect(route('smtpSettings.index'));
    }

    /**
     * Remove the specified SmtpSetting from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $smtpSetting = $this->smtpSettingRepository->find($id);

        if (empty($smtpSetting)) {
            Flash::error('Smtp Setting not found');

            return redirect(route('smtpSettings.index'));
        }

        $this->smtpSettingRepository->delete($id);

        Flash::success('Smtp Setting deleted successfully.');

        return redirect(route('smtpSettings.index'));
    }
    public function activate($id)
    {
        ActiveSmtp::updateOrCreate(
            ['id' => 1],
            ['smtp_setting_id' => $id]
        );
        return redirect()->route('smtpSettings.index');
    }
}
