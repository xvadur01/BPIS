<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Admin/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2650681135', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbafc86bebe0_headerH1')) { function _lbafc86bebe0_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>BPIS<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb181f5cdeaa_content')) { function _lb181f5cdeaa_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
	<div class="col s12 m4">
		<h5>Nejnovější události</h5>
<?php if (count($newestEvent)) { $iterations = 0; foreach ($newestEvent as $event) { ?>
				<div class="card small blue">
					<div class="card-content">
					  <span class="card-title activator white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($event['nazev'], ENT_NOQUOTES) ?> <i class="mdi-navigation-more-vert right"></i></span>
					</div>
					<div class="card-reveal blue s12 m6 l6">
						<span class="card-title white-text text-darken-4"><a class="white-text text-darken-4" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:detail", array($event['id'])), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($event['nazev'], ENT_NOQUOTES) ?></a><i class="mdi-navigation-close right"></i></span>
					  <p class="white-text"><?php echo Latte\Runtime\Filters::escapeHtml($event['popis'], ENT_NOQUOTES) ?></p>
					</div>
				</div>
<?php $iterations++; } } else { ?>
			<div class="card small">
				<div class="card-content">
				  <span class="card-title activator grey-text text-darken-4">Žádná nová událost</span>
				</div>
			</div>
<?php } ?>
	</div>
	<div class="col s12 m4">
		<h5>Nejbližší události</h5>
<?php if (count($closestEvent)) { $iterations = 0; foreach ($closestEvent as $event) { ?>
			<div class="card small blue">
				<div class="card-content">
				  <span class="card-title activator white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($event['nazev'], ENT_NOQUOTES) ?> <i class="mdi-navigation-more-vert right"></i></span>
				</div>
				<div class="card-reveal blue s12 m6 l6">
				 	<span class="card-title white-text text-darken-4"><a class="white-text text-darken-4" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:detail", array($event['id'])), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($event['nazev'], ENT_NOQUOTES) ?></a><i class="mdi-navigation-close right"></i></span>
					<p class="white-text"><?php echo Latte\Runtime\Filters::escapeHtml($event['popis'], ENT_NOQUOTES) ?></p>
				</div>
			</div>
<?php $iterations++; } } else { ?>
			<div class="card small">
				<div class="card-content">
				  <span class="card-title activator grey-text text-darken-4">Žádná nadcházející událost</span>
				</div>
			</div>
<?php } ?>
	</div>
<div class="col s12 m4">
	<h5>Aktulání výpujčky</h5>
<?php if (count($borrowing)) { $iterations = 0; foreach ($borrowing as $borrow) { ?>
	<div class="card small blue">
			<div class="card-content">
			  <span class="card-title activator white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['nazev'], ENT_NOQUOTES) ?> <i class="mdi-navigation-more-vert right"></i></span>
			</div>
			<div class="card-reveal blue s12 m6 l6">
			  <span class="card-title white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['nazev'], ENT_NOQUOTES) ?><i class="mdi-navigation-close right"></i></span>
			  <p class="white-text"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['nazev'], ENT_NOQUOTES) ?>
,<?php echo Latte\Runtime\Filters::escapeHtml($borrow['jmeno'], ENT_NOQUOTES) ?>
,<?php echo Latte\Runtime\Filters::escapeHtml($borrow['prijmeni'], ENT_NOQUOTES) ?></p>
			  <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:giveBack", array($borrow['id'], 'backlink' => $presenter->storeRequest())), ENT_COMPAT) ?>
">Vrátit</a>
			</div>
		</div>

<?php $iterations++; } } else { ?>
		<div class="card small">
			<div class="card-content">
			  <span class="card-title activator grey-text text-darken-4">Žádná výpujčka</span>
			  <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:add"), ENT_COMPAT) ?>
">Nova</a>
			</div>
		</div>
<?php } ?>
</div>
</div>

<div class="row">
	<h5>Záznamy</h5>
<?php $_l->tmp = $_control->getComponent("timeLine"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
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