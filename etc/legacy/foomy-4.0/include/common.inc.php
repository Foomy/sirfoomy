<?php
/** foomy.net
 *    common.inc.php
 *
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    10.07.2004 - creating file
 *               - adding _header(), _footer(), pagetitle() & breadcrumb()
 *    19.10.2006 - adding getVar() & isValid()
 *    12.10.2007 - adding inMuldimArray()
 *    22.06.2008 - Migation to PHP5
 *                 output(), cleanArray(), oops()
 *    27.06.2008 - adding maintenance feature
 *    14.08.2008 - rename oops() to panic()
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

/** constants
 */


/** requirements
 */
require_once('config.inc.php');
require_once('checkmail.inc.php');
require_once('crypt.inc.php');
require_once('debug-1.0.inc.php');


/** classes
 */
require_once('classes/Db.class.php');
require_once('classes/FoomyDb.class.php');
require_once('classes/Base.class.php');
require_once('classes/Tempus.class.php');
require_once('classes/Link.class.php');
require_once('classes/MyCrypt.class.php');
require_once('classes/Quote.class.php');
require_once('classes/Form.class.php');
require_once('classes/User.class.php');
require_once('classes/FoomyUser.class.php');
require_once('classes/Group.class.php');
require_once('classes/Blog.class.php');



/** Wartung?
 */
if(MAINTENANCE && ($_SERVER['REQUEST_URI'] != '/maintenance/')) {
  header('Location: /maintenance/');
}

/** session handling
 */
session_start();
if ( FoomyUser::LoggedIn() && isset($_GET['logout']) ) {
  FoomyUser::Logout();
}

/** instance handles
 */
Common::$dbh = getDbInstance(); 

/** functions
 */
function _header() {
  global $OUT;
  require_once('header.de.inc.php');
}//_header()

function _footer() {
  global $OUT;
  require_once('footer.de.inc.php');
}//_footer()

function output() {
  global $OUT, $PATH;

  $location = '';
  $filename = 'index';
  $path_arr = cleanArray(explode('/', $_SERVER['REQUEST_URI']));
  if ( ! empty($path_arr) ) {
    foreach ( $path_arr as $p ) {
      if ( ! preg_match('/\.php/', $p) ) {
    	  $location .= "$p/";
      } else {
        list($filename, $extension) = explode('.', $p);        
      }
    }
  }

  $template = $location.$filename.'.'.LANGUAGE.'.tmpl.php';
  if ( file_exists(INCLUDE_PATH.TEMPLATE_PATH.$template) ) {
    include(TEMPLATE_PATH.$template);
  } else {
  	header('HTTP/1.1 404 Not Found');
    panic(j('Template nicht gefunden').': '.$template);
    exit(0);
  }
}// output()

function pagetitle($title, $subtitle='') {
  if ( hasValue($title) || hasValue($subtitle) ) {
    echo '<div id="pagetitle">';
    if ( hasValue($title) ) echo '<div class="head1">'.$title.'</div>';
    if ( hasValue($subtitle) ) echo '<div class="head3">'.$subtitle.'</div>';
    echo '</div>';
  }
}// setPageTitle()

function breadcrumb() {
 $sn = $_SERVER['SCRIPT_NAME'];
 $sn = substr($sn, 1, strlen($sn));
 $sn_arr = explode('/', $sn);
 $lastItem = array_pop($sn_arr);
 list($lastItem,) = explode('.', $lastItem);
 array_push($sn_arr, $lastItem);

 $ret = 'Home';
 for ( $i=0; $i<=count($sn_arr)-1; $i++) {
  if ( $sn_arr[$i]!='index' ) {
   $sn_arr[$i] = strtoupper(substr($sn_arr[$i], 0 , 1)).substr($sn_arr[$i], 1, strlen($sn_arr[$i]));
   $ret .= ' -> '.$sn_arr[$i];
  }
 }
 return($ret);
}// breadcrumb()

function hasValue($input) {
  if ( isset($input) && (! empty($input)) ) {
    return(true);
  }
  return(false);
}// hasValue()

function isArray($input) {
	if ( hasValue($input) && is_array($input) ) {
		return(true);
	}
  return(false);
}// isArray()

function isObject($input) {
	if ( hasValue($input) && is_object($input) ) {
		return(true);
	}
  return(false);
}// isObject()

function getVar($varname) {
  if ( hasValue($varname) ) {
    if ( hasValue($_POST[$varname]) ) {
      $ret = $_POST[$varname];
    } elseif ( hasValue($_GET[$varname]) ) {
      $ret = $_GET[$varname];
    }
    return($ret);
  }
  return(false);
}// getVar()

function sqlFilter($input) {
  $ret = str_replace("'", '&lsquo;', $input);
  $ret = str_replace('�', '&acute;', $ret);
  $ret = str_replace('"', '&quot;', $ret);

  return($ret);
}//sqlFilter()

function panic($err, $ajax=false) {
  if ( $ajax ) {
    header('HTTP/1.1 404 Not Found');
    if ( IS_TESTHOST ) echo $err;
  } else {
    $_SESSION['error'] = $err;
    header('Location: /error/');
  }
  exit(0);
}// panic()

function cleanArray($arr) {
  $ret = array();
  if ( is_array($arr) ) {
    foreach ( $arr as $a ) {
      $a = trim($a);
      if ( (! empty($a)) ) {
        $ret[] = $a;
      }
    }
    return($ret);
  }
  return(false);
}// cleanArray()

function inMuldimArray($needle, $haystack) {
  foreach ($haystack as $h) {
    if ( is_array($h) ) {
      if ( inMultiArray($needle, $h) ) return(true);
    }
    else {
      if ( $h==$needle ) {
        return(true);
      }
    }
  }
}//inMultiArray()

function j($str) {
	return($str);
}

function img($file, $id, $css='', $alt='', $title='') {
	if ( hasValue($file) && hasValue($id) ) {
		$ret  = '<img src="'.$file.'"';
    $ret .= ' id="'.$id.'"';
    $ret .= ' class="'.$css.'"';
    $ret .= ' alt="'.$alt.'"';
    $ret .= ' title="'.$title.'"';
    $ret .= ' />';
    return($ret);
	}
  return(false);
}

function getDbInstance() {
  if ( IS_TESTHOST ) {
    return(DbMysqlTest::GetInstance());
  } else {
    return(DbMysqlProd::GetInstance());
  }
}// getDbInstance()

class Common {
  public
    static $dbh;
}
?>
