<?php

use Illuminate\Support\Collection;

/**
 * Convert tree of nodes in an array appropriate for HTML::nav().
 *
 * @param  \Illuminate\Support\Collection $tree
 * @param  int         $activeItemKey
 * @param  boolean     $active
 *
 * @return array
 */
function make_nav(Collection $tree, $activeItemKey = null, &$active = null)
{
    if (!$tree->count()) return null;

    return array_map(function ($item) use ($activeItemKey, &$active) {
        $data = array();

        $childActive = false;
        $data['items'] = make_nav($item->children, $activeItemKey, $childActive);

        if ($activeItemKey !== null)
        {
            $childActive |= $activeItemKey == $item->getKey();
        }

        $active |= $childActive;

        $data['active'] = $childActive;

        foreach (array('url', 'label') as $key) {
            $getter = 'getNav'.ucfirst($key);

            $data[$key] = $item->$getter();
        }

        return $data;

    }, $tree->all());
}

/**
 * Transform markdown to the HTML.
 *
 * @param string $text
 *
 * @return string
 */
function markdown($text)
{
    return Parsedown::instance()->parse($text);
}

/**
 * Render spaces to represent item depth.
 *
 * @param int $depth
 *
 * @return string
 */
function item_depth($depth)
{
//dd($depth);
    return str_repeat('<span class="space">&raquo;</span>', $depth);
}
