<?php
/*--------------------------------------------------------------------------------------------------------|  www.vdm.io  |------/
    __      __       _     _____                 _                                  _     __  __      _   _               _
    \ \    / /      | |   |  __ \               | |                                | |   |  \/  |    | | | |             | |
     \ \  / /_ _ ___| |_  | |  | | _____   _____| | ___  _ __  _ __ ___   ___ _ __ | |_  | \  / | ___| |_| |__   ___   __| |
      \ \/ / _` / __| __| | |  | |/ _ \ \ / / _ \ |/ _ \| '_ \| '_ ` _ \ / _ \ '_ \| __| | |\/| |/ _ \ __| '_ \ / _ \ / _` |
       \  / (_| \__ \ |_  | |__| |  __/\ V /  __/ | (_) | |_) | | | | | |  __/ | | | |_  | |  | |  __/ |_| | | | (_) | (_| |
        \/ \__,_|___/\__| |_____/ \___| \_/ \___|_|\___/| .__/|_| |_| |_|\___|_| |_|\__| |_|  |_|\___|\__|_| |_|\___/ \__,_|
                                                        | |                                                                 
                                                        |_| 				
/-------------------------------------------------------------------------------------------------------------------------------/

	@version		2.6.x
	@created		30th April, 2015
	@package		Component Builder
	@subpackage		default.php
	@author			Llewellyn van der Merwe <http://vdm.bz/component-builder>	
	@github			Joomla Component Builder <https://github.com/vdm-io/Joomla-Component-Builder>
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html 
	
	Builds Complex Joomla Components 
                                                             
/-----------------------------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access'); 

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
?>
<?php if ($this->canDo->get('get_snippets.access')): ?>
<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task === 'get_snippets.back') {
			parent.history.back();
			return false;
		} else {
			var form = document.getElementById('adminForm');
			form.task.value = task;
			form.submit();
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_componentbuilder&view=get_snippets'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
</form>
<div id="snippets-github" class="bulk-updater-toggler">
	<br /><br /><br />
	<center><h1><?php echo JText::_('COM_COMPONENTBUILDER_THE_SNIPPETS_IS_LOADING'); ?>.<span class="loading-dots">.</span></h1></center>
</div>
<div class="bulk-updater-toggler uk-hidden">
		<h1><?php echo JText::_('COM_COMPONENTBUILDER_SNIPPETS_BULK_TOOLS'); ?></h1>
</div>
<div id="snippets-display" style="display: none;">
	<div class="uk-hidden-small">
		<nav class="uk-navbar uk-width-1-1">
			<a href="https://github.com/vdm-io/Joomla-Component-Builder-Snippets" class="uk-navbar-brand uk-hidden-medium" target="_blank"><i class="uk-icon-github"></i> gitHub</a>
			<ul class="uk-navbar-nav snippets-menu bulk-updater-toggler">
				<li data-uk-filter="" class="uk-active"><a href=""><i class="uk-icon-asterisk"></i><span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_ALL'); ?></span></a></li>
				<li data-uk-filter="equal"><a href=""><i class="uk-icon-chain"></i><span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_IN_SYNC'); ?></span></a></li>
				<li data-uk-filter="behind"><a href=""><i class="uk-icon-chain-broken"></i><span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_OUT_OF_DATE'); ?></span></a></li>
				<li data-uk-filter="new"><a href=""><i class="uk-icon-coffee"></i><span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_NEW'); ?></span></a></li>
				<li data-uk-filter="diverged"><a href=""><i class="uk-icon-code-fork"></i><span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_DIVERGED'); ?></span></a></li>
				<li data-uk-filter="ahead"><a href=""><i class="uk-icon-joomla"></i><span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_AHEAD'); ?></span></a></li>
				<li data-uk-sort="snippet-name">
					<a href="">
						<i class="uk-icon-sort-amount-asc"></i>
						<span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_NAME_ASC'); ?></span>
						<span class="uk-visible-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_NAME'); ?></span>
					</a>
				</li>
				<li data-uk-sort="snippet-name:desc">
					<a href="">
						<i class="uk-icon-sort-amount-desc"></i>
						<span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_NAME_DESC'); ?></span>
						<span class="uk-visible-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_NAME'); ?></span>
					</a>
				</li>
				<li data-uk-sort="snippet-libraries">
					<a href="">
						<i class="uk-icon-sort-amount-asc"></i>
						<span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_LIBRARY_ASC'); ?></span>
						<span class="uk-visible-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_LIBRARY'); ?></span>
					</a>
				</li>
				<li data-uk-sort="snippet-libraries:desc">
					<a href="">
						<i class="uk-icon-sort-amount-desc"></i>
						<span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_LIBRARY_DESC'); ?></span>
						<span class="uk-visible-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_LIBRARY'); ?></span>
					</a>
				</li>
				<li data-uk-sort="snippet-types">
					<a href="">
						<i class="uk-icon-sort-amount-asc"></i>
						<span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_TYPE_ASC'); ?></span>
						<span class="uk-visible-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_TYPE'); ?></span>
					</a>
				</li>
				<li data-uk-sort="snippet-types:desc">
					<a href="">
						<i class="uk-icon-sort-amount-desc"></i>
						<span class="uk-hidden-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_TYPE_DESC'); ?></span>
						<span class="uk-visible-medium"> <?php echo JText::_('COM_COMPONENTBUILDER_TYPE'); ?></span>
					</a>
				</li>
			</ul>
			<div class="uk-navbar-flip">
				<ul class="uk-navbar-nav">
					<li>
						<a class="getreaction" data-uk-toggle="{target:'.bulk-updater-toggler', animation:'uk-animation-slide-bottom, uk-animation-slide-bottom'}" data-type="bulk" title="<?php echo JText::_('COM_COMPONENTBUILDER_ACCESS_BULK_TOOLS'); ?>">
							<i class="uk-icon-cog"></i>
							<span class="uk-hidden-medium"><?php echo JText::_('COM_COMPONENTBUILDER_BULK'); ?></span>
						</a>
					</li>
				</li>
			</div>
		</nav>
	</div>
	<div class="uk-visible-small">
		<nav class="uk-navbar uk-width-1-1">
			<ul class="uk-navbar-nav snippets-menu">
				<li data-uk-filter="" class="uk-active"><a href=""><i class="uk-icon-asterisk"></i></a></li>
				<li data-uk-filter="equal"><a href=""><i class="uk-icon-chain"></i></a></li>
				<li data-uk-filter="behind"><a href=""><i class="uk-icon-chain-broken"></i></a></li>
				<li data-uk-filter="new"><a href=""><i class="uk-icon-coffee"></i></a></li>
				<li data-uk-filter="diverged"><a href=""><i class="uk-icon-code-fork"></i></a></li>
				<li data-uk-filter="ahead"><a href=""><i class="uk-icon-joomla"></i></a></li>
				<li><a class="getreaction" data-uk-toggle="{target:'.bulk-updater-toggler', animation:'uk-animation-slide-bottom, uk-animation-slide-bottom'}" data-type="bulk" title="<?php echo JText::_('COM_COMPONENTBUILDER_ACCESS_BULK_TOOLS'); ?>"><i class="uk-icon-cog"></i></a></li>
			</ul>
		</nav>
	</div>
	<div class="bulk-updater-toggler uk-hidden">
		<br />
		<div class="uk-grid" data-uk-grid-match="{target:'.uk-panel'}">
			<div class="uk-width-medium-1-4">
				<div class="uk-panel uk-panel-box uk-panel-box-primary">
					<h3 class="uk-panel-title"><i class="uk-icon-chain-broken"></i> <?php echo JText::_('COM_COMPONENTBUILDER_OUT_OF_DATE'); ?></h3>
					<div id="bulk-notice-behind" class="uk-alert uk-alert-warning" style="display: none;"><?php echo JText::_('COM_COMPONENTBUILDER_THERE_ARE_NO_OUT_OF_DATE_SNIPPETS_AT_THIS_TIME'); ?></div>
					<button id="bulk-button-behind" class="getreaction uk-button uk-button-primary uk-width-1-1" data-status="behind" data-type="all" title="<?php echo JText::_('COM_COMPONENTBUILDER_BULK_UPDATE_ALL_OUT_DATED_SNIPPETS'); ?>">
						<i class="uk-icon-cloud-download"></i>
						<?php echo JText::_('COM_COMPONENTBUILDER_UPDATE_ALL_OUT_DATED_SNIPPETS'); ?>
					</button>
				</div>
			</div>
			<div class="uk-width-medium-1-4">
				<div class="uk-panel uk-panel-box uk-panel-box-primary">
					<h3 class="uk-panel-title"><i class="uk-icon-coffee"></i> <?php echo JText::_('COM_COMPONENTBUILDER_NEW'); ?></h3>
					<div id="bulk-notice-new" class="uk-alert uk-alert-warning" style="display: none;"><?php echo JText::_('COM_COMPONENTBUILDER_THERE_ARE_NO_NEW_SNIPPETS_AT_THIS_TIME'); ?></div>
					<button id="bulk-button-new" class="getreaction uk-button uk-button-primary uk-width-1-1" data-status="new" data-type="all" title="<?php echo JText::_('COM_COMPONENTBUILDER_BULK_GET_ALL_NEW_SNIPPETS'); ?>">
						<i class="uk-icon-cloud-download"></i>
						<?php echo JText::_('COM_COMPONENTBUILDER_GET_ALL_NEW_SNIPPETS'); ?>
					</button>
				</div>
			</div>
			<div class="uk-width-medium-1-4">
				<div class="uk-panel uk-panel-box uk-panel-box-primary">
					<h3 class="uk-panel-title"><i class="uk-icon-code-fork"></i> <?php echo JText::_('COM_COMPONENTBUILDER_DIVERGED'); ?></h3>
					<div id="bulk-notice-diverged" class="uk-alert uk-alert-warning" style="display: none;"><?php echo JText::_('COM_COMPONENTBUILDER_THERE_ARE_NO_DIVERGED_SNIPPETS_AT_THIS_TIME'); ?></div>
					<button id="bulk-button-diverged" class="getreaction uk-button uk-button-primary uk-width-1-1" data-status="diverged" data-type="all" title="<?php echo JText::_('COM_COMPONENTBUILDER_BULK_UPDATE_ALL_DIVERGED_SNIPPETS'); ?>">
						<i class="uk-icon-cloud-download"></i>
						<?php echo JText::_('COM_COMPONENTBUILDER_UPDATE_ALL_DIVERGED_SNIPPETS'); ?>
					</button>
				</div>
			</div>
			<div class="uk-width-medium-1-4">
				<div class="uk-panel uk-panel-box uk-panel-box-primary">
					<h3 class="uk-panel-title"><i class="uk-icon-joomla"></i> <?php echo JText::_('COM_COMPONENTBUILDER_AHEAD'); ?></h3>
					<div id="bulk-notice-ahead" class="uk-alert uk-alert-warning" style="display: none;"><?php echo JText::_('COM_COMPONENTBUILDER_THERE_ARE_NO_AHEAD_SNIPPETS_AT_THIS_TIME'); ?></div>
					<button id="bulk-button-ahead" class="getreaction uk-button uk-button-primary uk-width-1-1" data-status="ahead" data-type="all" title="<?php echo JText::_('COM_COMPONENTBUILDER_BULK_UPDATE_ALL_AHEAD_SNIPPETS'); ?>">
						<i class="uk-icon-cloud-download"></i>
						<?php echo JText::_('COM_COMPONENTBUILDER_REVERT_ALL_AHEAD_SNIPPETS'); ?>
					</button>
				</div>
			</div>
		</div>
		<br />
		<div id="bulk-notice-all" class="uk-alert uk-alert-warning" style="display: none;"><?php echo JText::_('COM_COMPONENTBUILDER_THERE_ARE_NO_SNIPPETS_TO_UPDATE_AT_THIS_TIME'); ?></div>
		<button id="bulk-button-all" class="getreaction uk-button uk-button-success uk-width-1-1" data-status="all" data-type="all" title="<?php echo JText::_('COM_COMPONENTBUILDER_BULK_UPDATE_ALL_AVAILABLE_SNIPPETS'); ?>">
			<i class="uk-icon-cloud-download"></i>
			<?php echo JText::_('COM_COMPONENTBUILDER_JUST_GET_ALL_SNIPPETS'); ?>
		</button>
	</div>
	<br />
	<div id="snippets-grid" class="bulk-updater-toggler uk-grid uk-grid-preserve uk-grid-width-small-1-1 uk-grid-width-medium-1-3 uk-grid-width-large-1-4" data-uk-grid="{gutter:10, controls: '.snippets-menu'}" data-uk-check-display>
	</div>
</div>
<script type="text/javascript">
			
// nice little dot trick :)
jQuery(document).ready( function($) {
  var x=0;
  setInterval(function() {
	var dots = "";
	x++;
	for (var y=0; y < x%8; y++) {
		dots+=".";
	}
	$(".loading-dots").text(dots);
  } , 500);
});			 
</script>
<?php else: ?>
        <h1><?php echo JText::_('COM_COMPONENTBUILDER_NO_ACCESS_GRANTED'); ?></h1>
<?php endif; ?>
