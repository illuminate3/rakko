@extends('frontends._template')

@section('page-title')
    Search Results
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
        <div class="results-page-title">
            <h2>Displaying results for: <i>{{ e($term) ? e($term) : 'Everything' }}</i></h2>
        </div> 

        @if ( count($results) )
            @foreach ( $results as $key=>$result )
                <div class="col-xs-12">
                    <div class="result-title">
                        <h3><a href="{{ $result['url'] }}">{{ $result['title'] }}</a></h3>
                    </div>
                    <div class="result-summary">
                        {{ $result['summary'] }}
                    </div>
                    <div class="result-readmore">
                        <a href="{{ $result['url'] }}" class="rm">Read More &raquo;</a>
                    </div> 
                    <!-- <hr />  -->
                </div>
            @endforeach
        @else 
            <div class="no-posts"> 
                No results for the keywords: <i>{{ e($term) }}</i>
            </div>
        @endif        
    </div>
@stop

@section('page-js')

@stop