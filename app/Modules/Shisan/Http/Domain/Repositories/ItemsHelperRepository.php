<?php
namespace App\Modules\Shisan\Http\Domain\Repositories;

class ItemsHelperRepository {

	private $menus;

	public function __construct($menus) {
	  $this->items = $menus;
	}

	public function htmlList() {
//dd($this->htmlFromArray($this->itemArray()));
	  return $this->htmlFromArray($this->itemArray());
	}

	private function itemArray() {
	  $result = array();
	  foreach($this->items as $item) {
		if ($item->parent_id == 0) {
		  $result[$item->name] = $this->itemWithChildren($item);
		}
	  }
	  return $result;
	}

	private function childrenOf($item) {
	  $result = array();
	  foreach($this->items as $i) {
		if ($i->parent_id == $item->id) {
		  $result[] = $i;
		}
	  }
	  return $result;
	}

	private function itemWithChildren($item) {
	  $result = array();
	  $children = $this->childrenOf($item);
	  foreach ($children as $child) {
		$result[$child->name] = $this->itemWithChildren($child);
	  }
	  return $result;
	}

	private function htmlFromArray($array) {
		$html = '';

		foreach($array as $k=>$v) {
			if(count($v) > 0) {
				$html .= '<li>';
			} else {
				$html .= '<li>';
			}

$html .= '<a href="#">';
$html .= $k . '--' . count($v);
$html .= '</a>';

			if(count($v) > 1) {
		$html .= '<ul class="collapse in">';
				$html .= $this->htmlFromArray($v);
		$html .= '</ul>';
			} elseif( (count($v) == 0) && (count($v) < 1) ) {
		$html .= '<ul class="collapse">';
				$html .= $this->htmlFromArray($v);
		$html .= '</ul>';
			} else {
			$html .= "</li>";
			}

		}

		return $html;
	}
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

	private function htmlFromArray1($array) {
		$html = '';

		foreach($array as $k=>$v) {
			if(count($v) > 0) {
				$html .= '<li>';
			} else {
				$html .= '<li>';
			}

			$html .= $k . '--' . count($v);

			$html .= "</li>";
		}

		return $html;
	}

}
