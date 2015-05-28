@extends('core::admin.master')

@section('title', trans('menulinks::global.New'))

@section('main')

    <h1>
        <a href="{{ route('admin.menus.edit', $menu->id) }}" title="{{ trans('menulinks::global.Back') }}">
            <span class="text-muted fa fa-arrow-circle-left"></span><span class="sr-only">{{ trans('menulinks::global.Back') }}</span>
        </a>
        @lang('menulinks::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin.menus.menulinks.index', $menu->id))->multipart()->role('form') !!}
    {!! BootForm::token() !!}
        @include('menulinks::admin._form')
    {!! BootForm::close() !!}

@stop
