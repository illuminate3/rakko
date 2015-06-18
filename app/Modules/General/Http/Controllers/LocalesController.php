<?php
namespace App\Modules\General\Http\Controllers;

use App\Modules\General\Http\Domain\Models\Locale;
use App\Modules\General\Http\Domain\Repositories\LocaleRepository;

use Illuminate\Http\Request;
use App\Modules\General\Http\Requests\DeleteRequest;
use App\Modules\General\Http\Requests\LocaleCreateRequest;
use App\Modules\General\Http\Requests\LocaleUpdateRequest;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

//use Datatables;
use Flash;
use Theme;


class LocalesController extends GeneralController {

	/**
	 * Locale Repository
	 *
	 * @var Locale
	 */
	protected $locale;

	public function __construct(
			LocaleRepository $locale
		)
	{
		$this->locale = $locale;
// middleware
//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$locales = $this->locale->all();
//dd($locales);

		return Theme::View('general::locales.index', compact('locales'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('general::locales.create',  $this->locale->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		LocaleCreateRequest $request
		)
	{
		$this->locale->store($request->all());

		Flash::success( trans('kotoba::hr.success.locale_create') );
		return redirect('admin/locales');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$locale = $this->locale->findOrFail($id);
//
// 		return View::make('HR::locales.show', compact('locale'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.locales.destroy';
		$modal_id = $id;
		$model = '$locale';
//dd($modal_body);

		return View('general::locales.edit',
//		return Theme::View('general::locales.edit',
			$this->locale->edit($id),
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
		LocaleUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->locale->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.locale_update') );
		return redirect('admin/locales');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->locale->find($id)->delete();

		return Redirect::route('admin.locales.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Locale::select(array('general::locales.id','general::locales.name','general::locales.description'))
//			->orderBy('general::locales.name', 'ASC');
//		$query = Locale::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Locale::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/locales/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
