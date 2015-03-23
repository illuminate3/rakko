<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Site;
use App\Modules\Gakko\Http\Domain\Repositories\SiteRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\SiteCreateRequest;
use App\Modules\Gakko\Http\Requests\SiteUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

use Datatables;
use Flash, Image;

use Config;

class SitesController extends GakkoController {

	/**
	 * Site Repository
	 *
	 * @var Site
	 */
	protected $request;
	protected $site;

	public function __construct(
			Request $request,
			SiteRepository $site
		)
	{
		$this->request = $request;
		$this->site = $site;

		$this->middleware('admin', ['only' => 'destroy']);
//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::sites.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::sites.create',  $this->site->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		SiteCreateRequest $request
		)
	{
		$save_path =  Config::get('general.image.logo_save');
		$show_path =  Config::get('general.image.logo_show');
		$resize_width =  Config::get('general.image.resize_width');
		$resize_height =  Config::get('general.image.resize_height');

		$file = time() . '-' . $request->file('newImage')->getClientOriginalName();

		$request->file('newImage')->move($save_path, $file);;

		$width = Image::make($save_path . $file)->width();
//dd($width);
		if ($width < $resize_width ) {
			$image = Image::make($save_path . $file)->resize($resize_width, $resize_height)->encode('data-url');
		} else {
// 			$image = Image::make($save_path . $file)->resize($resize_width, $resize_height, function ($constraint) {
// 					$constraint->aspectRatio();
// 				});
			$image = Image::make($save_path . $file)->fit($resize_height, $resize_width)->encode('data-url');
		}

		$image->save($save_path . $file);

		$this->site->update($request->all(), $id, $file, $show_path);
		$this->site->store($request->all(), $file, $show_path);

		Flash::success( trans('kotoba::hr.success.site_create') );
		return redirect('sites');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View('gakko::sites.show',  $this->site->show($id));
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
		$modal_route = 'sites.destroy';
		$modal_id = $id;
		$model = '$site';

		return View('gakko::sites.edit',
			$this->site->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
//		return View('gakko::sites.edit',  $this->site->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		SiteUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$save_path =  Config::get('general.image.logo_save');
		$show_path =  Config::get('general.image.logo_show');
		$resize_width =  Config::get('general.image.resize_width');
		$resize_height =  Config::get('general.image.resize_height');

		$file = time() . '-' . $request->file('newImage')->getClientOriginalName();

		$request->file('newImage')->move($save_path, $file);;

		$width = Image::make($save_path . $file)->width();
//dd($width);
		if ($width < $resize_width ) {
			$image = Image::make($save_path . $file)->resize($resize_width, $resize_height)->encode('data-url');
		} else {
// 			$image = Image::make($save_path . $file)->resize($resize_width, $resize_height, function ($constraint) {
// 					$constraint->aspectRatio();
// 				});
			$image = Image::make($save_path . $file)->fit($resize_height, $resize_width)->encode('data-url');
		}

		$image->save($save_path . $file);

		$this->site->update($request->all(), $id, $file, $show_path);

		Flash::success( trans('kotoba::hr.success.site_update') );
		return redirect('sites');
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

		return Redirect::route('admin.sites.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Site::select(array('sites.id','sites.name','sites.description'))
//			->orderBy('sites.name', 'ASC');
//		$query = Site::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Site::select('id', 'name', 'division_id', 'website', 'user_id');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

// 			-> edit_column(
// 				'division_id',
// 				'{{ $query->present()->divisionName(division_id) }}'
// 				)

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'sites/\' . $id . \'/\' ) }}" class="btn btn-info btn-sm" >
						<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
					</a>
					<a href="{{ URL::to(\'/sites/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data1()
	{
//dd("loaded");
/*
		'id',
		'name',
		'email',
		'phone_1',
		'phone_2',
		'website',
		'address',
		'city',
		'state',
		'zipcode',
		'logo',
		'division_id',
		'user_id',
		'ad_code',
		'bld_number',
		'status_id',
		'notes'
*/
		$sites = Site::select(array('sites.id','sites.name','sites.division_id','sites.website','sites.user_id'))
			->orderBy('sites.name', 'ASC');
//dd($sites);

		return Datatables::of($sites)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'sites/\' . $id . \'/\' ) }}" class="btn btn-info btn-sm" >
					<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
				</a>
				<a href="{{ URL::to(\'sites/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
					<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
				</a>
				')
/*
				<a href="{{ URL::to(\'admin/roles/\' . $id . \'/destroy\' ) }}" class="btn btn-sm btn-danger action_confirm" data-method="delete" title="{{ trans(\'kotoba::general.command.delete\') }}" onclick="">
					<span class="glyphicon glyphicon-trash"></span> {{ trans("kotoba::button.delete") }}
				</a>
*/

				->remove_column('id')

				->make();
	}


}
