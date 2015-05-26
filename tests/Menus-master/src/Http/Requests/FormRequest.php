<?php
namespace TypiCMS\Modules\Menus\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest {

    public function rules()
    {
        $rules = [
            'name' => 'required|alpha_dash|unique:menus,name,' . $this->id,
        ];
        return $rules;
    }
}
