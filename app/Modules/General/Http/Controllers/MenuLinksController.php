<?php
namespace App\Modules\General\Http\Controllers;

use App\Modules\General\Http\Domain\Models\Menu;
use App\Modules\General\Http\Domain\Repositories\MenuRepository;
use App\Modules\General\Http\Domain\Models\MenuLink;
use App\Modules\General\Http\Domain\Repositories\MenuLinkRepository;

use Illuminate\Http\Request;
use App\Modules\General\Http\Requests\DeleteRequest;
use App\Modules\General\Http\Requests\MenuLinkCreateRequest;
use App\Modules\General\Http\Requests\MenuLinkUpdateRequest;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

//use Datatables;
use Flash;
use Lang;
use Session;
use Theme;


class MenuLinksController extends GeneralController {


	/**
	 * MenuLink Repository
	 *
	 * @var Menu
	 */
	protected $menulink;

	public function __construct(
			MenuLinkRepository $menulink,
			MenuRepository $menu
		)
	{
		$this->menulink = $menulink;
		$this->menu = $menu;
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
//		$menulinks = $this->menulink->all();
		$links = MenuLink::with('menu')->get();
		$lang = Session::get('locale');
		$locales = $this->menu->getLocales();

		return Theme::View('general::menulinks.index', compact('links', 'locales', 'lang'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$lang = Session::get('locale');
		$locales = $this->menulink->getLocales();
		$menus = $this->menu->all()->lists('name', 'id');
		$menus = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::cms.menu', 1)) + $menus;

		return Theme::View('general::menulinks.create',
			compact(
				'lang',
				'locales',
				'menus'
			));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		MenuLinkCreateRequest $request
		)
	{
//dd($request);
//dd($request->menu_id);
		$this->menulink->store($request->all());

		Flash::success( trans('kotoba::cms.success.menulink_create') );
		return redirect('admin/menulinks/' . $request->menu_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Theme::View('general::menulinks.index',  $this->menulink->show($id));
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
		$modal_route = 'admin.menulinks.destroy';
		$modal_id = $id;
		$model = '$menulink';
//dd($id);

//		return Theme::View('general::menulinks.edit',
		return View('general::menulinks.edit',
			$this->menulink->edit($id),
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
		MenuLinkUpdateRequest $request,
		$id
		)
	{
//dd($request->menu_id);
		$this->menulink->update($request->all(), $id);

		Flash::success( trans('kotoba::cms.success.menulink_update') );
		return redirect('admin/menulinks/' . $request->menu_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->menulink->find($id)->delete();


		Flash::success( trans('kotoba::cms.success.menulink_delete') );
		return redirect('admin/menus');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Menu::select(array('menulinks.id','menus.name','menus.description'))
//			->orderBy('menus.name', 'ASC');
//		$query = Menu::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = MenuLink::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/menulinks/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}

	public function save()
	{
//dd(Input::get('json'));
		$this->menulink->changeParentById($this->menulink->parseJsonArray(json_decode(Input::get('json'), true)));
		return Response::json(array('result' => 'success'));
	}



}
