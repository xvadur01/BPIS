<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Borrowing/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2102248209', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb1b6b6c65a7_headerH1')) { function _lb1b6b6c65a7_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přehled výpůjček<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbc7435938bc_content')) { function _lbc7435938bc_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
<a title="Nová výpujčka" class="right-align btn-floating btn-large waves-effect waves-light blue" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:add"), ENT_COMPAT) ?>
"><i class="mdi-content-add"></i></a>
</div>
<div id="<?php echo $_control->getSnippetId('borrowTable') ?>"><?php call_user_func(reset($_b->blocks['_borrowTable']), $_b, $template->getParameters()) ?>
</div><?php
}}

//
// block _borrowTable
//
if (!function_exists($_b->blocks['_borrowTable'][] = '_lb5942648256__borrowTable')) { function _lb5942648256__borrowTable($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('borrowTable', FALSE)
?><table class=" striped responsive-table">
	<thead>
	<tr>
		<th>Položka</th>
		<th>Od</th>
		<th>Datum vypůjčení</th>
		<th>Datum navrácení</th>
<?php if ($user->isInRole('admin')) { ?>
			<th>Kdo</th>
<?php } ?>
		<th>Navráceno</th>
	</tr>
	</thead>
<?php if ($borrowings) { ?>
			<tbody>
<?php $iterations = 0; foreach ($borrowings as $borrowing) { ?>
				<tr>
					<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->nazev, ENT_NOQUOTES) ?></td>
					<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->prijmeni, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($borrowing->jmeno, ENT_NOQUOTES) ?></td>
					<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($borrowing->datum, '%d.%m.%Y'), ENT_NOQUOTES) ?></td>
<?php if ($borrowing->datum_navraceni) { ?>
						<td><?php echo Latte\Runtime\Filters::escapeHtml($template->date($borrowing->datum_navraceni, '%d.%m.%Y'), ENT_NOQUOTES) ?></td>
<?php } else { ?>
						<td></td>
<?php } ?>

<?php if ($user->isInRole('admin')) { ?>
						<td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:userborrowing", array($borrowing->uzivatel_id)), ENT_COMPAT) ?>
"> <?php echo Latte\Runtime\Filters::escapeHtml($borrowing->ref('uzivatel','uzivatel_id')->prijmeni, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($borrowing->jmeno, ENT_NOQUOTES) ?></a></td>
<?php } ?>
					<td>
<?php if ($borrowing->vraceno) { ?>
							<span title="<?php echo Latte\Runtime\Filters::escapeHtml($template->date($borrowing->datum_navraceni, '%d.%m.%Y'), ENT_COMPAT) ?>"  class="btn-floating green accent-2"><i class="mdi-action-verified-user"></i></span>
<?php } else { ?>
							<span class="btn-floating red lighten-4"><i class="mdi-image-timer"></i></span>
<?php } ?>
					</td>

					<td>
<?php if (!$borrowing->vraceno && $borrowing->uzivatel_id == $user->getId()) { ?>
							<a title="Vrátit zpět" class="ajax btn-floating waves-effect waves-light light-blue lighten-1" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:giveback", array($borrowing->id)), ENT_COMPAT) ?>
"><i class="mdi-content-reply"></i></a>
<?php } ?>
						<a title="Smazat" class="btn-floating waves-effect waves-light red" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:delete", array($borrowing->id)), ENT_COMPAT) ?>
"><i class="mdi-action-delete"></i></a>
						<a title="Upravit" class="btn-floating waves-effect waves-light light-green accent-3 " href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:edit", array($borrowing->id)), ENT_COMPAT) ?>
"><i class="mdi-editor-mode-edit"></i></a>
					</td>
				</tr>
<?php $iterations++; } ?>
			</tbody>
<?php } ?>
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