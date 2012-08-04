<?php

class Menu {

	var $items = array();

	function Menu() {
		$this->items[1]    = array('title' => 'Home', 'url' => '/index.php');
		$this->items[2]    = array('title' => 'Wissen', 'url' => '/wissen/');
		$this->items[2][0] = array('title' => 'Ulams Problem', 'url' => '/wissen/ulam/');
		$this->items[3]    = array('title' => 'Intern', 'url' => '/intern/');
		$this->items[3][0] = array('title' => 'Impressum', 'url' => '/intern/impressum/');
		$this->items[3][1] = array('title' => 'Sitemap', 'url' => '/intern/sitemap/');
		$this->items[4]    = array('title' => 'Hilfe', 'url' => '/hilfe.php'); 
	}//Menu()

	function Show() {
		$ret = '<ul class="leftnav">';
		while ( list($key,$val) = each ($this->items) ) {
			if (is_array($val)) {
				$class = $this->IsActive($val['url']) ? ' class="leftnav-selected-top"' : '';
				$ret .= ' <li><a href="' . $val['url'] . '"'.$class.'>'. $val['title'] . '</a>';
				if ( $this->IsActive($val['url']) ) {
					$i=0;
					if ( isset($val[$i])) {
						$ret .= '<ul>';
						while (isset($val[$i])) {
							$subclass = $this->IsActive($val[$i]['url']) ? ' class="leftnav-selected"' : '';
							$ret .= '<li><a href="'.$val[$i]['url'].'"'.$subclass.'>'.$val[$i]['title'].'</a></li>';
							$i++;
						}
							$ret .= '</ul>';
					}
					$ret .= '</li>';
				}
				else {
					$ret .= '</li>';
				}
			}
		}
		$ret .= '</ul>';
		return($ret);
	}//Show()

	function GetCurrentURL() {
		$url = $_SERVER['PHP_SELF'];
		return(substr($url, 0, strpos($url, strrchr($url, '/'))+1));
	}//GetCurrentURL()

	function IsActive($url) {
		return(strpos($this->GetCurrentURL(), $url)===0);
	}//IsActive()
} // class
?>
