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
        @if ( Session::has('success') )
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if ( Session::has('failure') )
            <div class="alert alert-danger">
                {{ Session::get('failure') }}
            </div>
        @endif

        <div class="contact-us-form">
            {{Form::open(['url' => 'contact-us', 'class' => 'form-horizontal'])}}               
                <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                    {{ Form::label('name', $errors->first('name'), ['class' => 'col-xs-2 control-label']) }}
                    <div class="col-xs-5">
                        {{ Form::text('name', Input::old('name'), ['id' => 'name', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                    {{ Form::label('email', $errors->first('email'), ['class' => 'col-xs-2 control-label']) }}
                    <div class="col-xs-5">
                        {{ Form::text('email', Input::old('email'), ['id' => 'email', 'class' => 'form-control']) }}
                    </div>
                </div>                                
                <div class="form-group {{ $errors->first('subject') ? 'has-error' : '' }}">
                    {{ Form::label('subject', $errors->first('subject'), ['class' => 'col-xs-2 control-label']) }}
                    <div class="col-xs-5">
                        {{ Form::text('subject', Input::old('subject'), ['id' => 'subject', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group {{ $errors->first('message') ? 'has-error' : '' }}">
                    {{ Form::label('message', $errors->first('message'), ['class' => 'col-xs-2 control-label']) }}
                    <div class="col-xs-10">
                        {{ Form::textarea('message', Input::old('message'), ['id' => 'message', 'class' => 'form-control', 'rows' => '3']) }}
                    </div>
                </div>  
                <div class="form-group">
                    <div class="col-xs-10 col-xs-push-2">
                        <button type="submit" class="btn btn-default btn-grey">Send</button>
                    </div>
                </div>
            {{Form::close()}}   
        </div>      
    </div>
@stop

@section('page-js')

@stop