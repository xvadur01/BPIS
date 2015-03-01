<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Event/users.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1036844752', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbdb8a68259d_headerH1')) { function _lbdb8a68259d_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Pozvání uživalů k události<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lba6738086f6_scripts')) { function _lba6738086f6_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacros::callBlockParent($_b, 'scripts', get_defined_vars()) ?>  
<script type="text/javascript">

	$(document).ready(function()
    {
		$(".pick-all").click(function(){
			$("form input:checkbox").attr ( "checked" , false ).click();
		});

		$(".unpick-all").click(function(){
			$("form input:checkbox").attr ( "checked" , true ).click();
		});

	});
</script>
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb200953d604_content')) { function _lb200953d604_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["usersEventForm"], array()) ?>


<div class="row">
<?php $iterations = 0; foreach ($users as $user) { ?>
	<div class="col input-field s4">
		<?php echo $_form["select-{$user->id}"]->getControlPart("") ?>

		<?php if ($_label = $_form["select-{$user->id}"]->getLabelPart("")) echo $_label  ?>

	</div>
<?php $iterations++; } ?>

</div>
<div class='row left-align'>
	<a class="pick-all waves-effect waves-light btn">Vybrat vše</a>
	<a class="unpick-all waves-effect waves-light btn">zrušit vše</a>
</div>
<div class='row right-align'>
	<?php if ($_label = $_form["send"]->getLabel()) echo $_label  ?>

    <?php echo $_form["send"]->getControl()->addAttributes(array('class'=>'btn btn-default')) ?>

</div>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>

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

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars()) ; call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 