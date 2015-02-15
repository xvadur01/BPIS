<?php
// source: C:\xampp\htdocs\BPIS\app\components\TimeLine/TimeLineEventControl.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9058312382', 'html')
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
<?php $iterations = 0; foreach ($data as $event) { ?>
	<li>

		<div class="timeline-badge  blue lighten-0"><i class="mdi-action-done"></i>
		</div>
		<div class="timeline-panel">
			<div class="timeline-heading">
				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Event:detail", array($event->id)), ENT_COMPAT) ?>
"><h4 class="timeline-title"><?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ?></h4></a>
				<p>
					<small class="text-muted"><i class="glyphicon glyphicon-time"></i><?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datum, '%d.%m.%Y'), ENT_NOQUOTES) ?></small>
				</p>
			</div>
			<div class="timeline-body">
				<p><?php echo $event->zapis ?></p>
			</div>
		</div>
	</li>
<?php $iterations++; } ?>
</ul>