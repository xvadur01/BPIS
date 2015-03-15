<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/User/newUserEvents.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4020864095', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbb14cd2458b_headerH1')) { function _lbb14cd2458b_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přehled dostupných událostím<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb9307aef37b_scripts')) { function _lb9307aef37b_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacros::callBlockParent($_b, 'scripts', get_defined_vars()) ?>  
<script type="text/javascript">
	$(document).ready(function() {
		$('select').material_select();
		$('.labelNoabsolute').parent().parent().addClass("labelNoabsolute");

	});
</script>
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb2e351fc2fa_content')) { function _lb2e351fc2fa_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h5>Možné události na, které je možno uživatele pozvat.</h5>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["newUserEventsForm"], array()) ?>

	<div class="row">
		<div class="input-field">
			<?php if ($_label = $_form["user_id"]->getLabel()) echo $_label  ?>

			<?php echo $_form["user_id"]->getControl() ?>

		</div>
		<div class="row">
<?php $iterations = 0; foreach ($form['events']->containers as $key => $event) { ?>
				<div class="col input-field s6">
					<?php echo Latte\Runtime\Filters::escapeHtml($event['event_id']->control, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($event['event_id']->label, ENT_NOQUOTES) ?>

					<?php echo Latte\Runtime\Filters::escapeHtml($event['event_user_id']->control, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($event['event_user_id']->label, ENT_NOQUOTES) ?>

					<?php echo Latte\Runtime\Filters::escapeHtml($event['pick']->control, ENT_NOQUOTES) ?>
  <?php echo Latte\Runtime\Filters::escapeHtml($event['pick']->label, ENT_NOQUOTES) ?>

				</div>
<?php $iterations++; } ?>
		</div>
		<div class="input-field s12">
				<?php if ($_label = $_form["send"]->getLabel()) echo $_label  ?>

				<?php echo $_form["send"]->getControl()->addAttributes(array('class'=>'btn btn-default')) ?>

		</div>
	</div>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ;
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['headerH1']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars()) ; call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 