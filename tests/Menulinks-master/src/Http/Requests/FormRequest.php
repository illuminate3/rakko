<?php
namespace TypiCMS\Modules\Menulinks\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest {

    public function rules()
    {
        $rules = [
            'menu_id'    => 'required',
            'page_id'    => 'required_if:has_categories,1',
            'class'      => 'max:255',
            'icon_class' => 'max:255',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = 'max:255';
            $rules[$locale . '.url']   = 'max:255|url';
        }
        return $rules;
    }
}
