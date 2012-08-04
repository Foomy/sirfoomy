<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
<head>
  <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <meta name="Description" content="Foomys Welt - Die Homepage, privater Natur, von Sascha Schneider. Sinn und Unsinn aus aller Welt, und auch von meiner Wenigkeit." />
  <meta name="Keywords" content="Foomy, Foomys Welt, Sascha, Schneider, Homepage, privat, Blog, IMHO" />
  <meta name="Author" content="Sascha Schneider" />
  <meta name="Publisher" content="Sascha Schneider" />
  <meta name="Copyright" content="Sascha Schneider" />
  <meta name="Content-language" content="<?php echo LANGUAGE; ?>" />
  <meta name="language" content="<?php echo LANGUAGE; ?>" />
  <meta name="Page-topic" content="Gesellschaft" />
  <meta name="Page-type" content="Private Homepage" />
  <meta name="Revisit-after" content="29 days" />
  <meta name="Audience" content="Alle" />
  <meta name="Robots" content="INDEX,FOLLOW" />

  <title>Foomys Welt</title>

  <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="/inc/css/style.php" /> 

  <script type="text/javascript" src="/inc/js/prototype-1.6.0.2.js"></script>
  <script type="text/javascript" src="/inc/js/scriptaculous/scriptaculous.js"></script>
  <script type="text/javascript" src="/inc/js/livepipe/livepipe.js"></script>
  <script type="text/javascript" src="/inc/js/livepipe/rating.js"></script>
  <script type="text/javascript" src="/inc/js/main.js"></script>
  <?php
    if ( QUOTES_ON ) {
      $q = $OUT['quote'];
      $text = $q->Text();
      $auth = ' - '.$q->Author();
      $xtra = '   ('.$q->Extra().')';
  ?>
	<script type="text/javascript">
	<!--
		var tl=new Array('<?php echo $text; ?>', ' ', '<?php echo $auth; ?>', '<?php echo $xtra; ?>');
		var speed=45;
		var index=0; text_pos=0;
		var str_length=tl[0].length;
		var contents, row;
	// -->
	</script>
  <?php
    }
  ?>
</head>

<body> 
  <div id="headerbox">
    <?php if ( FoomyUser::LoggedIn() ) { ?>
    <div id="logout"><a href="?logout">ausloggen</a></div>
    <?php } ?>
    <a href="/"><img src="/img/logo.png" id="logo" alt="" /></a>
    <div id="slogan">
      Ich le<a class="invis" href="/blog/">b</a>
      in mei<a class="invis" href="/user/notice/">n</a>er
      eigenen Welt. Das ist ok,
      m<a class="invis" href="/admin/">a</a>n
      kennt mich dort.
    </div>
  </div>
 
	<div id="statusbox">
    <?php $t = new Tempus(); ?>
		<table id="statusTbl">
			<tr>
				<td id="breadcrumb"><?php echo breadcrumb(); ?></td>
				<td id="datum"><?php echo $t->ShortDate(); ?></td>
			</tr>
		</table>
	</div>
 
	<div id="leftbox">
    <?php
      if ( isset($OUT['menue']) ) {
        echo $OUT['menue'];
      }
    ?>
  </div><!-- /leftbox -->

	<div id="rightbox">
    <div id="links">
      <div class="head">Links</div>
      <div class="body">
        <a href="http://www.trackhints.com">Trackhints.com</a>
        <a href="http://www.staedte-reisen.de">Städte-Reisen.de</a>
      </div>
    </div>   
    <div id="wimip">
      <a href="http://www.wieistmeineip.de/cometo/"><img src="http://www.wieistmeineip.de/ip-adresse/" style="border:0; width:125px; height:125px" alt="IP" /></a>
    </div>
  </div><!-- /rightbox -->

	<div id="content">
    
    <div id="messages"></div><!-- /messages -->
   
