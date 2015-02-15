<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/User/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8272596404', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb763e9d7b16_content')) { function _lb763e9d7b16_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:default"), ENT_COMPAT) ?>
">user</a>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:add"), ENT_COMPAT) ?>
">add</a>

<table>
	<tr>
		<th>id</th>
		<th>login</th>
		<th>heslo</th>
		<th>prijmeni</th>
		<th>jmeno</th>
		<th>role</th>
		<th>telefon</th>
		<th>email</th>
		<th>pracovna</th>
	</tr>

<?php $iterations = 0; foreach ($users as $user) { ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->id, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->login, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->heslo, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->prijmeni, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->jmeno, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->role, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->telefon, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->email, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->pracovna, ENT_NOQUOTES) ?></td>
		<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:delete", array($user->id)), ENT_COMPAT) ?>
"><img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/delete.png" width='25' alt="smazat"></a><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:edit", array($user->id)), ENT_COMPAT) ?>
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