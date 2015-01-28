<?php
// source: C:\xampp\htdocs\BPIS\app\FrontModule/templates/Sign/in.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9781786614', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb9db687acf2_content')) { function _lb9db687acf2_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>

<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["signInForm"], array()) ?>


<!-- Jednoduché vykreslení chyb -->
<?php if ($form->hasErrors()) { ?><ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error) { ?>        <li><?php echo Latte\Runtime\Filters::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; } ?>
</ul>
<?php } ?>


<div class="row input-field col s12 required">
    <?php if ($_label = $_form["username"]->getLabel()) echo $_label  ?>

    <?php echo $_form["username"]->getControl() ?>

</div>
<div class="row input-field col s12 required">
    <?php if ($_label = $_form["password"]->getLabel()) echo $_label  ?>

    <?php echo $_form["password"]->getControl() ?>

</div>
<div class="row input-field col s12" >
	<?php echo $_form["remember"]->getControlPart("") ?>

	<?php if ($_label = $_form["remember"]->getLabelPart("")) echo $_label  ?>

</div>
<div class="row input-field col s12 required">
    <?php if ($_label = $_form["send"]->getLabel()) echo $_label  ?>

    <?php echo $_form["send"]->getControl() ?>

</div>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>

<?php
}}

//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lbb0f36cd74b_title')) { function _lbb0f36cd74b_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>Sign in</h1>
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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 