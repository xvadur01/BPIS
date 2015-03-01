<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Event/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7701210268', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbbf1c4ec96c_headerH1')) { function _lbbf1c4ec96c_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přehled událostí<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lba2472e8749_content')) { function _lba2472e8749_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
	<div class="col s9">
		<a title="Nová událost" class="right-align btn-floating btn-large waves-effect waves-light blue" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:add"), ENT_COMPAT) ?>
"><i class="mdi-content-add"></i></a>
	</div>
	<div class="col s3">
		<a class="waves-effect waves-light btn-large right-align grey" title="TimeLine výpis" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:list"), ENT_COMPAT) ?>
"><i class="mdi-action-question-answer"></i></a>
	</div>
</div>

<table class=" striped responsive-table">
	<tr>
		<th>id</th>
		<th>název</th>
		<th>popis</th>
		<th>datum konání</th>
		<th>zápis</th>
		<th>vytvořil</th>
		<th>počet upozornění</th>
		<th></th>
	</tr>

<?php $iterations = 0; foreach ($events as $event) { ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->id, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($template->striptags($template->truncate($event->popis, 500)), ENT_NOQUOTES) ?></td>
		<td>
<?php if ($event->datum) { ?>
				<?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datum, '%d.%m.%Y'), ENT_NOQUOTES) ?>

<?php } else { ?>
				Datum konání není určen
<?php } ?>
		</td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($template->striptags($template->truncate($event->zapis, 500)), ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->ref('uzivatel','uzivatel_id')->prijmeni, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->pocet_upozorneni, ENT_NOQUOTES) ?></td>
		<td>
			<a title="Smazat událost" class="btn-floating waves-effect waves-light  red" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:delete", array($event->id)), ENT_COMPAT) ?>
"><i class="mdi-action-delete"></i></a>
			<a title="Upravit událost" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:edit", array($event->id)), ENT_COMPAT) ?>
"><i class="mdi-editor-mode-edit"></i></a>
		</td>
	</tr>
<?php $iterations++; } ?>
</table><?php
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


<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 