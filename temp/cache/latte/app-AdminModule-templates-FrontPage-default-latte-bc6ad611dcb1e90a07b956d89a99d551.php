<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/FrontPage/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5808559861', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbdd4992d8ab_content')) { function _lbdd4992d8ab_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("FrontPage:default"), ENT_COMPAT) ?>
">frontpage</a>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("FrontPage:add"), ENT_COMPAT) ?>
">add</a>

<table>
	<tr>
		<th>id</th>
		<th>titulek</th>
		<th>nadpis</th>
		<th>text</th>
		<th>aktivni</th>
	</tr>

<?php $iterations = 0; foreach ($pages as $page) { ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($page->id, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($page->titulek, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($page->nadpis, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($page->text, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($page->aktivni, ENT_NOQUOTES) ?></td>
		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Frontpage:delete", array($page->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/delete.png" width='25' alt="smazat"></a><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Frontpage:edit", array($page->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/edit.png" width='25' alt="edit"></a></td>

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
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 