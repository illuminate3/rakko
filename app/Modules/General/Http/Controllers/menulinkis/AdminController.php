<?php
namespace TypiCMS\Modules\Menulinks\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Menulinks\Http\Requests\FormRequest;
use TypiCMS\Modules\Menulinks\Repositories\MenulinkInterface;

class AdminController extends BaseAdminController
{

    public function __construct(MenulinkInterface $menulink)
    {
        parent::__construct($menulink);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  $menu
     * @return void
     */
    public function create($menu = null)
    {
        $model = $this->repository->getModel();
        $selectPages = $this->repository->getPagesForSelect();

        return view('menulinks::admin.create')
            ->with(compact('model', 'menu', 'selectPages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $menu
     * @param  $model
     * @return void
     */
    public function edit($menu = null, $model = null)
    {
        $selectPages = $this->repository->getPagesForSelect();

        return view('menulinks::admin.edit')
            ->with(compact('model', 'menu', 'selectPages'));
    }

    /**
     * Show resource.
     *
     * @param  $menu
     * @param  $model
     * @return Redirect
     */
    public function show($menu = null, $model = null)
    {
        return Redirect::route('admin.menus.menulinks.edit', [$menu->id, $model->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $menu
     * @param  FormRequest $request
     * @return Redirect
     */
    public function store($menu = null, FormRequest $request)
    {
        $data = $request->all();
        $data['parent_id'] = null;
        $data['page_id'] = $data['page_id'] ? : null ;
        $data['position'] = $data['position'] ? : 0 ;
        $model = $this->repository->create($data);
        return $this->redirect($request, $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $menu
     * @param  $model
     * @param  FormRequest $request
     * @return Redirect
     */
    public function update($menu = null, $model, FormRequest $request)
    {
        $data = $request->all();
        $data['parent_id'] = $data['parent_id'] ? : null ;
        $data['page_id'] = $data['page_id'] ? : null ;
        $this->repository->update($data);
        return $this->redirect($request, $model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $parent
     * @param  $model
     * @return Redirect
     */
    public function destroy($parent = null, $model = null)
    {
        if ($this->repository->delete($model)) {
            return back();
        }
    }

    /**
     * Sort list.
     *
     * @return Response
     */
    public function sort()
    {
        $this->repository->sort(Input::all());
        return Response::json([
            'error'   => false,
            'message' => trans('global.Items sorted')
        ], 200);
    }
}
