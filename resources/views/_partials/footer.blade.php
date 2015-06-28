<footer class="footer">
<div class="container-fluid">

	<hr>

		<div class="row">
			<div class="col-sm-4">

{!! Widget::FooterMenu() !!}

			</div>
			<div class="col-sm-4">
				<p class="text-muted">
					{{ Config::get('general.footer') }}
				</p>
			</div>
			<div class="col-sm-4">

	{!!
		Menu::handler('right')
			->getItemsAtDepth(0);
	!!}
{{--
{!! Plugin::MenuAdmin() !!}
{!! Widget::AdminMenu() !!}
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
