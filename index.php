<?php // no direct access 
defined( '_JEXEC' ) or die( 'Restricted access' );

////layout vars
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
$menu = $app->getMenu()->getActive();
$frontpage =  (($app->getMenu()->getActive() == $app->getMenu()->getDefault()) and $_SERVER["REQUEST_URI"] == '/') ? true : false;
$pageclass = '';
if (is_object($menu))
	$pageclass = $menu->params->get('pageclass_sfx');

//Detecting Joomla Platform and Version
$p = new JPlatform;
$v = (int) $p->getShortVersion();
if ($v > 11) {
	$ver = 3;
} else {
	$ver = 2;
}

$jv = new JVersion;
$ver_2 = ((int)$jv->RELEASE < 3) ? true : false;

//message overwrite for version 2
if($ver_2) {
	require_once JPATH_ROOT .'/templates/'. $this->template .'/html/message.php';
} else {
	JHtml::_('bootstrap.framework');
}


// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

//portfolio layout
if (stristr($layout, 'portfolio')) {
	$portfolio = true;
} else {
	$portfolio = false;
}

//tmpl vars
// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="'. JURI::root() . $this->params->get('logoFile') .'" alt="'. $sitename .'" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<h2 class="site-title" title="'. $sitename .'">'. htmlspecialchars($this->params->get('sitetitle')) .'</h2>';
}
else
{
	//$logo = '<span class="site-title" title="'. $sitename .'">'. $sitename .'</span>';
	$logo = '<img src="'. JURI::base() .'templates/'. $this->template .'/images/logo.png" alt="'. $sitename .'" />';
}

//Template params
$html5	= $this->params->get("html5", 0);
//$totop	= $this->params->get("totop", 0);
$content_frontpage	= ($this->params->get("content_frontpage", 0)) ? true : false;
if (($content_frontpage and $frontpage) or (!$frontpage)) {
	$hide_content_class = '';
} else {
	$hide_content_class = 'hide_content';
}

if($html5):
	$doctype = '<!DOCTYPE html>';
$div = 'section';
$aside = 'aside';
$header = 'header';
$footer = 'footer';
$article = 'article';
else: 
	$doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$div = 'div';
$aside = 'div';
$header = 'div';
$footer = 'div';
$article = 'div';
endif;



//rows and sections
	//topline
$row1 = ($this->countModules('topline_fullwidth')) ? true : false;
$row2 = (($this->countModules('topline_onehalf_first')) or ($this->countModules('topline_onehalf_second'))) ? true : false;
$row3 = (($this->countModules('topline_onethird_first')) or ($this->countModules('topline_onethird_second')) or ($this->countModules('topline_onethird_third'))) ? true : false;
$row4 = (($this->countModules('topline_onefourth_first')) or ($this->countModules('topline_onefourth_second')) or ($this->countModules('topline_onefourth_third')) or ($this->countModules('topline_onefourth_fourth'))) ? true : false;

	//logo
$row5 = ($this->countModules('logo_fullwidth')) ? true : false;
$row6 = (($this->countModules('logo_onehalf_first')) or ($this->countModules('position-1')) or ($this->countModules('position-0'))) ? true : false;
$row7 = (($this->countModules('logo_onethird_first')) or ($this->countModules('logo_onethird_second')) or ($this->countModules('logo_onethird_third'))) ? true : false;
$row8 = (($this->countModules('logo_onefourth_first')) or ($this->countModules('logo_onefourth_second')) or ($this->countModules('logo_onefourth_third')) or ($this->countModules('logo_onefourth_fourth'))) ? true : false;

	//breadcrumbs
