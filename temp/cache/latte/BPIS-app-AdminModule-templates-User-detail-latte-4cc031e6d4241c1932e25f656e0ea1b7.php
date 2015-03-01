<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/User/detail.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3070057998', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb5d0d753603_headerH1')) { function _lb5d0d753603_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>Detail uživatele<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb9e6b676780_content')) { function _lb9e6b676780_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
	<div class="col s12 m6 l4 card-panel grey lighten-5 z-depth-1">
		<h5>Osobní infomace</h5>
		<div class="col s10">
			<div class="section">
				<span>
					<i>Přijmení a jméno:</i>
				</span>
				<br>
				<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($userData['prijmeni'], ENT_NOQUOTES) ;echo Latte\Runtime\Filters::escapeHtml($userData['jmeno'], ENT_NOQUOTES) ?></span>
			</div>
		</div>
		<div class="col s2 right-align section">
<?php if ($user->isInRole('admin') ||  $user->getId() == $userData['id']) { ?>
				<a title="Upravit uživatele" class=" btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("User:edit", array($user->id)), ENT_COMPAT) ?>
"><i class="mdi-editor-mode-edit"></i></a>
<?php } ?>
		</div>
		<div class="col s12 divider"></div>
		<div class="col s12">
			<div class="section">
			<span>
				<i>Telefon:</i>
			</span>
			<br>
			<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($userData['telefon'], ENT_NOQUOTES) ?></span>
			</div>
		</div>
		<div class="col s12 divider"></div>
		<div class="col s12">
			<div class="section">
			<span>
				<i>Email:</i>
			</span>
			<br>
			<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($userData['email'], ENT_NOQUOTES) ?></span>
			</div>
		</div>
		<div class="col s12 divider"></div>
		<div class="col s12">
			<div class="section">
			<span>
				<i>Pracovna:</i>
			</span>
			<br>
			<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($userData['pracovna'], ENT_NOQUOTES) ?></span>
			</div>
		</div>
	</div>
	<div class="col s12 m5 l7 offset-m1 offset-l1 card-panel">
			<h5>Výpujčky</h5>
<?php if (count($borrowing)) { ?>

<?php $iterations = 0; foreach ($borrowing as $borrow) { ?>
	<div class="card small col s11 l5 orange accent-1">
			<div class="card-content">
			  <span class="card-title activator grey-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['nazev'], ENT_NOQUOTES) ?> <i class="mdi-navigation-more-vert right"></i></span>
			</div>
			<div class="card-reveal orange accent-1">
			  <span class="card-title black-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['nazev'], ENT_NOQUOTES) ?><i class="mdi-navigation-close right"></i></span>
			  <p class="black-text"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['nazev'], ENT_NOQUOTES) ?>
,<?php echo Latte\Runtime\Filters::escapeHtml($borrow['jmeno'], ENT_NOQUOTES) ?>
,<?php echo Latte\Runtime\Filters::escapeHtml($borrow['prijmeni'], ENT_NOQUOTES) ?></p>
			  <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:giveBack", array($borrow['id'], 'backlink' => $presenter->storeRequest())), ENT_COMPAT) ?>
">Vrátit</a>
<?php if ($user->isInRole('admin') ||  $user->getId() == $userData->id) { ?>
				<a title="Upravit uživatele" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:edit", array($borrow['id'])), ENT_COMPAT) ?>
"><i class="mdi-editor-mode-edit"></i></a>
<?php } ?>
			</div>
		</div>

<?php $iterations++; } } else { ?>
		<div class="card small">
			<div class="card-content">
			  <span class="card-title activator grey-text text-darken-4">Žádná výpujčka</span>
			  <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:add"), ENT_COMPAT) ?>
">Nová</a>
			</div>
		</div>

<?php } ?>
	</div>
</div>
	<div class ="row">
		<div class="col s12 m12 l6 card-panel">
			<h5>Záznamy</h5>
<?php $_l->tmp = $_control->getComponent("timeLineRecord"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
		</div>
		<div class="col s12 m12 l5 offset-l1 card-panel">
			<h5>Události</h5>
<?php $_l->tmp = $_control->getComponent("timeLineEvent"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
		</div>
	</div><?php
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