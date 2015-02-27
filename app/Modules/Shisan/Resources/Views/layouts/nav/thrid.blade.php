<ul class="nav navbar-nav">
	<li {{ (strstr(Route::getCurrentRoute()->getPath(),'customers')) ? 'class="active"' : '' }} >
		<a href="{{ URL::to('customers') }}">Customers</a>
	</li>
	<li {{ (strstr(Route::getCurrentRoute()->getPath(),'items')) ? 'class="active"' : '' }} >
		<a href="{{ URL::to('items') }}">Items</a>
	</li>
	<li {{ (strstr(Route::getCurrentRoute()->getPath(),'racks')) ? 'class="active"' : '' }} >
		<a href="{{ URL::to('racks') }}">Racks</a>
	</li>
	<li {{ (strstr(Route::getCurrentRoute()->getPath(),'pallets')) ? 'class="active"' : '' }} >
		<a href="{{ URL::to('pallets') }}">Pallets</a>
	</li>
	<li {{ (strstr(Route::getCurrentRoute()->getPath(),'picks')) ? 'class="active"' : '' }} >
		<a href="{{ URL::to('picks') }}">Picks</a>
	</li>
	<li {{ (strstr(Route::getCurrentRoute()->getPath(),'moves')) ? 'class="active"' : '' }} >
		<a href="{{ URL::to('moves') }}">Moves</a>
	</li>
	<li {{ (strstr(Route::getCurrentRoute()->getPath(),'scans')) ? 'class="active"' : '' }} >
		<a href="{{ URL::to('scans') }}">Scans</a>
	</li>

	<li class="dropdown" id="accountmenu">
		<a class="dropdown-toggle " data-toggle="dropdown" href="#">
			Sales
			<i class="fa fa-chevron-down fa-fw"></i>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="{{ URL::to('bills') }}">Bills</a>
				<a href="{{ URL::to('orders') }}">Orders</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="{{ URL::to('invoices') }}">Invoices</a>
			</li>
		</ul>
	</li>
</ul>

@if (Auth::check())
@if (Auth::user()->hasRoleWithName('Admin'))

<li class="dropdown">
	<a class="dropdown-toggle {{ (Request::is('admin*') ? ' active' : '') }}" data-toggle="dropdown" href="#">
		Warehouse
		<b class="caret"></b>
	</a>
	<ul class="dropdown-menu">
		<li>
			<a href="{{ URL::to('items') }}">Items</a>
			<a href="{{ URL::to('customers') }}">Customers</a>
			<a href="{{ URL::to('customer_profiles') }}">Customer Profiles (for debugging)</a>
			<a href="{{ URL::to('bills') }}">Bills</a>
			<a href="{{ URL::to('charges') }}">Charges (for debugging)</a>
			<a href="{{ URL::to('racks') }}">Racks</a>
			<a href="{{ URL::to('pallets') }}">Pallets</a>
			<a href="{{ URL::to('picks') }}">Picks</a>
			<a href="{{ URL::to('orders') }}">Orders</a>
			<a href="{{ URL::to('invoices') }}">Invoices</a>
			<a href="{{ URL::to('vendibles') }}">Order Items</a>
			<a href="{{ URL::to('alerts') }}">Alerts (for debugging)</a>
		</li>
	</ul>
</li>

<li class="dropdown">
	<a class="dropdown-toggle {{ (Request::is('admin*') ? ' active' : '') }}" data-toggle="dropdown" href="#">
		{{ trans('lingos::general.settings') }}
		<i class="fa fa-cogs fa-fw"></i>
	</a>
	<ul class="dropdown-menu">
		<li>
			<a href="{{ URL::to('units') }}">Units and Measurement</a>
			<a href="{{ URL::to('zones') }}">Zones</a>
			<a href="{{ URL::to('statuses_billing') }}">Billing Statuses</a>
			<a href="{{ URL::to('statuses_paid') }}">Paid Statuses</a>
			<a href="{{ URL::to('statuses_sent') }}">Sent Statuses</a>
			<a href="{{ URL::to('statuses_order') }}">Order Statuses</a>
			<a href="{{ URL::to('charge_types') }}">Charge Types</a>
			<a href="{{ URL::to('statuses_pick') }}">Pick Statuses</a>
			<a href="{{ URL::to('pallet_types') }}">Pallet Types</a>
		</li>
	</ul>
</li>

@endif
@endif
