<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Record/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0731422208', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbddd30e2acf_headerH1')) { function _lbddd30e2acf_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přehled záznamů<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb7559fab487_content')) { function _lb7559fab487_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
	<div class="col s9">
		<a title="Nový záznam" class="right-align btn-floating btn-large waves-effect waves-light blue" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:add"), ENT_COMPAT) ?>
"><i class="mdi-content-add"></i></a>
	</div>
	<div class="col s3">
		<a class="waves-effect waves-light btn-large right-align grey" title="TimeLine výpis" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:list"), ENT_COMPAT) ?>
"><i class="mdi-action-question-answer"></i></a>
	</div>
</div>
<table class=" striped responsive-table">
	<tr>
		<th>id</th>
		<th>nazev</th>
		<th>popis</th>
		<th>datum</th>
		<th>datupm splneni</th>
		<th></th>
	</tr>
<?php if ($records) { $iterations = 0; foreach ($records as $record) { ?>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($record->id, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($record->nazev, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($template->striptags($template->truncate($record->popis, 500)), ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($record->datum, '%d.%m.%Y'), ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($record->datum_splneni, '%d.%m.%Y'), ENT_NOQUOTES) ?></td>
			<td>
				<a title="Smazat záznam" class="btn-floating waves-effect waves-light  red" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:delete", array($record->id)), ENT_COMPAT) ?>
"><i class="mdi-action-delete"></i></a>
				<a title="Upravit záznam" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:edit", array($record->id)), ENT_COMPAT) ?>
"><i class="mdi-editor-mode-edit"></i></a>
			</td>
		</tr>
<?php $iterations++; } } ?>
</table>
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


<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 