$slider = ($this->countModules('slider')) ? true : false;
$row9 = ($this->countModules('position-2')) ? true : false;
$row10 = (($this->countModules('breadcrumbs_onehalf_first')) or ($this->countModules('breadcrumbs_onehalf_second'))) ? true : false;
$row11 = (($this->countModules('breadcrumbs_onethird_first')) or ($this->countModules('breadcrumbs_onethird_second')) or ($this->countModules('breadcrumbs_onethird_third'))) ? true : false;
$row12 = (($this->countModules('breadcrumbs_onefourth_first')) or ($this->countModules('breadcrumbs_onefourth_second')) or ($this->countModules('breadcrumbs_onefourth_third')) or ($this->countModules('breadcrumbs_onefourth_fourth'))) ? true : false;

	//belowcontent
$row14 = ($this->countModules('belowcontent_fullwidth')) ? true : false;
$row15 = (($this->countModules('belowcontent_onehalf_first')) or ($this->countModules('belowcontent_onehalf_second'))) ? true : false;
$row16 = (($this->countModules('position-9')) or ($this->countModules('position-10')) or ($this->countModules('position-11'))) ? true : false;
$row17 = (($this->countModules('belowcontent_onefourth_first')) or ($this->countModules('belowcontent_onefourth_second')) or ($this->countModules('belowcontent_onefourth_third')) or ($this->countModules('belowcontent_onefourth_fourth'))) ? true : false;

	//footer
$row18 = ($this->countModules('footer_fullwidth')) ? true : false;
$row19 = (($this->countModules('footer_onehalf_first')) or ($this->countModules('footer_onehalf_second'))) ? true : false;
$row20 = (($this->countModules('footer_onethird_first')) or ($this->countModules('footer_onethird_second')) or ($this->countModules('footer_onethird_third'))) ? true : false;
$row21 = (($this->countModules('footer_onefourth_first')) or ($this->countModules('footer_onefourth_second')) or ($this->countModules('footer_onefourth_third')) or ($this->countModules('footer_onefourth_fourth'))) ? true : false;

	//copyright
$row22 = ($this->countModules('position-14')) ? true : false;
$row23 = (($this->countModules('copyright_onehalf_first')) or ($this->countModules('copyright_onehalf_second'))) ? true : false;
$row24 = (($this->countModules('copyright_onethird_first')) or ($this->countModules('copyright_onethird_second')) or ($this->countModules('copyright_onethird_third'))) ? true : false;
$row25 = (($this->countModules('copyright_onefourth_first')) or ($this->countModules('copyright_onefourth_second')) or ($this->countModules('copyright_onefourth_third')) or ($this->countModules('copyright_onefourth_fourth'))) ? true : false;

	//sections
	// $topline = ($row1 or $row2 or $row3 or $row4) ? true : false;
	// $logo = ($row5 or $row6 or $row7 or $row8) ? true : false;
	// $breadcrumbs = ($row9 or $row10 or $row11 or $row12) ? true : false;
	// $belowcontent = ($row14 or $row15 or $row16 or $row17) ? true : false;
	// $footer = ($row18 or $row19 or $row20 or $row21) ? true : false;
	// $copyright = ($row22 or $row23 or $row24 or $row25) ? true : false;

// Adjusting content width
$left = (($this->countModules('position-7')) or ($this->countModules('position-4')) or ($this->countModules('position-5'))) ? true : false;
$right = (($this->countModules('position-6')) or ($this->countModules('position-8')) or ($this->countModules('position-3'))) ? true : false;

if ($left and $right) {
	$span = "span6";
}
elseif (($left and !$right) or (!$left and $right)) {
	$span = "span9";
}
else {
	$span = "span12";
}

?>

