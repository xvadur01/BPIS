<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/Admin/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7398014372', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb29c0765bb5_headerH1')) { function _lb29c0765bb5_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>BPIS<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb5c5727753a_scripts')) { function _lb5c5727753a_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;Latte\Macros\BlockMacros::callBlockParent($_b, 'scripts', get_defined_vars()) ?>  
<script type="text/javascript">
	$(document).ready(function() {

		$( ".open" ).click(function() {
			$( this ).parents( ".card" ).addClass( "medium");
		});
		$( ".close" ).click(function() {
			$( this ).parents( ".card" ).removeClass( "medium");
		});

	});
</script>
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb31d96e918b_content')) { function _lb31d96e918b_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="row">
	<div class="col s12 m4">
		<h5>Nejnovější události</h5>
<?php if (count($newestEvent)) { $iterations = 0; foreach ($newestEvent as $event) { ?>
				<div class="card  light-blue lighten-1">
					<div class="card-content">
						<span class="card-title activator white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($event['nazev'], ENT_NOQUOTES) ?>

							<i class="open mdi-navigation-more-vert right"></i>
						</span><br>
						<span class=" white-text text-darken-4">
							<i>Datum: </i>
						</span>
<?php if ($event->datum) { ?>
							<span class=" white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datum, '%d.%m.%Y %H:%M'), ENT_NOQUOTES) ?></span>
<?php } else { ?>
							<span class=" white-text text-darken-4">ještě není určeno</span>
<?php } ?>
					</div>
					<div class="card-reveal  blue s12 m6 l6">
						<span class="card-title white-text text-darken-4">
							<a class="white-text text-darken-4" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:detail", array($event['id'])), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($event['nazev'], ENT_NOQUOTES) ?></a>
							<span class="white-text"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($event['datum'], '%d.%m.%Y %H:%M'), ENT_NOQUOTES) ?></span><i class="close mdi-navigation-close right"></i>
						</span>
						<span class=" white-text text-darken-4"><i>Pořadatel: </i></span>
						<span class=" white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($event->prijmeni, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($event->jmeno, ENT_NOQUOTES) ?></span>
						<br><span class=" white-text text-darken-4">
							<i>Datum: </i>
						</span>
<?php if ($event->datum) { ?>
							<span class=" white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datum, '%d.%m.%Y  %H:%M'), ENT_NOQUOTES) ?></span>
<?php } else { ?>
							<span class=" white-text text-darken-4">ještě není určeno</span>
<?php } ?>
						<p class="white-text"><?php echo Latte\Runtime\Filters::escapeHtml($template->striptags($template->truncate($event['popis'], 350)), ENT_NOQUOTES) ?></p>
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
				<div class="card light-blue lighten-1">
					<div class="card-content">
						<span class="card-title activator white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($event['nazev'], ENT_NOQUOTES) ?>

							<i class="open mdi-navigation-more-vert right"></i>
						</span><br>
						<span class=" white-text text-darken-4">
							<i>Datum: </i>
						</span>
<?php if ($event->datum) { ?>
							<span class=" white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datum, '%d.%m.%Y %H:%M'), ENT_NOQUOTES) ?></span>
<?php } else { ?>
							<span class=" white-text text-darken-4">ještě není určeno</span>
<?php } ?>
					</div>
					<div class="card-reveal  blue s12 m6 l6">
						<span class="card-title white-text text-darken-4">
							<a class="white-text text-darken-4" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Event:detail", array($event['id'])), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($event['nazev'], ENT_NOQUOTES) ?></a>
							<span class="white-text"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($event['datum'], '%d.%m.%Y %H:%M'), ENT_NOQUOTES) ?></span>
							<i class="close mdi-navigation-close right"></i>
						</span>
						<span class=" white-text text-darken-4"><i>Pořadatel: </i></span>
						<span class=" white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($event->prijmeni, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($event->jmeno, ENT_NOQUOTES) ?></span>
						<br><span class=" white-text text-darken-4">
							<i>Datum: </i>
						</span>
<?php if ($event->datum) { ?>
							<span class=" white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($event->datum, '%d.%m.%Y  %H:%M'), ENT_NOQUOTES) ?></span>
<?php } else { ?>
							<span class=" white-text text-darken-4">ještě není určeno</span>
<?php } ?>
						<p class="white-text"><?php echo Latte\Runtime\Filters::escapeHtml($template->striptags($template->truncate($event['popis'], 350)), ENT_NOQUOTES) ?></p>
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
		<h5>Aktuální výpůjčky</h5>
<?php if (count($borrowing)) { $iterations = 0; foreach ($borrowing as $borrow) { ?>
				<div class="card medium light-blue">
					<div class="card-content">
						<span class="card-title activator white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['nazev'], ENT_NOQUOTES) ?> <i class="mdi-navigation-more-vert right"></i></span>
						<br><i class="white-text" >Datum vypůjčení: </i>
						<span class="white-text  text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($borrow->datum, '%d.%m.%Y'), ENT_NOQUOTES) ?></span>
					</div>
					<div class="card-reveal blue  lighten-1 s12 m6 l6">
						<span class="card-title white-text text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['nazev'], ENT_NOQUOTES) ?><i class="mdi-navigation-close right"></i></span>
						<p class="white-text"><i>Datum vypůjčení:</i> </p>
						<p class="white-text  text-darken-4"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($borrow->datum, '%d.%m.%Y'), ENT_NOQUOTES) ?></p>
						<p class="white-text" ><i>Vypůjčeno od: </i></p>
						<p class="white-text"><?php echo Latte\Runtime\Filters::escapeHtml($borrow['prijmeni'], ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($borrow['jmeno'], ENT_NOQUOTES) ?></p>
<?php if ($user->isInRole('admin') ||  $user->getId() == $userData->id) { ?>
							<p>
<?php if (!$borrow->vraceno) { ?>
								<a title="Vrátit zpět" class="ajax btn-floating waves-effect waves-light light-blue lighten-1" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:giveback", array($borrow->id, 'backlink' => $presenter->storeRequest())), ENT_COMPAT) ?>
"><i class="mdi-content-reply"></i></a>
<?php } ?>
							<a title="Upravit výpujčku" class="btn-floating waves-effect waves-light light-green accent-3" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Borrowing:edit", array($borrow['id'])), ENT_COMPAT) ?>
"><i class="mdi-editor-mode-edit"></i></a>
							</p>
<?php } ?>
					</div>
				</div>

<?php $iterations++; } } else { ?>
			<div class="card small">
				<div class="card-content">
					<span class="card-title activator grey-text text-darken-4">Žádná výpůjčka</span>
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

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars()) ; call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 