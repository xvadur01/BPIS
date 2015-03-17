<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Event/add.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3685693836', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb6eee1a81f6_headerH1')) { function _lb6eee1a81f6_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Nová událost<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb9ea2313671_scripts')) { function _lb9ea2313671_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacros::callBlockParent($_b, 'scripts', get_defined_vars()) ?>  
<script type="text/javascript">

	$(document).ready(function()
    {
      	$(".clockpicker").clockpicker({
			placement: 'top',
			donetext: 'Vložit',
			afterDone: function() {
                $('.active2').click();
			},

		});

		/*$('.time-input input').click(function(){
			$(this).parent().addClass('active2');
		});

		$('.time-input').click(function(){
			$(this).find('label:first').addClass('active');
			$(this).find('label:first').click();
			$(this).removeClass('active2');
		});*/

		$("form input:checkbox").click(function(){
			if(this.checked)
			{
				$("form input:checkbox").attr ( "checked" , false );
				this.checked = true;
			}
			else
			{
				$("form input:checkbox").attr ( "checked" , false );
			}
		});

	});
</script>
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6fd8d42e06_content')) { function _lb6fd8d42e06_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["eventForm"], array()) ?>

<div class="row">
	<div class="input-field">
		<?php if ($_label = $_form["nazev"]->getLabel()) echo $_label  ?>

		<?php echo $_form["nazev"]->getControl() ?>

	</div>
</div>
<div class="row">
	<div class="input-field">
		<?php if ($_label = $_form["popis"]->getLabel()) echo $_label  ?>

		<?php echo $_form["popis"]->getControl() ?>

	</div>
</div>
<div class="row">
	<div class="s12 input-field">
		<?php echo $_form["misto"]->getControl() ?>

		<?php if ($_label = $_form["misto"]->getLabel()) echo $_label  ?>

	</div>
</div>
<div class="row">
	<div class="input-field">
		<?php if ($_label = $_form["zapis"]->getLabel()) echo $_label  ?>

		<?php echo $_form["zapis"]->getControl() ?>

	</div>
</div>
<div id="<?php echo $_control->getSnippetId('itemsList') ?>"><?php call_user_func(reset($_b->blocks['_itemsList']), $_b, $template->getParameters()) ?>
</div><div class='row'>
	<?php echo $_form["dates-add"]->getControl()->addAttributes(array('class'=>'ajax btn btn-default')) ?>

</div>
<div class='row right-align'>
	<?php if ($_label = $_form["send"]->getLabel()) echo $_label  ?>

    <?php echo $_form["send"]->getControl()->addAttributes(array('class'=>'btn btn-default')) ?>

</div>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>

<?php
}}

//
// block _itemsList
//
if (!function_exists($_b->blocks['_itemsList'][] = '_lb97bc260ed2__itemsList')) { function _lb97bc260ed2__itemsList($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('itemsList', FALSE)
?><h5>Vyhovující termíny:</h5>
	<div class="row">
<?php $iterations = 0; foreach ($form['dates']->containers as $dateid => $user) { ?>
		<div class="col s12 m3 l3 z-depth-2 eventcard" >
			<div class="col s12">
				<?php echo $_form["dates-$dateid-remove"]->getControl()->addAttributes(array('class'=>'ajax btn btn-flat eventbutton')) ?>

			</div>
			<div class="input-field col s12">
				<?php echo Latte\Runtime\Filters::escapeHtml($user['datum']->label, ENT_NOQUOTES) ;echo Latte\Runtime\Filters::escapeHtml($user['datum']->control, ENT_NOQUOTES) ?>

			</div>
			<div class="col s12">
<?php $iterations = 0; foreach ($user['times']->containers as $timeid => $time) { ?>
					<div class="col input-field s12 checkBox">
						<?php $_input = is_object($time['pick']) ? $time['pick'] : $_form[$time['pick']]; echo $_input->getControlPart("") ?>

						<?php $_input = is_object($time['pick']) ? $time['pick'] : $_form[$time['pick']]; if ($_label = $_input->getLabelPart("")) echo $_label  ?>

					</div>
					<div class="col input-field s6 time-input">
							<?php echo Latte\Runtime\Filters::escapeHtml($time['cas']->label, ENT_NOQUOTES) ;echo Latte\Runtime\Filters::escapeHtml($time['cas']->control, ENT_NOQUOTES) ?>

							<?php echo Latte\Runtime\Filters::escapeHtml($time['id']->label, ENT_NOQUOTES) ;echo Latte\Runtime\Filters::escapeHtml($time['id']->control, ENT_NOQUOTES) ?>

					</div>
					<div class="col s6">
						<?php echo $_form["dates-$dateid-times-$timeid-remove"]->getControl()->addAttributes(array('class'=>'ajax btn btn-flat eventRemoveTime')) ?>

					</div>
<?php $iterations++; } ?>
				<div class="col s12">
					<?php echo $_form["dates-$dateid-times-add"]->getControl()->addAttributes(array('class'=>'ajax btn btn-flat eventbutton')) ?>

				</div>
			</div>
		</div>
<?php $iterations++; } ?>

	</div>
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