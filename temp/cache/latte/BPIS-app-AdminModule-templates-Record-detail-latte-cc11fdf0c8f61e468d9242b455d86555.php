<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Record/detail.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9183003677', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb8a1a702aa1_headerH1')) { function _lb8a1a702aa1_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><i>Záznam:</i> <?php echo Latte\Runtime\Filters::escapeHtml($record->nazev, ENT_NOQUOTES) ;
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbf094da06e5_content')) { function _lbf094da06e5_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="event row">

<?php if ($record->uzivatel_id == $user->getId() || $user->isInRole('admin')) { ?>
		<div class="col s12">
			<a title="Smazat záznam" class="btn-floating waves-effect waves-light  red" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:delete", array($record->id, 'backlink' => $presenter->storeRequest())), ENT_COMPAT) ?>
"><i class="mdi-action-delete"></i></a>
			<a title="Upravit záznam" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Record:edit", array($record->id)), ENT_COMPAT) ?>
"><i class="mdi-editor-mode-edit"></i></a>
		</div>
<?php } ?>

	<div class="col s12 m3 card">
		<p><i>Řešitel:</i></p>
		<p><?php echo Latte\Runtime\Filters::escapeHtml($userRef->prijmeni, ENT_NOQUOTES) ?>
  <?php echo Latte\Runtime\Filters::escapeHtml($userRef->jmeno, ENT_NOQUOTES) ?> <p>
	</div>
	<div class="col s12 m3 card">
		<p><i>Datum zahájení:</i></p>
		<p><?php echo Latte\Runtime\Filters::escapeHtml($template->date($record->datum, '%d.%m.%Y'), ENT_NOQUOTES) ?><p>
	</div>
	<div class="col s12 m3 card">
		<p><i>Datum předpokládaného ukončení:</i></p>
		<p><?php echo Latte\Runtime\Filters::escapeHtml($template->date($record->datum_splneni, '%d.%m.%Y'), ENT_NOQUOTES) ?><p>
	</div>
	<div class="col s12 card">
		<p><i>Popis:</i></p>
		<p><?php echo $record->popis ?><p>
	</div>
</div>
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