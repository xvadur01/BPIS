<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Record/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9304819975', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbb80fbccea3_content')) { function _lbb80fbccea3_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:default"), ENT_COMPAT) ?>
">frontrecord</a>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:add"), ENT_COMPAT) ?>
">add</a>

<table>
	<tr>
		<th>id</th>
		<th>nazev</th>
		<th>popis</th>
		<th>datum</th>
		<th>datupm splneni</th>
	</tr>
<?php if ($records) { $iterations = 0; foreach ($records as $record) { ?>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($record->id, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($record->nazev, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($record->popis, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($record->datum, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($record->datum_splneni, ENT_NOQUOTES) ?></td>
			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:delete", array($record->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/delete.png" width='25' alt="smazat"></a><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:edit", array($record->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/edit.png" width='25' alt="edit"></a></td>

		</tr>
<?php $iterations++; } } ?>
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
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 