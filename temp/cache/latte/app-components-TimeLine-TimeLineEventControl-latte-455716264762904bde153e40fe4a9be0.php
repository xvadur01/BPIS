<?php
// source: C:\xampp\htdocs\BPIS\app\components\TimeLine/TimeLineEventControl.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7797845544', 'html')
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
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Latte\Runtime\CachingIterator($data) as $event) { if ($iterator->isOdd()) { ?>
		<li>
<?php } else { ?>
		<li class="timeline-inverted">
<?php } if (!$event->datum) { ?>
			<div class="timeline-badge  blue lighten-0">
					?
			</div>
<?php } elseif ($event->datum >  new \DateTime()) { ?>
				<div class="timeline-badge  green lighten-0">
					<i class="mdi-action-event"></i>
				</div>
<?php } else { ?>
			<div class="timeline-badge grey">
				<i class="mdi-action-done"></i>
			</div>
<?php } ?>

		<div class="timeline-panel">
			<div class="timeline-heading">
				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Event:detail", array($event->id)), ENT_COMPAT) ?>
"><h4 class="timeline-title"><?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ?></h4></a>
<?php if ($type == 'event') { ?>
					<span><small class="text-muted">Organizátor: </small><?php echo Latte\Runtime\Filters::escapeHtml($event->ref('uzivatel','uzivatel_id')->prijmeni, ENT_NOQUOTES) ?> </span>
<?php } ?>
				<p>
<?php if ($event->datum) { ?>
						<small class="text-muted"><i class="glyphicon glyphicon-time">Datum konání: </i></small><?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datum, '%d.%m.%Y %H:%M'), ENT_NOQUOTES) ?>

<?php } ?>
				</p>
			</div>
			<div class="timeline-body">
				<p><?php echo Latte\Runtime\Filters::escapeHtml($template->striptags($template->truncate($event->popis, 500)), ENT_NOQUOTES) ?></p>
			</div>
			<div>
<?php if ($event->uzivatel_id == $user->getId() || $user->isInRole('admin')) { ?>
					<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link(":Admin:Event:delete", array($event->id, 'backlink' => $presenter->storeRequest())), ENT_COMPAT) ?>" title="Smazat událost" class="btn-floating waves-effect waves-light  red"><i class="mdi-action-delete"></i></a>
					<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link(":Admin:Event:edit", array($event->id)), ENT_COMPAT) ?>" title="Upravit událost" class="btn-floating waves-effect waves-light light-green accent-3"><i class="mdi-editor-mode-edit"></i></a>
<?php } ?>
				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_presenter->link("Event:detail", array($event->id)), ENT_COMPAT) ?>" title="Detail záznamu" class="btn-floating waves-effect waves-light orange"><i class="mdi-action-subject"></i></a>
			</div>
		</div>
	</li>
<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
</ul>