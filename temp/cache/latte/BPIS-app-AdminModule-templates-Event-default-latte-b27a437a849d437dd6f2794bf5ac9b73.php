<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Event/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1523063405', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbf3055b597e_content')) { function _lbf3055b597e_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:add"), ENT_COMPAT) ?>
">add</a>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:list"), ENT_COMPAT) ?>
">list</a>

<table>
	<tr>
		<th>id</th>
		<th>nazev</th>
		<th>datum</th>
		<th>zapis</th>
		<th>vytvoril</th>
		<th>pocet upozorneni</th>
	</tr>

<?php $iterations = 0; foreach ($events as $event) { ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->id, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->datum, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->zapis, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->uzivatel_id, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($event->pocet_upozorneni, ENT_NOQUOTES) ?></td>
		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:delete", array($event->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/delete.png" width='25' alt="smazat"></a><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:edit", array($event->id)), ENT_COMPAT) ?>
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 