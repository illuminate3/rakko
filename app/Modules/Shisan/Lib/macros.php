<?php namespace lib;

use Form, HTML, View;

/**
 * Begin boostrap form group.
 *
 * Checks whether field has errors.
 *
 * @param string $name
 *
 * @return string
 */
Form::macro('beginGroup', function ($name)
{
    $errors = View::shared('errors');

    $class = 'form-group';

    if ($errors->has($name)) $class .= ' has-error';

    return '<div class="'.$class.'">';
});

/**
 * End bootstrap form group.
 *
 * Displays last error for a field if any.
 *
 * @param string $name
 *
 * @return string
 */
Form::macro('endGroup', function ($name)
{
    $html = '</div>';

    $errors = View::shared('errors');

    if ($errors->has($name))
    {
        $html = '<div class="col-lg-10 col-lg-offset-2"><span class="help-block">'.$errors->first($name).'</span></div>'.$html;
    }

    return $html;
});

/**
 * Simple macro for generating bootstrap icons.
 *
 * @param string $icon
 */
HTML::macro('glyphicon', function ($icon)
{
    return '<span class="glyphicon glyphicon-'.$icon.'"></span>';
});



// SIDE BAR MENU
/**
 * Render multi-level navigation.
 *
 * @param  array  $data
 *
 * @return string
 */
HTML::macro('nav', function($data)
{
    if (empty($data)) return '';

    $html = '<ul>';

    foreach ($data as $item)
    {
        $html .= '<li';

//        if (isset($item['active']) && $item['active']) $html .= ' class="active"';

        $html .= '><a href="'.$item['url'].'">';

        $html .= e($item['label']);

//if (isset($item['items'])) $html .= '<span class="fa plus-minus"></span>';

        $html .= '</a>';

        if (isset($item['items'])) $html .= HTML::nav($item['items']);
        $html .= '</li>';
    }

    return $html.'</ul>';
});


HTML::macro('navclean', function($data)
{
    if (empty($data)) return '';
//print_r($data);
    $html = '<nav class=""><ul id="">';

    foreach ($data as $item)
    {
        $html .= '<li';

//        if (isset($item['active']) && $item['active']) $html .= ' class="active"';

        $html .= '><a href="'.$item['url'].'">';
        $html .= e($item['label']);

//if (isset($item['items'])) $html .= '<span class="fa plus-minus"></span>';

        $html .= '</a>';
        if (isset($item['items'])) $html .= HTML::nav($item['items']);
        $html .= '</li>';
    }

    return $html.'</ul></nav>';
});





HTML::macro('pulldown', function($data)
{

	if (empty($data)) return '';

	$html = '<select>';

	foreach ($data as $item)
	{
		if ( $item->slug == '/' ) {
			$html .= '<option value="NULL">Select a Category</option>';
		} else {
			$html .= '<option value="' . $item->id . '">';
			$html .= $item->slug;
			$html .= '</option>';
		}
	}

	$html .= '</select>';

	return $html;

});


/*
<nav class="sidebar-nav">
<ul id="metisMenu">
	<li class="active">
		<a href="#">
		<span class="sidebar-nav-item-icon fa fa-github fa-lg"></span>
		<span class="sidebar-nav-item">metisMenu</span>
		<span class="fa arrow"></span>
		</a>
		<ul class="collapse in">
			<li>
				<a href="https://github.com/onokumus/metisMenu">
				<span class="sidebar-nav-item-icon fa fa-code-fork"></span>
				LEVEL 1
				</a>
			</li>
			<li>
				<a href="#">
				<span class="sidebar-nav-item-icon fa fa-code-fork"></span>
				LEVEL 1
				<span class="fa plus-minus"></span>
				</a>
				<ul class="collapse">
					<li><a href="#">item 2.1</a></li>
					<li><a href="#">item 2.2</a></li>
					<li><a href="#">item 2.3</a></li>
					<li><a href="#">item 2.4</a></li>
				</ul>
			</li>
		</ul>
	</li>
</ul>
</nav>
*/



HTML::macro('navy', function($data)
{
    if (empty($data)) return '';
//print_r($data);
    $html = '<ul id="navagoco" class="navagoco">';

    foreach ($data as $item)
    {
        $html .= '<li';

//        if (isset($item['active']) && $item['active']) $html .= ' class="active"';

        $html .= '><a href="'.$item['url'].'">';
        $html .= e($item['label']);

//if (isset($item['items'])) $html .= '<span class="fa plus-minus"></span>';

        $html .= '</a>';
        if (isset($item['items'])) $html .= HTML::nav($item['items']);
        $html .= '</li>';
    }

    return $html.'</ul>';
});
