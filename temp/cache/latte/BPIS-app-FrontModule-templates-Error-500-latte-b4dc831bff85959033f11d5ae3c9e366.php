<?php
// source: C:\xampp\htdocs\BPIS\app\FrontModule/templates/Error/500.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9220710773', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb33f25923c7_headerH1')) { function _lb33f25923c7_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>500 - Internal Server Error<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb2fd6076d61_content')) { function _lb2fd6076d61_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><p>Omlouváme se, máme tam chybu.</p>
</script>
<?php
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