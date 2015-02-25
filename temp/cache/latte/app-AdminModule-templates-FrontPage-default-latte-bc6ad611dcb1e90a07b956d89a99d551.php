<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/FrontPage/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0836683976', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbcc6fce6a9b_headerH1')) { function _lbcc6fce6a9b_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Přehled věřejných stránek<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3b6da5a5bf_content')) { function _lb3b6da5a5bf_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
<a title="Nová stránka" class="right-align btn-floating btn-large waves-effect waves-light blue" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("FrontPage:add"), ENT_COMPAT) ?>
"><i class="mdi-content-add"></i></a>
</div>

<table class=" striped responsive-table">
	<tr>
		<th>Id</th>
		<th>Titulek</th>
		<th>Nadpis</th>
		<th>Text</th>
		<th>Aktivní</th>
		<th></th>
	</tr>

<?php $iterations = 0; foreach ($pages as $page) { ?>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($page->id, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($page->titulek, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($page->nadpis, ENT_NOQUOTES) ?></td>
		<td><?php echo Latte\Runtime\Filters::escapeHtml($template->striptags($template->truncate($page->text, 500)), ENT_NOQUOTES) ?></td>
		<td>
<?php if ($page->aktivni) { ?>
				<span class="btn-floating green accent-2"><i class=" mdi-communication-invert-colors-on"></i></span>
<?php } else { ?>
				<span class="btn-floating red lighten-4"><i class="mdi-communication-invert-colors-off"></i></span>
<?php } ?>
		</td>
		<td>
			<a title="Zobrazit ve veřejné části" class="btn-floating waves-effect waves-light light-blue lighten-1" target="_blank" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Homepage:default", array($page->id)), ENT_COMPAT) ?>
"><i class="mdi-image-portrait"></i></a>
			<a title="Upravit stránku" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Frontpage:edit", array($page->id)), ENT_COMPAT) ?>
"><i class="mdi-editor-mode-edit"></i></a>
			<a title="smazat stránku" class="btn-floating waves-effect waves-light red" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Frontpage:delete", array($page->id)), ENT_COMPAT) ?>
"><i class="mdi-action-delete"></i></a>
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