@extends('layouts.master')

@section('menu')
{{--
<ul class="nav navbar-nav">
    <li><a href="{{ route('categories.index') }}">Categories</a></li>
</ul>


<ul class="nav navbar-nav pull-right">
    <li><a href="{{ url('/') }}"><span class="glyphicon glyphicon-arrow-left"></span> Return to site</a></li>
</ul>
--}}
@stop

@section('content')
    <h1>{{{ $title }}}</h1>

    {{-- Display some alerts --}}
    @foreach (array('error', 'warning', 'success') as $key)
        @if (Session::has($key))
    <div class="alert alert-dismissable alert-{{ $key === 'error' ? 'danger' : $key }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get($key) }}
    </div>
        @endif
    @endforeach

{{-- $content --}}
@stop

@section('footer')
{{--
    <script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.1.01/ace.js"></script>
    <script src="/js/backend.js"></script>
--}}
@stop
