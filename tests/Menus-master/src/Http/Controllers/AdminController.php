<?php
namespace TypiCMS\Modules\Menus\Http\Controllers;

use TypiCMS\Modules\Core\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Menus\Http\Requests\FormRequest;
use TypiCMS\Modules\Menus\Repositories\MenuInterface;
use View;

class AdminController extends BaseAdminController
{

    public function __construct(MenuInterface $menu)
    {
        parent::__construct($menu);
    }

    /**
     * List models
     * GET /admin/model
     */
    public function index()
    {
        $models = $this->repository->all(['translations'], true);
        $module = $this->repository->getTable();
        $title = trans($module . '::global.name');

        return view('core::admin.index')
            ->with(compact('models', 'module', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FormRequest $request
     * @return Redirect
     */
    public function store(FormRequest $request)
    {
        $model = $this->repository->create($request->all());
        return $this->redirect($request, $model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     * @param  FormRequest $request
     * @return Redirect
     */
    public function update($model, FormRequest $request)
    {
        $this->repository->update($request->all());
        return $this->redirect($request, $model);
    }
}
