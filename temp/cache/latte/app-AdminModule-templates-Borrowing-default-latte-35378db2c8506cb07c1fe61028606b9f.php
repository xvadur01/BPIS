<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Borrowing/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5213696325', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb039fcfbdb0_content')) { function _lb039fcfbdb0_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:default"), ENT_COMPAT) ?>
">borrowing</a>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:add"), ENT_COMPAT) ?>
">add</a>

<table class="striped">
	<thead>
	<tr>
		<th>id</th>
		<th>nazev</th>
		<th>jmeno</th>
		<th>prijmeni</th>
		<th>datum</th>
		<th>uzivatel</th>
		<th>vraceno</th>
	</tr>
	</thead>
<?php if ($borrowings) { ?>
	<tbody>
<?php $iterations = 0; foreach ($borrowings as $borrowing) { ?>
		<tr>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->id, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->nazev, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->jmeno, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->prijmeni, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->datum, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->uzivatel_id, ENT_NOQUOTES) ?></td>
			<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->vraceno, ENT_NOQUOTES) ?></td>
			<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:giveback", array($borrowing->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/delete.png" width='25' alt="vratit"></a><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:delete", array($borrowing->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/delete.png" width='25' alt="smazat"></a><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:edit", array($borrowing->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/edit.png" width='25' alt="edit"></a></td>

		</tr>
<?php $iterations++; } ?>
	</tbody>
<?php } ?>
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