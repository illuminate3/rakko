<?php namespace App\Modules\Kagi\Http\Controllers;

use App\Modules\Kagi\Http\Controllers\KagiController;
use App\User;
use App\Modules\Kagi\Http\Domain\AssignedRoles;
use App\Modules\Kagi\Http\Domain\Role;
//use Bllim\Datatables\Facade\Datatables;
//use App\Modules\Kagi\Http\Requests\UserRequest;
use App\Modules\Kagi\Http\Requests\UserEditRequest;
use App\Modules\Kagi\Http\Requests\DeleteRequest;

use View, Form;
use Datatable;
/*
use Vedette\models\User as User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Input, Redirect, Config, Validator, Hash, Auth;
use Bootstrap;
*/
class UsersController extends KagiController {

	protected $user;

	public function __construct(User $user)
	{
//		parent::__construct();
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->all();
//dd($users);
//		return View('kagi::users.index');
		return View::make('kagi::users.index')
			->with(compact("users"));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make(
			Config::get('vedette.vedette_views.users_create')
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

		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{

			$user = new User;
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->save();

			if ( empty($input['roles']) ) $input['roles'] = array();
			$user->roles()->sync($input['roles']);

if ( Config::get('vedette.vedette_settings.add_profile') == True ) {
	return Redirect::route(Config::get('vedette.vedette_routes.add_profile'))->with('email', $user->email);
//		->withMessage(Bootstrap::success(trans('kotoba::account.success.create'), true, true));
} else {
	return Redirect::route('users.index')
		->withMessage(Bootstrap::success(trans('kotoba::account.success.create'), true, true));
}

		}

		return Redirect::route('users.create')
			->withInput()
			->withErrors($validation)
			->withMessage(Bootstrap::danger( trans('kotoba::account.error.create'), true, true));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
//		$user = $this->user->findOrFail($id);

		$user = $this->user->with('profile')->findOrFail($id);
		return View::make(
			Config::get('vedette.vedette_views.users_show')
			)->with(compact('user'));

/*
try
{
		$user = $this->user->with('profile')->findOrFail($id);

		return View::make(
			Config::get('vedette.vedette_views.users_show')
			)->with(compact('user'));
}
catch (ModelNotFoundException $e)
{
	$error = Lang::get('message.error.user');
	// Redirect to the user index
	return Redirect::route('users.index')->withInput()->with('error', $error);
}
*/

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->findOrFail($id);

		return View::make(
			Config::get('vedette.vedette_views.users_edit')
			)->with(compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 *
	 * @return Response
	 */
	public function update($id)
	{

		if ( !Auth::User()->hasRoleWithName('Admin') ) {
			return Redirect::to('/')
				->withMessage(Bootstrap::danger( trans('kotoba::general.error.forbidden'), true, true));
		}

		$input = array_except(Input::all(), '_method');

		$validation = Validator::make($input, User::$rulesUpdate);

/*
		if( $validation->passes() ) {
			$user = Sentry::getUserProvider()->findById($id);
			$user->fill($validation->getData());
//dd($user);
			if (Input::has('activated')) {
				if ($user->isActivated()) {
				$user->activated = 1;
				$user->activated_at = $user->last_login;
				} else {
					$sentryUser = Sentry::getUserProvider()->findById($id);
					$activationCode = $sentryUser->getActivationCode();
//dd($activationCode);
					$user->attemptActivation($activationCode);
				}
			} else {
				$user->activated = 0;
				$user->activated_at = null;
			}

// update throttle
			$throttle = Sentry::getThrottleProvider()->findByUserId($id);

			if (Input::has('suspended')) {
// Suspend the user
				$throttle->suspend();
			} else {
// Suspend the user
				$throttle->unsuspend();
			}

// update ban
			if (Input::has('banned')) {
// Ban the user
				$throttle->ban();
			} else {
// Ban the user
				$throttle->unBan();
			}

			$user->save();
*/



		if ($validation->passes())
		{

			$user = User::findOrFail($id);

			$user->email = $input['email'];
			if ( ! empty($input['password']) && $input['password'] == $input['password_confirmation'])
			{
				$user->password = Hash::make($input['password']);
			}
			$user->save();

			if (empty($input['roles'])) $input['roles'] = array();
			$user->roles()->sync($input['roles']);

			return Redirect::route('users.index')
				->withMessage(Bootstrap::success( trans('kotoba::account.success.update'), true, true));

		}

		return Redirect::route('users.edit', $id)
			->withInput()
			->withErrors($validation)
			->withMessage(Bootstrap::danger( trans('kotoba::role.error.update'), true, true));


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param integer $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
//dd('stop!');
		$user = $this->user->findOrFail($id);

//dd($user);
		$user->delete();

if ( Config::get('vedette.vedette_settings.add_profile') == True ) {
	$this->user->deleteUserProfile($user['user_id']);
}

		if ($id == Auth::user()->id)
		{
			Auth::logout();
		}

		return Redirect::route('users.index')->withMessage(Bootstrap::success( trans('kotoba::account.success.delete'), true, true));
	}

	/**
	 * @return mixed
	 */
	public function getDatatable()
	{
//dd('loaded');

//		$query = User::select('email', 'id', 'created_at')->remember(10)->get();

		return Datatable::collection(User::all())
//		return Datatable::collection($query)
			->showColumns('id')

			->addColumn('email',
				function($model) {
//					return $model->present()->email();
					return 'email';
				})

			->addColumn('roles',
				function($model) {
//					return $model->present()->roles();
					return 'role';
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
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . trans('kotoba::general.close') . '</span></button>
										<h4 class="modal-title">' . trans('kotoba::account.ask.delete') . '</h4>
									</div>
									<div class="modal-body">
										<p>' . trans('kotoba::account.ask.delete') . '<b>'.$model->id.'</b></p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">' . trans('kotoba::button.no') . '</button>
										<button type="submit" class="btn btn-success" name="deleteRecord">' . trans('kotoba::button.yes') . '</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						'.Form::close().'
					</div><!-- /.modal -->';
*/
				$modal =
					'<div class="modal fade" id="delete-Record-'.$model->id.'">
						'.Form::open(array("route" => array("admin.users.destroy", $model->id), "method" => "delete")).'
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . trans('kotoba::general.close') . '</span></button>
										<h4 class="modal-title">' . trans('kotoba::account.ask.delete') . '</h4>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">' . trans('kotoba::button.no') . '</button>
										<button type="submit" class="btn btn-success" name="deleteRecord">' . trans('kotoba::button.yes') . '</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						'.Form::close().'
					</div><!-- /.modal -->';
				return
					'<a href="/users/' . $model->id . '" class="btn btn-primary form-group" title="' . trans('kotoba::general.view') . '"><i class="fa fa-chevron-right fa-fw"></i>' . trans('kotoba::button.view') . '</a>&nbsp;'
					. '<a href="/users/' . $model->id . '/edit" class="btn btn-success form-group" title="' . trans('kotoba::account.command.edit') . '"><i class="fa fa-edit fa-fw"></i>' . trans('kotoba::button.edit') . '</a>&nbsp;'
					. Form::button('<span class="glyphicon glyphicon-trash"></span> ' . trans('kotoba::button.delete'), array('name'=>'deleteRecord', 'class' => 'btn btn-danger', 'type' => 'button',  'data-toggle' => 'modal', 'data-target' => '#delete-Record-'.$model->id))
					. $modal;
				})

			->searchColumns('email', 'roles')
			->orderColumns('id','email', 'created_at')
			->make();
	}

}
