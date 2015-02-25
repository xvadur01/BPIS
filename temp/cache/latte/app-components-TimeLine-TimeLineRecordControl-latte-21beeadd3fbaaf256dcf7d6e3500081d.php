<?php
// source: C:\xampp\htdocs\BPIS\app\components\TimeLine/TimeLineRecordControl.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5399425079', 'html')
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
<ul class="timeline">
<?php $iterations = 0; foreach ($data as $record) { ?>
	<li>

		<div class="timeline-badge  blue lighten-0"><i class="mdi-action-done"></i>
		</div>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<h4 class="timeline-title"><?php echo Latte\Runtime\Filters::escapeHtml($record->nazev, ENT_NOQUOTES) ?></h4>
				<p>
					<small class="text-muted"><i class="glyphicon glyphicon-time"></i><?php echo Latte\Runtime\Filters::escapeHtml($template->date($record->datum, '%d.%m.%Y'), ENT_NOQUOTES) ?></small>
				</p>
			</div>
			<div class="timeline-body">
				<p><?php echo $record->popis ?></p>
			</div>
		</div>
	</li>
<?php $iterations++; } ?>
</ul>