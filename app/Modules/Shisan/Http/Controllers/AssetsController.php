<?php
namespace App\Modules\Shisan\Http\Controllers;


class AssetsController extends ShisanController {

	/**
	 * Asset Repository
	 *
	 * @var Asset
	 */
	protected $asset;

	public function __construct(Asset $asset)
	{
		$this->asset = $asset;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$assets = $this->asset->all();

		return View::make('assets.index', compact('assets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$items = $this->asset->getItems();
		$items = array('' => 'Select an Item') + $items;
		$users = $this->asset->getUsers();
		$users = array('' => 'Select a User') + $users;
		$sites = $this->asset->getSites();
		$sites = array('' => 'Select a Site') + $sites;
		$rooms = $this->asset->getRooms();
		$rooms = array('' => 'Select a Room') + $rooms;
		$statuses = $this->asset->getStatuses();
		$statuses = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::general.status')) + $statuses;

//		return View::make('assets.create');
		return View::make('assets.create',
			compact('items', 'users', 'sites', 'statuses', 'rooms')
			);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
//		$input = Input::all();
		$input = array_except(Input::all(), ['_method']);

		$validation = Validator::make($input, Asset::$rules);

		if ($validation->passes())
		{
			$this->asset->create($input);



$id = DB::getPdo()->lastInsertId();

$item_id = Input::get('item_id');
$user_id = Input::get('user_id');
$site_id = Input::get('site_id');
$room_id = Input::get('room_id');

$this->asset->attachAsset($id, $item_id);
$this->asset->attachUser($id, $user_id);
$this->asset->attachSite($id, $site_id);
$this->asset->attachRoom($id, $room_id);




			return Redirect::route('asset.index');
		}

		return Redirect::route('asset.create')
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
		$asset = $this->asset->findOrFail($id);

		return View::make('assets.show', compact('asset'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$asset = $this->asset->find($id);

		$items = $this->asset->getItems();
		$items = array('' => 'Select an Item') + $items;
		$users = $this->asset->getUsers();
		$users = array('' => 'Select a User') + $users;
		$sites = $this->asset->getSites();
		$sites = array('' => 'Select a Site') + $sites;
		$rooms = $this->asset->getRooms();
		$rooms = array('' => 'Select a Room') + $rooms;
		$statuses = $this->asset->getStatuses();
		$statuses = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::general.status')) + $statuses;

		if (is_null($asset))
		{
			return Redirect::route('asset.index');
		}

//		return View::make('assets.edit', compact('asset'));
		return View::make('assets.edit',
			compact('asset', 'items', 'sites', 'users', 'statuses', 'rooms')
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
		$input = array_except(Input::all(), '_method');
//dd($input);
//		$input = array_except(Input::all(), ['_method', 'item_id', 'user_id', 'site_id', 'room_id']);
//dd($input);

		$validation = Validator::make($input, Asset::$rules);

		if ($validation->passes())
		{

//$category = Input::get('parent_id');
//$this->item->attachItem($id, $category);

//dd(Input::get('user_id'));
/*
			if ( Input::get('item_id') == '' ) {
				$input['item_id'] = Null;
			} else {
				$item_id = Input::get('item_id');
				$this->asset->detachAsset($id, $item_id);
				$this->asset->attachAsset($id, $item_id);
			}
			if ( Input::get('user_id') == '' ) {
				$input['user_id'] = Null;
			} else {
				$user_id = Input::get('user_id');
				$this->asset->detachUser($id, $user_id);
				$this->asset->attachUser($id, $user_id);
			}
			if ( Input::get('site_id') == '' ) {
				$input['site_id'] = Null;
			} else {
				$site_id = Input::get('site_id');
				$this->asset->detachSite($id, $site_id);
				$this->asset->attachSite($id, $site_id);
			}
			if ( Input::get('room_id') == '' ) {
				$input['room_id'] = Null;
			} else {
				$room_id = Input::get('room_id');
				$this->asset->detachRoom($id, $room_id);
				$this->asset->attachRoom($id, $room_id);
			}
/*

			$item_id = Input::get('item_id');
			$this->asset->syncAsset($id, $item_id);
			$user_id = Input::get('user_id');
			$this->asset->syncUser($id, $user_id);
			$site_id = Input::get('site_id');
			$this->asset->syncSite($id, $site_id);
			$room_id = Input::get('room_id');
			$this->asset->syncRoom($id, $room_id);
*/

//dd($input);

$category_id = Input::get('category_id');
$this->item->detachAsset($id, $category_id);
$this->item->attachAsset($id, $category_id);


			$asset = $this->asset->find($id);
			$asset->update($input);

			return Redirect::route('asset.show', $id);
		}

		return Redirect::route('asset.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->asset->find($id)->delete();

		return Redirect::route('asset.index');
	}


	/**
	 * @return mixed
	 */
	public function getDatatable()
	{
//dd('loaded');
/*
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `asset_status_id` int(11) DEFAULT NULL,
  `asset_tag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `po` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
*/


/*
		return Datatable::collection(
//			Item::all()
			Asset::remember(10)->get()
		)
*/
//		$query = Asset::remember(10)->get();
		$query = DB::table('assets')->remember(10);
//dd($query);
		return Datatable::query($query)


/*
			->showColumns('id')

			->addColumn('user_id',
				function($model) {
					return $model->user_id;
				})

			->addColumn('item_id',
				function($model) {
					return $model->item_id;
				})

			->addColumn('site_id',
				function($model) {
					return $model->site_id;
				})

			->addColumn('room_id',
				function($model) {
					return $model->room_id;
				})

			->addColumn('asset_status_id',
				function($model) {
					return $model->asset_status_id;
				})

			->addColumn('asset_tag',
				function($model) {
//					return $model->present()->status($model->status);
					return $model->asset_tag;
				})

			->addColumn('serial',
				function($model) {
					return $model->serial;
				})

			->addColumn('po',
				function($model) {
					return $model->po;
				})

			->addColumn('barcode',
				function($model) {
					return $model->barcode;
				})

			->addColumn('note',
				function($model) {
					return $model->note;
				})
*/
			->showColumns('id', 'user_id', 'item_id', 'site_id', 'room_id', 'asset_status_id', 'asset_tag', 'serial', 'po', 'barcode', 'note')
//			->showColumns('id')

			->addColumn('actions',
				function($model) {

				$modal =
					'<div class="modal fade" id="delete-Record-'.$model->id.'">
						'.Form::open(array("route" => array("asset.destroy", $model->id), "method" => "delete")).'
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
					'<a href="/asset/' . $model->id . '" class="btn btn-primary form-group" title="' . trans('lingos::general.view') . '"><i class="fa fa-chevron-right fa-fw"></i>' . trans('lingos::button.view') . '</a>&nbsp;'
					. '<a href="/asset/' . $model->id . '/edit" class="btn btn-success form-group" title="' . trans('lingos::account.command.edit') . '"><i class="fa fa-edit fa-fw"></i>' . trans('lingos::button.edit') . '</a>&nbsp;'
					. Form::button('<span class="glyphicon glyphicon-trash"></span> ' . trans('lingos::button.delete'), array('name'=>'deleteRecord', 'class' => 'btn btn-danger', 'type' => 'button',  'data-toggle' => 'modal', 'data-target' => '#delete-Record-'.$model->id))
					. $modal;
				})

			->searchColumns('user_id', 'item_id', 'site_id', 'room_id', 'asset_status_id', 'asset_tag', 'serial', 'po', 'barcode', 'note')
			->orderColumns('id', 'user_id', 'item_id', 'site_id', 'room_id', 'asset_status_id', 'asset_tag', 'serial', 'po', 'barcode', 'note')

			->make();
	}


}
