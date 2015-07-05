@extends('frontends._template')

@section('page-title')
    {{ $page->title }}
@stop

@section('page-css')
	<style>
		.meta { margin: 10px 0; }
		.widget { margin-bottom: 20px; }
		ul { list-style: none; padding-left: 2px; }
	</style>
@stop

@section('page-content')
    <div class="col-sm-12">
        <div class="editor-content row blog">
        	<div class="col-sm-8"> 
				<div class="posts">
					<div class="entry">
						<h2>{{ $page->title }}</h2>

                        <div class="meta">
                        	<i class="fa fa-calendar"></i> {{ \Jamesy\FormatDate::getStandardFormat( $page->created_at ) }} 
                        	<i class="fa fa-user"></i> {{ $page->user->first_name }} 
                        	<i class="fa fa-folder-open"></i> <a href="#">General</a> 
                        	<span class="pull-right"><i class="fa fa-comment"></i> <a href="#">0 Comments</a></span>
                        </div>	

                        <div class="bthumb">
                           	<a href="{{ URL::to('blog/' . $page->slug) }}">
                           		<img class="img-responsive" alt="{{ $page->title }}" src="{{ asset(Setting::getImagePath() . '/'. $page->featured_image) }}">
                           	</a>
                        </div>
						{{ $page->content }}
					</div>
				</div>        	
            </div>
			<div class="col-sm-4">
				@include('frontends.partials.blog-sidebar')
			</div>
        </div>
    </div>
@stop

@section('page-js')

@stop