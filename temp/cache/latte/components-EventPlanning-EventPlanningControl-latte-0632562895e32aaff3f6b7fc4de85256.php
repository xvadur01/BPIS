<?php
// source: C:\xampp\htdocs\BPIS\app\components\EventPlanning/EventPlanningControl.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7274302330', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<table class="striped bordered">
<tr>
	<th>
	</th>
<?php $iterations = 0; foreach ($data[$eventUserId] as $key => $term) { ?>
	<th class="center-align" colspan="<?php echo Latte\Runtime\Filters::escapeHtml(count($term), ENT_COMPAT) ?>">
		<?php echo Latte\Runtime\Filters::escapeHtml($key, ENT_NOQUOTES) ?>

	</th>
<?php $iterations++; } ?>
</tr>
<tr>
	<th>

		</th>
<?php $iterations = 0; foreach ($data[$eventUserId] as $term) { $iterations = 0; foreach ($term as $key => $time) { ?>
		<th class="center-align" >
			<?php echo Latte\Runtime\Filters::escapeHtml($template->date($key, 'H:i'), ENT_NOQUOTES) ?>

		</th>
<?php $iterations++; } $iterations++; } ?>
</tr>

<?php $iterations = 0; foreach ($data as $id => $user) { if ($id != $formUserId) { ?>
	<tr>
		<td class="center-align" >
			<?php echo Latte\Runtime\Filters::escapeHtml($users[$id]['prijmeni'], ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($users[$id]['jmeno'], ENT_NOQUOTES) ?>

		</td>
<?php $iterations = 0; foreach ($user as $term) { $iterations = 0; foreach ($term as $times) { $iterations = 0; foreach ($times as $time) { if ($time['vyhovuje']) { ?>
						<td class="green accent-1 center-align">
						<i class="mdi-action-done"></i>
<?php } else { ?>
						<td class="red  accent-1 center-align">
						<i class="mdi-content-clear"></i>
<?php } ?>

					</td>
<?php $iterations++; } $iterations++; } $iterations++; } ?>
	</tr>
<?php } $iterations++; } ?>

<?php if ($isForm) { ?>
	<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["eventPlanningForm"], array()) ?>

		<tr>
			<td class="center-align"><?php echo Latte\Runtime\Filters::escapeHtml($users[$formUserId]['prijmeni'], ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($users[$formUserId]['jmeno'], ENT_NOQUOTES) ?></td>
<?php $iterations = 0; foreach ($form['times']->containers as $term) { ?>
				<td class="center-align">
					<?php echo Latte\Runtime\Filters::escapeHtml($term['id']->control, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($term['id']->label, ENT_NOQUOTES) ?>

					<?php $_input = is_object($term['pick']) ? $term['pick'] : $_form[$term['pick']]; echo $_input->getControlPart("") ?>
 <?php $_input = is_object($term['pick']) ? $term['pick'] : $_form[$term['pick']]; if ($_label = $_input->getLabelPart("")) echo $_label  ?>

				</td>
<?php $iterations++; } ?>
		<tr>
		<tr>
			<td colspan="0" class="right-align">
				<?php if ($_label = $_form["send"]->getLabel()) echo $_label  ?>

				<?php echo $_form["send"]->getControl()->addAttributes(array('class'=>'btn btn-default')) ?>

			</td>
		<tr>
		</tr>
	<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>

<?php } ?>
</table>