<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Event/list.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3609927157', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbfc9834a0e0_headerH1')) { function _lbfc9834a0e0_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Historie událostí<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbe933fd02ff_content')) { function _lbe933fd02ff_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
	<div class="col s9">
		<a title="Nová událost" class="right-align btn-floating btn-large waves-effect waves-light blue" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:add"), ENT_COMPAT) ?>
"><i class="mdi-content-add"></i></a>
	</div>
	<div class="col s3">
		<a class="waves-effect waves-light btn-large right-align grey" title="Tabulkový výpis" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:default"), ENT_COMPAT) ?>
"><i class="mdi-editor-format-align-justify"></i></a>
	</div>
</div>
<?php $_l->tmp = $_control->getComponent("timeLine"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
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