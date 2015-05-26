@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/form.js') }}"></script>
@stop

@section('titleLeftButton')
    <a href="{{ route('admin.menus.edit', $menu->id) }}" title="{{ trans('menulinks::global.Back') }}">
        <span class="text-muted fa fa-arrow-circle-left"></span><span class="sr-only">{{ trans('menulinks::global.Back') }}</span>
    </a>
@stop

<div class="form-group">
    <button class="btn btn-primary" value="true" id="exit" name="exit" type="submit">@lang('validation.attributes.save and exit')</button>
    <button class="btn btn-default" type="submit">@lang('validation.attributes.save')</button>
</div>

<div class="row">

    {!! BootForm::hidden('id') !!}
    {!! BootForm::hidden('menu_id')->value($menu->id) !!}
    {!! BootForm::hidden('position') !!}
    {!! BootForm::hidden('parent_id') !!}

    <div class="col-sm-6">

        @include('core::admin._tabs-lang')

        <div class="tab-content">

            @foreach ($locales as $lang)

            <div class="tab-pane fade @if ($locale == $lang)in active @endif" id="{{ $lang }}">

                {!! BootForm::text(trans('validation.attributes.title'), $lang.'[title]') !!}
                {!! BootForm::text(trans('validation.attributes.url'), $lang.'[url]') !!}
                <input type="hidden" name="{{ $lang }}[status]" value="0">
                {!! BootForm::checkbox(trans('validation.attributes.online'), $lang.'[status]') !!}

            </div>

            @endforeach

        </div>

    </div>

    <div class="col-sm-6">
        {!! BootForm::select(trans('validation.attributes.page_id'), 'page_id', $selectPages) !!}
        <input type="hidden" name="has_categories" value="0">
        {!! BootForm::checkbox(trans('validation.attributes.has_categories'), 'has_categories') !!}
        {!! BootForm::select(trans('validation.attributes.target'), 'target', ['' => trans('menulinks::global.Active tab'), '_blank' => trans('menulinks::global.New tab')]) !!}
        {!! BootForm::text(trans('validation.attributes.class'), 'class') !!}
        {!! BootForm::text(trans('validation.attributes.icon_class'), 'icon_class') !!}
    </div>

</div>
