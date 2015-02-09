<ul class="menu">

	<li title="Categories">
		<a href="#" class="sitemap" id="showLeft">
			Categories
		</a>
	</li>
	<li title="Items">
		<a href="{{  URL::to('items') }}" {{ (strstr(Route::getCurrentRoute()->getPath(),'items')) ? 'class="active book"' : 'class="book"' }} >
			Items
		</a>
	</li>
	<li title="Assets">
		<a href="{{  URL::to('asset') }}" {{ (strstr(Route::getCurrentRoute()->getPath(),'asset')) ? 'class="active tags"' : 'class="tags"' }} >
			Assets
		</a>
	</li>
	<li title="Rooms">
		<a href="{{  URL::to('rooms') }}" {{ (strstr(Route::getCurrentRoute()->getPath(),'rooms')) ? 'class="active building"' : 'class="building"' }} >
			Rooms
		</a>
	</li>
	<li title="Scan">
		<a href="{{  URL::to('scans') }}" {{ (strstr(Route::getCurrentRoute()->getPath(),'scans')) ? 'class="active barcode"' : 'class="barcode"' }} >
			Scan
		</a>
	</li>
	<li title="Sites">
		<a href="{{  URL::to('sites') }}" {{ (strstr(Route::getCurrentRoute()->getPath(),'sites')) ? 'class="active site"' : 'class="site"' }} >
			Sites
		</a>
	</li>

</ul>
