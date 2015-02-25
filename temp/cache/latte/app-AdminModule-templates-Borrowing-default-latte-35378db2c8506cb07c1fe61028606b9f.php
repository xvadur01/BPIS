<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Borrowing/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7789815974', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbee7a0c8401_headerH1')) { function _lbee7a0c8401_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přehled výpujček<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb5fa2b0f6b7_content')) { function _lb5fa2b0f6b7_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
<a title="Nová stránka" class="right-align btn-floating btn-large waves-effect waves-light blue" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:add"), ENT_COMPAT) ?>
"><i class="mdi-content-add"></i></a>
</div>
<table class=" striped responsive-table">
	<thead>
	<tr>
		<th>Položka</th>
		<th>Od</th>
		<th>Datum vypůjčení</th>
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
<?php if ($user->isInRole('admin')) { ?>
				<td><?php echo Latte\Runtime\Filters::escapeHtml($borrowing->ref('uzivatel','uzivatel_id')->prijmeni, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($borrowing->jmeno, ENT_NOQUOTES) ?></td>
<?php } ?>
			<td>
<?php if ($borrowing->vraceno) { ?>
					<span class="btn-floating green accent-2"><i class="mdi-action-verified-user"></i></span>
<?php } else { ?>
					<span class="btn-floating red lighten-4"><i class="mdi-image-timer"></i></span>
<?php } ?>
			</td>

			<td>
<?php if (!$borrowing->vraceno) { ?>
					<a title="Vráceno zpět" class="btn-floating waves-effect waves-light light-blue lighten-1" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:giveback", array($borrowing->id)), ENT_COMPAT) ?>
"><i class="mdi-content-reply"></i></a>
<?php } ?>
				<a title="Vráceno zpět" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:delete", array($borrowing->id)), ENT_COMPAT) ?>
"><i class="mdi-editor-mode-edit"></i></a>
				<a title="Vráceno zpět" class="btn-floating waves-effect waves-light  red" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:edit", array($borrowing->id)), ENT_COMPAT) ?>
"><i class="mdi-image-portrait"></i></a>
			</td>
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['headerH1']), $_b, get_defined_vars())  ?>


<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 