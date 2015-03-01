<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Event/detail.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4853155749', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbb7b2d0ff39_headerH1')) { function _lbb7b2d0ff39_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Událost: <?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbcb73af781e_content')) { function _lbcb73af781e_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="event">
	<p><?php echo Latte\Runtime\Filters::escapeHtml($event->popis, ENT_NOQUOTES) ?><p>
	<p><?php echo Latte\Runtime\Filters::escapeHtml($event->datum, ENT_NOQUOTES) ?><p>
	<p><?php echo Latte\Runtime\Filters::escapeHtml($event->zapis, ENT_NOQUOTES) ?><p>

</div>
<?php $_l->tmp = $_control->getComponent("eventPlaning"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
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

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 