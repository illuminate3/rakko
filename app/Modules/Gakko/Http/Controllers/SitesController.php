<?php namespace HR\controllers;

use HR\models\Site as Site;
use View, Input, Validator, Redirect;
use Bootstrap;
use Image;

class SitesController extends \BaseController {

	/**
	 * Site Repository
	 *
	 * @var Site
	 */
	protected $sites;

	public function __construct(Site $site)
	{
		$this->site = $site;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//		$sites = $this->site->all();
//		$sites = Site::with('division', 'user')->get();
		$sites = $this->site->with('division', 'user')->get();
//		$sites = Site::with('division')->get();
//$sites['user_id']
//$user = $this->site->getUser($sites[0]['user_id']);

//		return View::make('sites.index', compact('sites'));
		return View::make('sites.index', compact(
			'sites'
		));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
//		return View::make('sites.create');


$divisions = $this->site->getDivisions();
$divisions = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.division')) + $divisions;

$contacts = $this->site->getContacts();
$contacts = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::general.contact')) + $contacts;

$statuses = $this->site->getStatuses();
$statuses = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::general.status')) + $statuses;

		return View::make(
			'sites.create',
			compact(
				'site', 'logo', 'divisions', 'contacts', 'statuses'
			)
		);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Site::$rules);

		if ($validation->passes())
		{

			$logo = Input::file('logo');
			if ($logo) {
				$input['logo'] = Image::upload($logo);
			} else {
				$input['logo'] = '';
			}

			$this->site->create($input);

			return Redirect::route('sites.index');
		}

		return Redirect::route('sites.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$site = $this->site->with('profiles')->findOrFail($id);
//		$site = $this->site->findOrFail($id);
//dd($site->user_id);
$contact = $this->site->getContactUser($site->user_id);
//dd($contact);

//$user = User::with('roles')->find($id);//eager loading
//$expiredRoles = array();

/*
foreach($site->profiles as $profile){//allready loaded
echo $profile;
}
die;
*/


		$profiles = Site::findOrFail($id)->profiles;
//$profiles = Site::has('profiles')->get();
//$profiles = Site::find($id)->profiles;

//echo $site->present()->profiles();
//die;
//dd($profiles);

		if ($site->logo) {
			$logo = Image::getPaths($site->logo);
		} else {
			$logo = null;
		}

//		return View::make('sites.show', compact('site'));
		return View::make(
			'sites.show',
			compact(
				'site', 'profiles', 'logo', 'contact'
//				'site', 'logo'
			)
		);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$site = $this->site->find($id);

		if (is_null($site))
		{
			return Redirect::route('sites.index');
		}

if ($site->logo) {
	$logo = Image::getPaths($site->logo);
} else {
	$logo = '';
}


$divisions = $this->site->getDivisions();
$divisions = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.division')) + $divisions;

$contacts = $this->site->getContacts();
$contacts = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::general.contact')) + $contacts;

$statuses = $this->site->getStatuses();
$statuses = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::general.status')) + $statuses;


//		return View::make('sites.edit', compact('site'));
		return View::make(
			'sites.edit',
			compact(
				'site', 'logo', 'divisions', 'contacts', 'statuses'
			)
		);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method', 'logo');
		$validation = Validator::make($input, Site::$rulesUpdate);

		if ($validation->passes())
		{

			if (Input::hasFile('logo'))
			{
				$input['logo'] = Image::upload(Input::file('logo'));
			} else {
				$input['logo'] = Input::get('logo');
			}

			if ( Input::get('user_id') == '' ) {
				$input['user_id'] = '1';
			}
			if ( Input::get('division_id') == '' ) {
				$input['division_id'] = '1';
			}
			if ( Input::get('status_id') == '' ) {
				$input['status_id'] = '0';
			}

			$sites = $this->site->find($id);
			$sites->update($input);

			return Redirect::route('sites.show', $id);
		}

		return Redirect::route('sites.edit', $id)
			->withInput()
			->withErrors($validation)
//			->with('message', 'There were validation errors.');
			->withMessage(Bootstrap::danger( trans('lingos::general.error.update'), true, true));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->site->find($id)->delete();

		return Redirect::route('sites.index');
	}

	/**
	 * @return mixed
	 */
	public function getDatatable()
	{
//		$query = User::select('email', 'id', 'created_at')->remember(10)->get();

		return Datatable::collection(Site::all())
//		return Datatable::collection($query)
			->showColumns('id')

			->addColumn('name',
				function($model) {
					return $model->present()->email();
				})

			->addColumn('roles',
				function($model) {
					return $model->present()->roles();
				})

			->addColumn('actions',
				function($model) {
/*
				$modal =
					'<div class="modal fade" id="delete-Record-'.$model->id.'">
						'.Form::open(array("route" => array("users.destroy", $model->id), "method" => "delete")).'
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . trans('lingos::general.close') . '</span></button>
										<h4 class="modal-title">' . trans('lingos::account.ask.delete') . '</h4>
									</div>
									<div class="modal-body">
										<p>' . trans('lingos::account.ask.delete') . '<b>'.$model->id.'</b></p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">' . trans('lingos::button.no') . '</button>
										<button type="submit" class="btn btn-success" name="deleteRecord">' . trans('lingos::button.yes') . '</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						'.Form::close().'
					</div><!-- /.modal -->';
*/
				$modal =
					'<div class="modal fade" id="delete-Record-'.$model->id.'">
						'.Form::open(array("route" => array("users.destroy", $model->id), "method" => "delete")).'
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . trans('lingos::general.close') . '</span></button>
										<h4 class="modal-title">' . trans('lingos::account.ask.delete') . '</h4>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">' . trans('lingos::button.no') . '</button>
										<button type="submit" class="btn btn-success" name="deleteRecord">' . trans('lingos::button.yes') . '</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						'.Form::close().'
					</div><!-- /.modal -->';
				return
					'<a href="/users/' . $model->id . '" class="btn btn-primary form-group" title="' . trans('lingos::general.view') . '"><i class="fa fa-chevron-right fa-fw"></i>' . trans('lingos::button.view') . '</a>&nbsp;'
					. '<a href="/users/' . $model->id . '/edit" class="btn btn-success form-group" title="' . trans('lingos::account.command.edit') . '"><i class="fa fa-edit fa-fw"></i>' . trans('lingos::button.edit') . '</a>&nbsp;'
					. Form::button('<span class="glyphicon glyphicon-trash"></span> ' . trans('lingos::button.delete'), array('name'=>'deleteRecord', 'class' => 'btn btn-danger', 'type' => 'button',  'data-toggle' => 'modal', 'data-target' => '#delete-Record-'.$model->id))
					. $modal;
				})

			->searchColumns('email')
			->orderColumns('id','email', 'created_at')
			->make();
	}

}
