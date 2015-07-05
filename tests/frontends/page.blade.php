@extends('frontends._template')

@section('page-title')
    {{ $page->title }}
@stop

@section('page-css')

@stop

@section('page-content')
    <div class="col-md-3 hidden-sm hidden-xs">
        @include('frontends.partials.sidebar')
    </div>
    <div class="col-md-9 col-sm-12">
        <div class="editor-content"> 
            {{ $page->content }}
        </div>
    </div>
@stop

@section('page-js')

@stop