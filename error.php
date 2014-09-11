<?php
defined('_JEXEC') or die('Restricted access');

require_once('index.php');

if (!isset($this->error)) {
    $this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
    $this->debug = false;
}


?>
<!doctype html>
<head>
<link rel="icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/favicon.png" type="image/png">
<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/favicon.png" type="image/png" />    
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
</head>
<body>

<div id="breadcrumbs" class="row-fluid"><div class="container-fluid"><div class="span6 offset3">
    <h1><?php echo $this->title; ?></h1>
</div></div></div>
<div id="middle" class="row-fluid"><div class="container-fluid">
    <div id="techinfo" class="span6 offset3">
        <p class="error-message"><?php echo $this->error->getMessage(); ?></p>

        <p><strong><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></strong></p>
        <ol>
            <li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
            <li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
            <li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
            <li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
            <li><?php echo JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'); ?></li>
            <li><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></li>
        </ol>
        <p><strong><?php echo JText::_('JERROR_LAYOUT_PLEASE_TRY_ONE_OF_THE_FOLLOWING_PAGES'); ?></strong></p>

        <ul>
            <li>
                <a href="<?php echo $this->baseurl; ?>/" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>">
                    <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a>
            </li>
        </ul>

        <?php if ($this->debug) : ?>
            <p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?>.</p>

        <?php endif; ?>
    </div>
</div></div>

<?php if ($this->debug) : ?>
    <div class="content">
        <pre><?php echo $this->error->toString(); ?></pre>
        <pre><?php echo $this->error->getTraceAsString(); ?></pre>

        <?php if (class_exists('jbdump')) : ?>
            <?php jbdump::trace(true); ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

</body>
</html>
