<?php
namespace TypiCMS\Modules\Menulinks\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Menulinks\Repositories\MenulinkInterface as Repository;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Get models
     * @return Response
     */
    public function index()
    {
        $id = Input::get('menu_id');
        $models = $this->repository->allNestedBy('menu_id', $id, [], true);
        return Response::json($models, 200);
    }
}
