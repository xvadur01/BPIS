<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Admin/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5235299908', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbe5395e15fc_content')) { function _lbe5395e15fc_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("FrontPage:default"), ENT_COMPAT) ?>
">frontpage</a>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("FrontPage:add"), ENT_COMPAT) ?>
">frontpage</a>

<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:default"), ENT_COMPAT) ?>
">record</a>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:default"), ENT_COMPAT) ?>
">borrow</a><?php
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
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 