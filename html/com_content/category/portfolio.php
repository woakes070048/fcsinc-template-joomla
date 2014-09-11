<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

JHtml::_('behavior.caption');
$count_items = count($this->items);
for ($i=1; $i < $this->params->get('num_intro_articles'); $i++) { 
	if ($i < $count_items) 
		$this->intro_items[$i] = $this->items[$i];
}

?>
<div id="portfolio" class="span12 <?php echo $this->pageclass_sfx;?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif; ?>
	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
	<h2> <?php echo $this->escape($this->params->get('page_subheading')); ?>
		<?php if ($this->params->get('show_category_title')) : ?>
		<span class="subheading-category"><?php echo $this->category->title;?></span>
		<?php endif; ?>
	</h2>
	<?php endif; ?>

	<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
	<div class="category-desc">
		<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
			<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
		<?php endif; ?>
		<?php if ($this->params->get('show_description') && $this->category->description) : ?>
			<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
		<?php endif; ?>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php 
		$portfolioCategories = array();
		foreach ($this->intro_items as $key => &$item){
				$categoryTitle = strtolower(str_replace(" ","_",$item->category_title));
				$portfolioCategories[] = $categoryTitle;
		}; 

		$portfolioCategories = array_unique($portfolioCategories);
	?>
	
<?php if ($this->params->get('show_filters', 1)): ?>
	<div class="row">
		<div class="filters span12">

			<ul id="filtrable">
				<li><a href="#" data-filter="*" class="selected"><?php echo JText::_('TPL_COM_CONTENT_PORTFOLIO_FILTER_SHOW_ALL'); ?></a></li>
				<?php foreach ($portfolioCategories as $key => $value) : ?>
					<li><a class="" href="#"data-filter=".<?php echo $value; ?>"><?php echo ucwords(str_replace("_"," ",$value)); ?></a></li>
				<?php endforeach; ?>
			</ul>
			
			<div class="clearfix"></div>
		</div>
	</div>
<?php endif; ?>
	<!-- Items -->


	<?php if (!empty($this->intro_items)) : ?>


		<ul id="portfolioContainer" class="items-row row cols-<?php echo (int) $this->params->get('num_columns'); ?> thumbnails da-thumbs portfolio filtrable clearfix">

		<?php foreach ($this->intro_items as $key => &$item) : ?>
			
				<?php ($this->params->get('show_intro_portfolio') or $this->params->get('show_readmore')) ? $li_class='margin_bottom' : $li_class='no_margin_bottom'; ?>

				<?php ($key % $this->params->get('num_columns') == 1 )  ? $li_class .= ' first_in_row' : $li_class='no_margin_bottom'; ?>
				
				<li class="item <?php echo $li_class; ?> span<?php echo round(12 / $this->params->get('num_columns'));?> <?php echo strtolower(str_replace(" ","_",$item->category_title)); ?>">
						<?php
						$this->item = &$item;
						echo $this->loadTemplate('item');
					?>
					
					<!--<div class="clearfix"></div>-->
				</li><!-- end span -->

		<?php endforeach; ?>
		</ul><!-- end row -->
	<?php endif; ?>

	<?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
	<div class="pagination">
		<?php  if ($this->params->def('show_pagination_results', 1)) : ?>
		<p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
		<?php endif; ?>
		<?php echo $this->pagination->getPagesLinks(); ?> </div>
	<?php  endif; ?>
</div>