<?php

namespace App\Http\Controllers\Audit;

use App\Http\Requests;
use App\Http\Requests\Audit\CreateReffActivityRequest;
use App\Http\Requests\Audit\UpdateReffActivityRequest;
use App\Repositories\Audit\ReffActivityRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Audit\ReffActivity;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ReffActivityController extends InfyOmBaseController
{
    /** @var  ReffActivityRepository */
    private $reffActivityRepository;

    public function __construct(ReffActivityRepository $reffActivityRepo)
    {
        $this->reffActivityRepository = $reffActivityRepo;
    }

    /**
     * Display a listing of the ReffActivity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->reffActivityRepository->pushCriteria(new RequestCriteria($request));
        $reffActivities = $this->reffActivityRepository->all();
        return view('admin.audit.reffActivities.index')
            ->with('reffActivities', $reffActivities);
    }

    /**
     * Show the form for creating a new ReffActivity.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.audit.reffActivities.create');
    }

    /**
     * Store a newly created ReffActivity in storage.
     *
     * @param CreateReffActivityRequest $request
     *
     * @return Response
     */
    public function store(CreateReffActivityRequest $request)
    {
        $get = collect(\DB::select("SELECT max(id::int) as max_id FROM reff_activity"))->first();

        $Client = new ReffActivity();
        $Client->id =  $get->max_id+1;
        $Client->definition = $request->input('definition');
        $Client->is_active = $request->input('is_active');
        $Client->save();

        // $reffActivity = $this->reffActivityRepository->create($input);

        Flash::success('ReffActivity saved successfully.');

        return redirect(route('admin.audit.reffActivities.index'));
    }

    /**
     * Display the specified ReffActivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reffActivity = $this->reffActivityRepository->findWithoutFail($id);

        if (empty($reffActivity)) {
            Flash::error('ReffActivity not found');

            return redirect(route('reffActivities.index'));
        }

        return view('admin.audit.reffActivities.show')->with('reffActivity', $reffActivity);
    }

    /**
     * Show the form for editing the specified ReffActivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $reffActivity = $this->reffActivityRepository->findWithoutFail($id);

        if (empty($reffActivity)) {
            Flash::error('ReffActivity not found');

            return redirect(route('reffActivities.index'));
        }

        return view('admin.audit.reffActivities.edit')->with('reffActivity', $reffActivity);
    }

    /**
     * Update the specified ReffActivity in storage.
     *
     * @param  int              $id
     * @param UpdateReffActivityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReffActivityRequest $request)
    {
        $reffActivity = $this->reffActivityRepository->findWithoutFail($id);



        if (empty($reffActivity)) {
            Flash::error('ReffActivity not found');

            return redirect(route('reffActivities.index'));
        }

        $reffActivity = $this->reffActivityRepository->update($request->all(), $id);

        Flash::success('ReffActivity updated successfully.');

        return redirect(route('admin.audit.reffActivities.index'));
    }

    /**
     * Remove the specified ReffActivity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.audit.reffActivities.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ReffActivity::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.audit.reffActivities.index'))->with('success', Lang::get('message.success.delete'));

       }

}
