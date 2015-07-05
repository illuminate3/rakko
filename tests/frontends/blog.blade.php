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
		<div class="row editor-content blog">
			<div class="col-sm-8">
				<div class="posts">
					@foreach ( $posts as $post )
						<div class="entry">
							<h2><a href="{{ URL::to('blog/' . $post->slug) }}">{{ $post->title }}</a></h2>

                            <div class="meta">
                            	<i class="fa fa-calendar"></i> {{ \Jamesy\FormatDate::getStandardFormat( $post->created_at ) }} 
                            	<i class="fa fa-user"></i> {{ $post->user->first_name }} 
                            	<i class="fa fa-folder-open"></i> <a href="#">General</a> 
                            	<span class="pull-right"><i class="fa fa-comment"></i> <a href="#">0 Comments</a></span>
                            </div>	

                            <div class="bthumb">
                               	<a href="{{ URL::to('blog/' . $post->slug) }}">
                               		<img class="img-responsive" alt="{{ $post->title }}" src="{{ asset(Setting::getImagePath() . '/'. $post->featured_image) }}">
                               	</a>
                            </div>

							{{ $post->summary }}

							<div class="button">
								<a href="{{ URL::to('blog/' . $post->slug) }}">Read More...</a>
							</div>
						</div>
					@endforeach
					<div class="paging">
						{{ $links }}
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