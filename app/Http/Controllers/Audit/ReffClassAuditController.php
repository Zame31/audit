<?php

namespace App\Http\Controllers\Audit;

use App\Http\Requests;
use App\Http\Requests\Audit\CreateReffClassAuditRequest;
use App\Http\Requests\Audit\UpdateReffClassAuditRequest;
use App\Repositories\Audit\ReffClassAuditRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Audit\ReffClassAudit;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ReffClassAuditController extends InfyOmBaseController
{
    /** @var  ReffClassAuditRepository */
    private $reffClassAuditRepository;

    public function __construct(ReffClassAuditRepository $reffClassAuditRepo)
    {
        $this->reffClassAuditRepository = $reffClassAuditRepo;
    }

    /**
     * Display a listing of the ReffClassAudit.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->reffClassAuditRepository->pushCriteria(new RequestCriteria($request));
        $reffClassAudits = $this->reffClassAuditRepository->all();
        return view('admin.audit.reffClassAudits.index')
            ->with('reffClassAudits', $reffClassAudits);
    }

    /**
     * Show the form for creating a new ReffClassAudit.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.audit.reffClassAudits.create');
    }

    /**
     * Store a newly created ReffClassAudit in storage.
     *
     * @param CreateReffClassAuditRequest $request
     *
     * @return Response
     */
    public function store(CreateReffClassAuditRequest $request)
    {

      $get = collect(\DB::select("SELECT max(id::int) as max_id FROM reff_class_audit"))->first();

      $Client = new ReffClassAudit();
      $Client->id =  $get->max_id+1;
      $Client->definition = $request->input('definition');
      $Client->is_active = $request->input('is_active');
      $Client->save();

        // $input = $request->all();
        //
        // $reffClassAudit = $this->reffClassAuditRepository->create($input);

        Flash::success('ReffClassAudit saved successfully.');

        return redirect(route('admin.audit.reffClassAudits.index'));
    }

    /**
     * Display the specified ReffClassAudit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reffClassAudit = $this->reffClassAuditRepository->findWithoutFail($id);

        if (empty($reffClassAudit)) {
            Flash::error('ReffClassAudit not found');

            return redirect(route('reffClassAudits.index'));
        }

        return view('admin.audit.reffClassAudits.show')->with('reffClassAudit', $reffClassAudit);
    }

    /**
     * Show the form for editing the specified ReffClassAudit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reffClassAudit = $this->reffClassAuditRepository->findWithoutFail($id);

        if (empty($reffClassAudit)) {
            Flash::error('ReffClassAudit not found');

            return redirect(route('reffClassAudits.index'));
        }

        return view('admin.audit.reffClassAudits.edit')->with('reffClassAudit', $reffClassAudit);
    }

    /**
     * Update the specified ReffClassAudit in storage.
     *
     * @param  int              $id
     * @param UpdateReffClassAuditRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReffClassAuditRequest $request)
    {
        $reffClassAudit = $this->reffClassAuditRepository->findWithoutFail($id);



        if (empty($reffClassAudit)) {
            Flash::error('ReffClassAudit not found');

            return redirect(route('reffClassAudits.index'));
        }

        $reffClassAudit = $this->reffClassAuditRepository->update($request->all(), $id);

        Flash::success('ReffClassAudit updated successfully.');

        return redirect(route('admin.audit.reffClassAudits.index'));
    }

    /**
     * Remove the specified ReffClassAudit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.audit.reffClassAudits.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ReffClassAudit::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.audit.reffClassAudits.index'))->with('success', Lang::get('message.success.delete'));

       }

}
