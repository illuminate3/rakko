<div class="sidebar">
  	<div class="widget">
     	<h4>Categories</h4>
     	...
  	</div> 
  	<div class="widget">
     	<h4>Recent Posts</h4>
     	<ul>
     		@foreach ($posts as $key => $post)
		 		<li>
		 			<i class="fa fa-angle-right"></i>
		 			<a href="{{ URL::to('blog/' . $post->slug) }}">{{ $post->title }}</a>
		 		</li>
			@endforeach
     	</ul>
  	</div>                             
</div>
