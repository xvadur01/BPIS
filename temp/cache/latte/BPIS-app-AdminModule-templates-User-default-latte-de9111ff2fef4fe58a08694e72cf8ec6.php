<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/User/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2744793240', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb6b11e2b7a0_headerH1')) { function _lb6b11e2b7a0_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přeled uživatelů<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbb0feebc956_content')) { function _lbb0feebc956_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($user->isInRole('admin')) { ?>
	<div class="row">
		<a title="Nový uživatel" class="right-align btn-floating btn-large waves-effect waves-light blue" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:add"), ENT_COMPAT) ?>
"><i class="mdi-content-add"></i></a>
	</div>
<?php } ?>
<table class=" striped responsive-table">
	<tr>
<?php if ($user->isInRole('admin')) { ?>
			<th>id</th>
			<th>login</th>
<?php } ?>
		<th>prijmeni</th>
		<th>jmeno</th>
<?php if ($user->isInRole('admin')) { ?>
			<th>role</th>
<?php } ?>
		<th>telefon</th>
		<th>email</th>
		<th>pracovna</th>
		<th></th>
	</tr>

<?php $iterations = 0; foreach ($users as $oneUser) { if ($user->isInRole('admin')) { ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($oneUser->id, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($oneUser->login, ENT_NOQUOTES) ?></td>
<?php } ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($oneUser->prijmeni, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($oneUser->jmeno, ENT_NOQUOTES) ?></td>
<?php if ($user->isInRole('admin')) { ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($oneUser->role, ENT_NOQUOTES) ?></td>
<?php } ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($oneUser->telefon, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($oneUser->email, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($oneUser->pracovna, ENT_NOQUOTES) ?></td>
		<td>
<?php if ($user->isInRole('admin') || $user->getId() == $oneUser->id) { ?>
				<a title="Smazat uživatele" class="btn-floating waves-effect waves-light  red" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:delete", array($oneUser->id)), ENT_COMPAT) ?>
">
					<i class="mdi-action-delete"></i>
				</a>
				<a title="Upravit uživatele" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:edit", array($oneUser->id)), ENT_COMPAT) ?>
">
					<i class="mdi-editor-mode-edit"></i>
				</a>
<?php } ?>
			<a title="Detail uživatele" class="btn-floating waves-effect waves-light light-blue accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:detail", array($oneUser->id)), ENT_COMPAT) ?>
">
					<i class="mdi-action-account-box"></i>
			</a>
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