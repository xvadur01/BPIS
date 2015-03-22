<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/User/detail.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2330082583', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lbe5bf3c06c1_headerH1')) { function _lbe5bf3c06c1_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><i>Detail uživatele:</i> <?php echo Latte\Runtime\Filters::escapeHtml($userData['surname'], ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($userData['name'], ENT_NOQUOTES) ;
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbca4f630dcf_scripts')) { function _lbca4f630dcf_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?> <?php Latte\Macros\BlockMacros::callBlockParent($_b, 'scripts', get_defined_vars()) ?>  
	<script type="text/javascript">
	$(document).ready(function(){
		$('.scrollspy').scrollSpy();
	});
	</script>
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbe799324914_content')) { function _lbe799324914_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
	<div  id="personalInformation" class="col s12 m6 l4 card-panel grey lighten-5 z-depth-1 section scrollspy">
		<h5>Osobní infomace</h5>
		<div class="col s10">
			<div class="section">
				<span>
					<i class="grey-text">Přijmení a jméno:</i>
				</span>
				<br>
				<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($userData['surname'], ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($userData['name'], ENT_NOQUOTES) ?></span>
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
				<i class="grey-text">Telefon:</i>
			</span>
			<br>
			<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($userData['phone'], ENT_NOQUOTES) ?></span>
			</div>
		</div>
		<div class="col s12 divider"></div>
		<div class="col s12">
			<div class="section">
			<span>
				<i class="grey-text">Email:</i>
			</span>
			<br>
			<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($userData['email'], ENT_NOQUOTES) ?></span>
			</div>
		</div>
		<div class="col s12 divider"></div>
		<div class="col s12">
			<div class="section">
			<span>
				<i class="grey-text">Pracovna:</i>
			</span>
			<br>
			<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($userData['office'], ENT_NOQUOTES) ?></span>
			</div>
		</div>
	</div>

	<div class="col s10 m4 offset-m2">
		<h5>Navigace</h5>
		<ul class="section table-of-contents">
			<li><a href="#personalInformation">Osobní infomace</a></li>
			<li><a href="#borrowing">Výpujčky</a></li>
			<li><a href="#records">Záznamy</a></li>
			<li><a href="#events">Události</a></li>
		</ul>
	</div>
	<div id="borrowing" class="col s12 card-panel section scrollspy">
			<h5 >Výpujčky</h5>
<?php if (count($borrowing)) { ?>

<?php $iterations = 0; foreach ($borrowing as $borrow) { ?>
	<div class="card medium col s12  l3  accent-1">
			<div class="card-content">
				<span class="card-title activator grey-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['title'], ENT_NOQUOTES) ?> <i class="mdi-navigation-more-vert right"></i></span><br>
				<span class=" white-text text-darken-4">
				<i class="grey-text" >Datum vypůjčení: </i>
				<span class="grey-text  text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($borrow->date, '%d.%m.%Y'), ENT_NOQUOTES) ?></span>
			</div>
			<div class="card-reveal  accent-1">
			  <span class="card-title black-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['title'], ENT_NOQUOTES) ?><i class="mdi-navigation-close right"></i></span>
			  <br><i class="white-text" >Datum vypůjčení: </i><br>
			  <span class="white-text  text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($borrow->date, '%d.%m.%Y'), ENT_NOQUOTES) ?></span>
			  <br><i class="grey-text" >Vypůjčeno od: </i><br>
			  <span class="black-text"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['surname'], ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($borrow['name'], ENT_NOQUOTES) ?></span><br>
<?php if ($user->isInRole('admin') ||  $user->getId() == $userData->id) { if (!$borrow->give_back) { ?>
					<a title="Vrátit zpět" class="ajax btn-floating waves-effect waves-light light-blue lighten-1" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:giveback", array($borrow->id, 'backlink' => $presenter->storeRequest())), ENT_COMPAT) ?>
"><i class="mdi-content-reply"></i></a>
<?php } ?>
				<a title="Upravit výpujčku" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:edit", array($borrow['id'])), ENT_COMPAT) ?>
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
		<div id="records" class="col s12 card-panel section scrollspy">
			<h5>Záznamy</h5>
<?php $_l->tmp = $_control->getComponent("timeLineRecord"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
		</div>
		<div id="events" class="col s12 card-panel section scrollspy">
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

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 