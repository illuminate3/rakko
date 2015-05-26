@extends('core::admin.master')

@section('title', $model->title)

@section('main')

    <h1>
        <a href="{{ route('admin.menus.edit', $menu->id) }}" title="{{ trans('menulinks::global.Back') }}">
            <span class="text-muted fa fa-arrow-circle-left"></span><span class="sr-only">{{ trans('menulinks::global.Back') }}</span>
        </a>
        {{ $model->present()->title }}
    </h1>

    {!! BootForm::open()->put()->action(route('admin.menus.menulinks.update', [$menu->id, $model->id]))->multipart()->role('form') !!}
    {!! BootForm::bind($model) !!}
    {!! BootForm::token() !!}
        @include('menulinks::admin._form')
    {!! BootForm::close() !!}

@stop
