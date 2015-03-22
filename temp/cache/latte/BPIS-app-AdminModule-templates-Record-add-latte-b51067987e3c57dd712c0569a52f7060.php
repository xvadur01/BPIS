<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Record/add.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8790279503', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbb197e1b8fb_headerH1')) { function _lbb197e1b8fb_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Nový záznam<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbba73e2bcdd_scripts')) { function _lbba73e2bcdd_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
if (!function_exists($_b->blocks['content'][] = '_lb7ff332a98c_content')) { function _lb7ff332a98c_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_l->tmp = $_control->getComponent("recordForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
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