<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/User/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0682400292', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb954f4dc2bc_headerH1')) { function _lb954f4dc2bc_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přeled uživatelů<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb516eaa296b_content')) { function _lb516eaa296b_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
	<a title="Nový uživatel" class="right-align btn-floating btn-large waves-effect waves-light blue" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:add"), ENT_COMPAT) ?>
"><i class="mdi-content-add"></i></a>
</div>
<table class=" striped responsive-table">
	<tr>
		<th>id</th>
		<th>login</th>
		<th>prijmeni</th>
		<th>jmeno</th>
		<th>role</th>
		<th>telefon</th>
		<th>email</th>
		<th>pracovna</th>
		<th></th>
	</tr>

<?php $iterations = 0; foreach ($users as $user) { ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->id, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->login, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->prijmeni, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->jmeno, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->role, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->telefon, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->email, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($user->pracovna, ENT_NOQUOTES) ?></td>
		<td>
			<a title="Smazat uživatele" class="btn-floating waves-effect waves-light  red" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:delete", array($user->id)), ENT_COMPAT) ?>
"><i class="mdi-action-delete"></i></a>
			<a title="Upravit uživatele" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:edit", array($user->id)), ENT_COMPAT) ?>
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