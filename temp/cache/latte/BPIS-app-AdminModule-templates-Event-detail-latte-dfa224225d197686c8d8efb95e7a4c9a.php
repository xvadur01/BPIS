<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Event/detail.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0963697315', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb55bcad3ebd_headerH1')) { function _lb55bcad3ebd_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><i>Událost:</i> <?php echo Latte\Runtime\Filters::escapeHtml($event->name, ENT_NOQUOTES) ;
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb7af6cd4e79_scripts')) { function _lb7af6cd4e79_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacros::callBlockParent($_b, 'scripts', get_defined_vars()) ?>  
<?php if ($event->user_id == $user->getId()) { ?>
	<script type="text/javascript">

		$(document).ready(function()
		{
			$("input:checkbox").click(function(){
			if(this.checked)
			{
				$("input:checkbox").attr ( "checked" , false );
				this.checked = true;
			}
			else
			{
				$("input:checkbox").attr ( "checked" , false );

			}
			});
		});
	</script>
<?php } 
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb5aa7de6a46_content')) { function _lb5aa7de6a46_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="event row">
	<div class="col s12 card">
		<p><i>Pořadatel:</i></p>
		<p><?php echo Latte\Runtime\Filters::escapeHtml($userRef->surname, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($userRef->name, ENT_NOQUOTES) ?></p>

	</div>
	<div class="col s12 card">
		<p><i>Datum konání:</i></p>
<?php if ($event->date) { ?>
			<p><?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->date, '%d.%m.%Y %H:%M'), ENT_NOQUOTES) ?><p>
<?php } else { ?>
			<p>Datum prozatím není určen.<p>
<?php } ?>
	</div>
	<div class="col s12 card">
		<p><i>Popis:</i></p>
		<p><?php echo Latte\Runtime\Filters::escapeHtml($event->description, ENT_NOQUOTES) ?><p>
	</div>
	<div class="col s12 card">
		<p><i>Zápis:</i></p>
		<p><?php echo Latte\Runtime\Filters::escapeHtml($event->record, ENT_NOQUOTES) ?><p>
	</div>
</div>
<div class="eventTable row col s12">
<?php $_l->tmp = $_control->getComponent("eventPlaning"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
</div><?php
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