{{ Form::beginGroup('title') }}
    {{ Form::label('title', 'Title', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{ Form::text('title', null, array('class' => 'form-control', 'required' => true, 'autofocus' => true)) }}
    </div>
{{ Form::endGroup('title') }}

{{ Form::beginGroup('slug') }}
    {{ Form::label('slug', 'Slug', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        <div class="input-group">
            <span class="input-group-addon">{{ Request::root().'/' }}</span>
            {{ Form::text('slug', null, array(
                'class' => 'form-control', 
                'required' => true,
                'pattern' => '^'.Category::$slugPattern.'$',
            )) }}
        </div>
        <span class="help-block">This one accepts only letters, numbers, dash and slash, i.e. "docs/installation".</span>
    </div>
{{ Form::endGroup('slug') }}

{{--
{{ Form::beginGroup('body') }}
    {{ Form::label('body', 'Body', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{ Form::hidden('body', null, array('class' => 'editor-value')) }}
        <span class="help-block">
            Supports <a href="http://daringfireball.net/projects/markdown/" target="_blank">markdown</a> syntax.
        </span>
    </div>
{{ Form::endGroup('body') }}
--}}


@if (!isset($category) || !$category->isRoot())
{{ Form::beginGroup('parent_id') }}
    {{ Form::label('parent_id', 'Parent', array('class' => 'col-lg-2 control-label')) }}
    <div class="col-lg-10">
        {{ Form::select('parent_id', $parents, null, array('class' => 'form-control', 'required' => true)) }}
    </div>
{{ Form::endGroup('parent_id') }}
@endif