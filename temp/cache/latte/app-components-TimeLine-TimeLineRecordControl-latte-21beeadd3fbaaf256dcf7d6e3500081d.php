<?php
// source: C:\xampp\htdocs\BPIS\app\components\TimeLine/TimeLineRecordControl.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1499067637', 'html')
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
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($data) as $record) { if ($iterator->isOdd()) { ?>
		<li>
<?php } else { ?>
		<li class="timeline-inverted">
<?php } if ($record->done) { ?>
				<div class="timeline-badge  green lighten-0">
					<i class="mdi-action-done"></i>
				</div>
<?php } elseif ($record->date_done && $record->date_done <  new \DateTime()) { ?>
				<div class="timeline-badge  red lighten-0">
					<i class="mdi-alert-error"></i>
				</div>
<?php } else { ?>
				<div class="timeline-badge  blue lighten-0">
					<i class="mdi-action-event"></i>
				</div>
<?php } ?>

		<div class="timeline-panel">
			<div class="timeline-heading">
				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Record:detail", array($record->id)), ENT_COMPAT) ?>
"><h4 class="timeline-title"><?php echo Latte\Runtime\Filters::escapeHtml($record->name, ENT_NOQUOTES) ?></h4></a>
				<p>
					<small class="text-muted">Datum zahájení:</small> <i class="glyphicon glyphicon-time"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($record->date, '%d.%m.%Y'), ENT_NOQUOTES) ?></i>
					<br>
					<small class="text-muted">Předpokládané datum ukončení:</small> <i class="glyphicon glyphicon-time"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($record->date_done, '%d.%m.%Y'), ENT_NOQUOTES) ?></i>
				</p>
			</div>
			<div class="timeline-body">
				<p><?php echo $template->truncate($record->description, 700) ?></p>
			</div>
			<div>
<?php if ($record->user_id == $user->getId()) { if (!$record->done) { ?>
						<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link(":Admin:Record:finish", array($record->id, 'backlink' => $presenter->storeRequest())), ENT_COMPAT) ?>" title="Dokončit" class="btn-floating waves-effect waves-light  light-blue"><i class="mdi-action-done"></i></a>
<?php } ?>
					<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link(":Admin:Record:delete", array($record->id, 'backlink' => $presenter->storeRequest())), ENT_COMPAT) ?>" title="Smazat záznam" class="btn-floating waves-effect waves-light  red"><i class="mdi-action-delete"></i></a>
					<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link(":Admin:Record:edit", array($record->id)), ENT_COMPAT) ?>" title="Upravit záznam" class="btn-floating waves-effect waves-light light-green accent-3"><i class="mdi-editor-mode-edit"></i></a>
<?php } ?>
				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link(":Admin:Record:detail", array($record->id)), ENT_COMPAT) ?>" title="Detail záznamu" class="btn-floating waves-effect waves-light orange"><i class="mdi-action-subject"></i></a>
			</div>
		</div>
	</li>
<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
</ul>



