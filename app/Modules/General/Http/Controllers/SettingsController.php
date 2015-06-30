<?php
namespace App\Modules\General\Http\Controllers;

use App\Modules\General\Http\Domain\Models\Setting as Model;
use App\Modules\General\Http\Domain\Repositories\SettingRepository;

use Illuminate\Http\Request;
use App\Modules\General\Http\Requests\DeleteRequest;
use App\Modules\General\Http\Requests\SettingCreateRequest;
use App\Modules\General\Http\Requests\SettingUpdateRequest;

use Datatables;
use Flash;
// use Form;
use Setting;
use Theme;

class SettingsController extends GeneralController {

	/**
	 * Setting Repository
	 *
	 * @var Setting
	 */
	protected $setting_repo;

	public function __construct(
			Model $model,
			SettingRepository $setting_repo
		)
	{
		$this->model = $model;
		$this->setting_repo = $setting_repo;
// middleware
		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$settings = $this->setting_repo->all();

		return Theme::View('general::settings.index', compact('settings'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('modules.general.settings.create',  $this->setting_repo->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		SettingCreateRequest $request
		)
	{
//dd($request);

//		$this->setting_repo->store($request);
		Setting::set( $request->key, $request->value );

		Flash::success( trans('kotoba::cms.success.setting_create') );
		return redirect('admin/settings');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$setting = $this->setting->findOrFail($id);
//
// 		return View::make('HR::settings.show', compact('setting'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($key)
	{
		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.settings.destroy';
		$modal_id = $key;
		$model = '$setting';
//dd($modal_body);

		return View('general::settings.edit',
			$this->setting_repo->edit($key),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		SettingUpdateRequest $request,
		$id
		)
	{
//dd($request);
//		$this->setting_repo->update($request->all(), $id);
		Setting::set( $request->key, $request->value );

		Flash::success( trans('kotoba::cms.success.setting_update') );
		return redirect('admin/settings');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->setting_repo->find($id)->delete();

		return Redirect::route('admin.settings.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Setting::select(array('settings.id','settings.name','settings.description'))
//			->orderBy('settings.name', 'ASC');
//		$query = Setting::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Setting::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/settings/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