<?php echo $doctype."\n"; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/favicon.png" type="image/png">
	<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/favicon.png" type="image/png" />	
	
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap.min.css" type="text/css" />
	
	<?php if($ver_2) : ?>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.min.js"></script>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/bootstrap.min.js"></script>
	<?php else : ?>
		<jdoc:include type="head" />
	<?php endif; ?>

	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.easing.1.3.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/superfish.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/hoverIntent.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.isotope.min.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.hoverdir.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.prettyPhoto.js"></script>
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.ui.totop.js"></script>

	<?php if($ver_2) : ?>
		<jdoc:include type="head" />
	<?php endif; ?>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/main.js"></script>	
	
	<!--[if IE 6]>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie6.css" type="text/css" />
		<style type="text/css">
			img, div, a, input { behavior: url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/iepngfix.htc) }
			.aside div.moduletable h3, #sidebar-2 div.moduletable h3, .moduletable_menu h3 { behavior:none;}
		</style>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/iepngfix_tilebg.js" type="text/javascript"></script>
		<![endif]-->
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie67.css" type="text/css" />
		<![endif]-->
	<!--[if lte IE 8]>
		<style type="text/css">
			.aside div.moduletable h3, .moduletable_menu h3 { behavior: url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/PIE.php) }
		</style>
		<![endif]-->
	<!--[if lte IE 8]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <style> 
	        {behavior:url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?> ?>/js/PIE.htc);}
      </style>
      <![endif]-->

  </head>

  <body class="site <?php echo $option . " view-" . $view . " layout-" . $layout . " task-" . $task . " itemid-" . $itemid . " " .$hide_content_class;?> <?php echo $pageclass ? htmlspecialchars($pageclass) : 'default'; echo $frontpage ? ' frontpage' : ''; ?>">
  	<?php if ($row1 or $row2 or $row3 or $row4): ?>
  		<!--top line-->
  		<<?php echo $div; ?> id="topline" class="container">
  		<?php if ($row1): ?>
  			<div class="row row1">
  				<div class="span12"><jdoc:include type="modules" name="topline_fullwidth" style="xhtml" /></div>
  			</div>
  		<?php endif ?>

  		<?php if ($row2): ?>
  			<div class="row row2">
  				<div class="span6"><jdoc:include type="modules" name="topline_onehalf_first" style="xhtml" /></div>
  				<div class="span6"><jdoc:include type="modules" name="topline_onehalf_second" style="xhtml" /></div>
  			</div>
  		<?php endif ?>

  		<?php if ($row3): ?>
  			<div class="row row3">
  				<div class="span4"><jdoc:include type="modules" name="topline_onethird_first" style="xhtml" /></div>
  				<div class="span4"><jdoc:include type="modules" name="topline_onethird_second" style="xhtml" /></div>
  				<div class="span4"><jdoc:include type="modules" name="topline_onethird_third" style="xhtml" /></div>
  			</div>
  		<?php endif ?>

  		<?php if ($row4): ?>
  			<div class="row row4">
  				<div class="span3"><jdoc:include type="modules" name="topline_onefourth_first" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="topline_onefourth_second" style="xhtml" /></div>
  		
		<div class="span3"><jdoc:include type="modules" name="topline_onefourth_third" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="topline_onefourth_fourth" style="xhtml" /></div>
  			</div>
  		<?php endif ?>		
  		</<?php echo $div; ?>>
  		<!--eof top line-->
  	<?php endif ?>
  	<?php //if ($row5 or $row6 or $row7 or $row8): ?>
  	<!--logo-->
  	<<?php echo $header; ?> id="header"><div id="logo">
  	<?php //if ($row5): ?>

  	<div class="container"><div class="row row5">
  		<div class="span12">
  			<a class="brand" href="<?php echo $this->baseurl; ?>">
  				<?php echo $logo;?> <?php if ($this->params->get('sitedescription')) { echo '<div class="site-description">'. htmlspecialchars($this->params->get('sitedescription')) .'</div>'; } ?>
  			</a>
  			<jdoc:include type="modules" name="logo_fullwidth" style="xhtml" />
  		</div>
  	</div></div>
  	<?php //endif ?>
  	<?php if ($row6): ?>
  		<div class="mainmenu_wrap">
  			<div class="container"><div class="row row6">
  				<div class="span9">
  					<jdoc:include type="modules" name="logo_onehalf_first" style="xhtml" />
  					<?php if($this->countModules('position-1')): ?>




  						<div id="mainmenu">
  							<jdoc:include type="modules" name="position-1" style="xhtml" />
  						</div>
  					<?php endif; ?>	
  				</div>
  				<div class="span3">
  					<?php if($this->countModules('position-0')): ?>
  						<div id="search"><jdoc:include type="modules" name="position-0" style="xhtml" /></div>
  					<?php endif; ?>
  				</div>
  			</div></div></div>
  		<?php endif; ?>

  		<?php if ($row7): ?>
  			<div class="container"><div class="row row7">
  				<div class="span4"><jdoc:include type="modules" name="logo_onethird_first" style="xhtml" /></div>
  				<div class="span4"><jdoc:include type="modules" name="logo_onethird_second" style="xhtml" /></div>
  				<div class="span4"><jdoc:include type="modules" name="logo_onethird_third" style="xhtml" /></div>
  			</div></div>
  		<?php endif ?>

  		<?php if ($row8): ?>
  			<div class="container"><div class="row row8">
  				<div class="span3"><jdoc:include type="modules" name="logo_onefourth_first" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="logo_onefourth_second" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="logo_onefourth_third" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="logo_onefourth_fourth" style="xhtml" /></div>
  			</div></div>
  		<?php endif ?>		
  	</div></<?php echo $header; ?>>

  	<!--eof logo-->
  	<?php //endif ?>

  	<?php if ($slider): ?>
  		<div class="flexslider" id="mainslider">
  			<jdoc:include type="modules" name="slider" style="none" />
  		</div>
  	<?php endif ?>

  	<?php if ($row9 or $row10 or $row11 or $row12): ?>
  		<!--above content-->
  		<<?php echo $div; ?> id="abovecontent">

  		<?php if($row9) : ?>
  			<div class="container"><div class="row row9">
  				<div class="span12" id="breadcrumbs"><jdoc:include type="modules" name="position-2" style="xhtml" /></div>
  			</div></div>
  		<?php endif; ?>

  		<?php if ($row10): ?>
  			<div class="container"><div class="row row10">
  				<div class="span6"><jdoc:include type="modules" name="breadcrumbs_onehalf_first" style="xhtml" /></div>
  				<div class="span6"><jdoc:include type="modules" name="breadcrumbs_onehalf_second" style="xhtml" /></div>
  			</div></div>
  		<?php endif ?>

  		<?php if ($row11): ?>
  			<div class="container"><div class="row row11">
  				<div class="span4"><jdoc:include type="modules" name="breadcrumbs_onethird_first" style="xhtml" /></div>
  				<div class="span4"><jdoc:include type="modules" name="breadcrumbs_onethird_second" style="xhtml" /></div>
  				<div class="span4"><jdoc:include type="modules" name="breadcrumbs_onethird_third" style="xhtml" /></div>
  			</div></div>
  		<?php endif ?>

  		<?php if ($row12): ?>
  			<div class="container"><div class="row row12">
  				<div class="span3"><jdoc:include type="modules" name="breadcrumbs_onefourth_first" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="breadcrumbs_onefourth_second" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="breadcrumbs_onefourth_third" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="breadcrumbs_onefourth_fourth" style="xhtml" /></div>
  			</div></div>
  		<?php endif ?>		
  		</<?php echo $div; ?>>
  		<!--eof above content-->
  	<?php endif ?>

  	<!--content-->
  	<<?php echo $div; ?> id="middle"<?php echo (($content_frontpage and $frontpage) or (!$frontpage)) ? '' : ' style="display: none;"' ?>>
  	<div class="container"><div class="row-fluid row13">
  		<?php if($left) : ?>
  			<<?php echo $aside ?> id="sidebarleft" class="span3 aside">
  			<jdoc:include type="modules" name="position-7" style="xhtml" />
  			<jdoc:include type="modules" name="position-4" style="xhtml" />
  			<jdoc:include type="modules" name="position-5" style="xhtml" />
  			</<?php echo $aside ?>>
  		<?php endif; ?>

  		<<?php echo $article ?> id="content" class="<?php echo $span ?>">
  		<?php if($this->countModules('position-12')) : ?>
  			<div class="row-fluid">
  				<div id="topcontent" class="span12">
  					<jdoc:include type="modules" name="position-12" style="xhtml" />
  				</div>
  			</div>
  		<?php endif; ?>

  		<jdoc:include type="message" />
  		<div id="component" <?php echo (($content_frontpage and $frontpage) or (!$frontpage)) ? '' : 'style="display: none;"' ?>>
  			<jdoc:include type="component" />
  		</div>

  		<?php if($this->countModules('position-13')) : ?>
  			<div class="row-fluid">
  				<div id="bottomcontent" class="span12">
  					<jdoc:include type="modules" name="position-13" style="xhtml" />
  				</div>
  			</div>
  		<?php endif; ?>
  		</<?php echo $article ?>>

  		<?php if($right) : ?>
  			<<?php echo $aside ?> id="sidebarright" class="span3 aside">
  			<jdoc:include type="modules" name="position-6" style="xhtml" />
  			<jdoc:include type="modules" name="position-8" style="xhtml" />
  			<jdoc:include type="modules" name="position-3" style="xhtml" />
  			</<?php echo $aside ?>>
  		<?php endif; ?>
  	</div>
  </div>
  </<?php echo $div; ?>>
  <!--eof content-->

  <?php if ($row14 or $row15 or $row16 or $row17): ?>
  	<!--below content-->
  	<<?php echo $div; ?> id="belowcontent">
  	<?php if($row14) : ?>
  		<div class="container"><div class="row row14">
  			<div class="span12"><jdoc:include type="modules" name="belowcontent_fullwidth" style="xhtml" /></div>
  		</div></div>
  	<?php endif; ?>

  	<?php if ($row15): ?>
  		<div class="container"><div class="row row15">
  			<div class="span6"><jdoc:include type="modules" name="belowcontent_onehalf_first" style="xhtml" /></div>
  			<div class="span6"><jdoc:include type="modules" name="belowcontent_onehalf_second" style="xhtml" /></div>
  		</div></div>
  	<?php endif ?>

  	<?php if ($row16): ?>
  		<div class="container"><div class="row row16">
  			<div class="span4"><jdoc:include type="modules" name="position-9" style="xhtml" /></div>
  			<div class="span4"><jdoc:include type="modules" name="position-10" style="xhtml" /></div>
  			<div class="span4"><jdoc:include type="modules" name="position-11" style="xhtml" /></div>
  		</div></div>
  	<?php endif ?>

  	<?php if ($row17): ?>
  		<div class="container"><div class="row row17">
  			<div class="span3"><jdoc:include type="modules" name="belowcontent_onefourth_first" style="xhtml" /></div>
  			<div class="span3"><jdoc:include type="modules" name="belowcontent_onefourth_second" style="xhtml" /></div>
  			<div class="span3"><jdoc:include type="modules" name="belowcontent_onefourth_third" style="xhtml" /></div>
  			<div class="span3"><jdoc:include type="modules" name="belowcontent_onefourth_fourth" style="xhtml" /></div>
  		</div></div>
  	<?php endif ?>		
  	</<?php echo $div; ?>>
  	<!--eof below content-->
  <?php endif ?>

  <?php if ($row18 or $row19 or $row20 or $row21): ?>
  	<!--footer-->
  	<<?php echo $div; ?> id="footer">
  	<<?php echo $footer; ?> class="container">
  	<?php if($row18) : ?>
  		<div class="row-fluid row18">
  			<div class="span12"><jdoc:include type="modules" name="footer_fullwidth" style="xhtml" /></div>
  		</div>
  	<?php endif; ?>

  	<?php if ($row19): ?>
  		<div class="row-fluid row19">
  			<div class="span6"><jdoc:include type="modules" name="footer_onehalf_first" style="xhtml" /></div>
  			<div class="span6"><jdoc:include type="modules" name="footer_onehalf_second" style="xhtml" /></div>
  		</div>
  	<?php endif ?>

  	<?php if ($row20): ?>
  		<div class="row-fluid row20">
  			<div class="span4"><jdoc:include type="modules" name="footer_onethird_first" style="xhtml" /></div>
  			<div class="span4"><jdoc:include type="modules" name="footer_onethird_second" style="xhtml" /></div>
  			<div class="span4"><jdoc:include type="modules" name="footer_onethird_third" style="xhtml" /></div>
  		</div>
  	<?php endif ?>

  	<?php if ($row21): ?>
  		<div class="row-fluid row21">
  			<div class="span3"><jdoc:include type="modules" name="footer_onefourth_first" style="xhtml" /></div>
  			<div class="span3"><jdoc:include type="modules" name="footer_onefourth_second" style="xhtml" /></div>
  			<div class="span3"><jdoc:include type="modules" name="footer_onefourth_third" style="xhtml" /></div>
  			<div class="span3"><jdoc:include type="modules" name="footer_onefourth_fourth" style="xhtml" /></div>
  		</div>
  	<?php endif ?>		
  	</<?php echo $div; ?>>
  	</<?php echo $footer; ?>>
  	<!--eof footer-->
  <?php endif ?>

  <?php //if ($row22 or $row23 or $row24 or $row25): ?>
  <!--copyright-->
  <<?php echo $div; ?> id="copyright">
  <<?php echo $div; ?> class="container">

  <?php if($row22) : ?>
  	<div class="row-fluid row22">
  		<div class="span12">
  			<jdoc:include type="modules" name="position-14" style="xhtml" />
  		</div>
  	</div>
  <?php endif; ?>

  <?php //if ($row23): ?>
  <div class="row-fluid row23">
  	<div class="span6">
  		<jdoc:include type="modules" name="copyright_onehalf_first" style="xhtml" /></div>
  		<div class="span6">
  			<p class="pull-right copyright">Copyright &copy; <?php echo date('Y'); ?> - All Rights Reserved</p>
  			<jdoc:include type="modules" name="copyright_onehalf_second" style="xhtml" /></div>
  		</div>
  		<?php //endif ?>

  		<?php if ($row24): ?>
  			<div class="row-fluid row24">
  				<div class="span4"><jdoc:include type="modules" name="copyright_onethird_first" style="xhtml" /></div>
  				<div class="span4"><jdoc:include type="modules" name="copyright_onethird_second" style="xhtml" /></div>
  				<div class="span4"><jdoc:include type="modules" name="copyright_onethird_third" style="xhtml" /></div>
  			</div>
  		<?php endif ?>

  		<?php if ($row25): ?>
  			<div class="row-fluid row25">
  				<div class="span3"><jdoc:include type="modules" name="copyright_onefourth_first" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="copyright_onefourth_second" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="copyright_onefourth_third" style="xhtml" /></div>
  				<div class="span3"><jdoc:include type="modules" name="copyright_onefourth_fourth" style="xhtml" /></div>
  			</div>
  		<?php endif ?>	


  		</<?php echo $div; ?>>

  		</<?php echo $div; ?>>
  		<!--eof copyright-->
  		<?php //endif ?>

  		<?php if($this->countModules('script')) : ?>
  			<div id="script">
  				<jdoc:include type="modules" name="script" style="none" />
  			</div>
  		<?php endif; ?>

  		<?php if($this->countModules('debug')) : ?>
  			<div id="debug">
  				<jdoc:include type="modules" name="debug" style="none" />
  			</div>
  		<?php endif; ?>

  	</body>
  	</html>