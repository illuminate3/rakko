<footer class="footer">
<div class="container-fluid">

	<hr>

		<div class="row">
			<div class="col-sm-4">

<ul class="language_bar_chooser">
@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
	<li>
{{ $localeCode }}
		<a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
			{{{ $properties['native'] }}}
		</a>
	</li>
@endforeach
</ul>

			</div>
			<div class="col-sm-4">
				<p class="text-muted">
					{{ Config::get('general.footer') }}
				</p>
			</div>
			<div class="col-sm-4">
{{--
				<ul class="pull-right">
					<li>{!! link_to_route('dashboard', 'Home') !!}</li>
					<li>{!! link_to_route('dashboard.faq', 'Faq') !!}</li>
					<li>{!! link_to_route('dashboard.contact', 'Contact Us') !!}</li>
					<li><a id="gototop" class="gototop" href="#"><i class="icon-chevron-up"></i></a></li>
					<!--#gototop-->
				</ul>
--}}
			</div>
		</div>



</div>
</footer>
