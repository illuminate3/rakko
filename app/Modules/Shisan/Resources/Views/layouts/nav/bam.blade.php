<ul class="nav navbar-nav">
	<li {{ (strstr(Route::getCurrentRoute()->getPath(),'sites')) ? 'class="active"' : '' }} >
		{{ link_to('sites', 'Sites') }}
	</li>
	<li {{ (strstr(Route::getCurrentRoute()->getPath(),'profiles')) ? 'class="active"' : '' }} >
		{{ link_to('profiles', 'Staff') }}
	</li>
</ul>

@if (Auth::check())
@if (Auth::user()->hasRoleWithName('Admin'))

<li class="dropdown">
	<a class="dropdown-toggle {{ (Request::is('admin*') ? ' active' : '') }}" data-toggle="dropdown" href="#">
		{{ trans('lingos::general.settings') }}
		<b class="caret"></b>
	</a>
	<ul class="dropdown-menu">
		<li>
			{{ link_to('admin/departments', 'Departments') }}
		</li>
		<li>
			{{ link_to('admin/grades', 'Grades') }}
		</li>
		<li>
			{{ link_to('admin/divisions', 'Divisions') }}
		</li>
		<li>
			{{ link_to('admin/positions', 'Positions') }}
		</li>
		<li>
			{{ link_to('admin/subjects', 'Subjects') }}
		</li>
		<li>
			{{ link_to('admin/employee_types', 'Employee Types') }}
		</li>
		<li>
			{{ link_to('admin/job_titles', 'Job Titles') }}
		</li>
		<li class="divider"></li>
		<li>
			{{ link_to('admin/statuses', 'Statuses') }}
		</li>
	</ul>
</li>

@endif
@endif
