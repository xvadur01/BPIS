<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/FrontPage/edit.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7695684186', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb9d5afbcaa0_headerH1')) { function _lb9d5afbcaa0_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Úprava stránky<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbfcdd32372a_scripts')) { function _lbfcdd32372a_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> <?php Latte\Macros\BlockMacros::callBlockParent($_b, 'scripts', get_defined_vars()) ?>  
<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript">
	   $().ready(function() {
        var elf = $('#elfinder').elfinder({
            // lang: 'ru',             // language (OPTIONAL)
            url : <?php echo Latte\Runtime\Filters::escapeJs($basePath) ?>+'/elfinder/php/connector.php'  // connector URL (REQUIRED)
        }).elfinder('instance');
    });
	CKEDITOR.replace( 'editor', {
    filebrowserBrowseUrl : <?php echo Latte\Runtime\Filters::escapeJs($basePath) ?>+'/elfinder/elfinder.html', // eg. 'includes/elFinder/elfinder.html'
    uiColor : '#9AB8F3'
});
</script>
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb728dd46e28_content')) { function _lb728dd46e28_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("frontPageForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
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

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 