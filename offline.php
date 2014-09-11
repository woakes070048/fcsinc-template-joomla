<?php // no direct access 
defined( '_JEXEC' ) or die( 'Restricted access' );
$app = JFactory::getApplication();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/favicon.png" type="image/png">
<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/favicon.png" type="image/png" />	
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />


</head>

<body>
	<div id="logo" class="row-fluid"><div class="container-fluid">
		<div class="span6 offset3">
			
		</div>
	</div></div>
	<div id="breadcrumbs" class="row-fluid"><div class="container-fluid"><div class="span6 offset3">
		<h1><?php echo htmlspecialchars($app->getCfg('sitename')); ?></h1>
	</div></div></div>
	<div id="middle" class="row-fluid"><div class="container-fluid"><div class="span6 offset3">
	<jdoc:include type="message" />
		<div id="frame" class="outline">
			<?php if ($app->getCfg('offline_image')) : ?>
			<img src="<?php echo $app->getCfg('offline_image'); ?>" alt="<?php echo htmlspecialchars($app->getCfg('sitename')); ?>" />
			<?php endif; ?>
		<?php if ($app->getCfg('display_offline_message', 1) == 1 && str_replace(' ', '', $app->getCfg('offline_message')) != ''): ?>
			<p>
				<?php echo $app->getCfg('offline_message'); ?>
			</p>
		<?php elseif ($app->getCfg('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != ''): ?>
			<p>
				<?php echo JText::_('JOFFLINE_MESSAGE'); ?>
			</p>
		<?php  endif; ?>

       	<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login">
			<fieldset class="input">
				<p id="form-login-username">
					<label for="username"><?php echo JText::_('JGLOBAL_USERNAME') ?></label>
					<input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME') ?>" size="18" />
				</p>
				<p id="form-login-password">
					<label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
					<input type="password" name="password" class="inputbox" size="18" alt="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" id="passwd" />
				</p>
				<p id="form-login-remember">
					<label for="remember" class="checkbox"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>
						<input type="checkbox" name="remember" class="inputbox" value="yes" alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" id="remember" />
					</label>
					
				</p>
				<input type="submit" name="Submit" class="button btn" value="<?php echo JText::_('JLOGIN') ?>" />
				<input type="hidden" name="option" value="com_users" />
				<input type="hidden" name="task" value="user.login" />
				<input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
				<?php echo JHtml::_('form.token'); ?>
			</fieldset>
		</form>
	</div></div></div>
</body>
</html>