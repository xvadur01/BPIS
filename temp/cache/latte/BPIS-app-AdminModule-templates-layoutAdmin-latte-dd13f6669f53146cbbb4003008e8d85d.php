<?php
// source: C:\xampp\htdocs\BPIS\app\AdminModule/templates/@layoutAdmin.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0123257398', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb672a509333_head')) { function _lb672a509333_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block headerH1
//
if (!function_exists($_b->blocks['headerH1'][] = '_lb095bdb0ce7_headerH1')) { function _lb095bdb0ce7_headerH1($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block _flashMessage
//
if (!function_exists($_b->blocks['_flashMessage'][] = '_lbe717a50c9f__flashMessage')) { function _lbe717a50c9f__flashMessage($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v; $_control->redrawControl('flashMessage', FALSE)
?>			<div class="row">
				<div class="col s12">
<?php $iterations = 0; foreach ($flashes as $flash) { if ($flash->type  == 'success') { ?>
							<div class="card-panel tea light-green accent-1 ">
								<i class="mdi-action-done"></i>
<?php } else { ?>
							<div class="card-panel tea">
<?php } ?>
						<span><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></span>
						</div>
<?php $iterations++; } ?>

				</div>
			</div>
<?php
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb976f85e425_scripts')) { function _lb976f85e425_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery-2.1.3.min.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/netteForms.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/nette.ajax.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/main.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/materialize.min.js"></script>
		<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/clockpicker.js"></script>
	<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/live-form-validation.js"></script>
	

	<script type="text/javascript">

	$(document).ready(function()
    {
		$(".dropdown-button").dropdown( { hover: false });
		$("input.checkbox").each(function(){
			$(this).insertBefore($(this).parent());
		});

			$("input").each(function(){
				if(typeof($(this).val()) != "undefined" && $(this).val() !== null && $(this).val() != "")
				{
					var $label = $("label[for='"+this.id+"']")
					$label.addClass('active') ;
				}
			});

  // Initialize collapse button
  $(".button-collapse").sideNav();
  // Initialize collapsible
  $('.collapsible').collapsible();

	});
	</script>
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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title><?php if (isset($_b->blocks["title"])) { ob_start(); Latte\Macros\BlockMacros::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>Nette Sandbox</title>
	<!-- CSS  -->
	<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/materialize.aditional.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/jquery-clockpicker.min.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/clockpicker.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/screen.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/timeLine.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">
	<!--<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtmlComment($basePath) ?>/css/jQueryUi.css">
	<link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtmlComment($basePath) ?>/css/dateTimePicker.css">
	-->
	<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

</head>

<body>
	<script> document.documentElement.className+=' js' </script>

	<header>
	<!-- Dropdown Structure -->
	<ul id="dropdown1" class=" dropdown-content">
		<li><?php if ($user->loggedIn) { ?>

				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:User:edit", array($user->getId())), ENT_COMPAT) ?>
">Osobní údaje</a>
<?php } ?>
		</li>
		<li class="divider"></li>
		<li><?php if ($user->loggedIn) { ?>

				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Sign:out"), ENT_COMPAT) ?>
">Odhlásit</a>
<?php } else { ?>
				<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Sign:in"), ENT_COMPAT) ?>
">Přihlásit</a>
<?php } ?>
		</li>
	</ul>
	<nav class="top-nav  light-blue lighten-1">
			<div class="nav-wrapper">
				<div class="col s12">
					<a class="brand-logo"><h1><?php call_user_func(reset($_b->blocks['headerH1']), $_b, get_defined_vars())  ?></h1></a>
					<ul class="right hide-on-med-and-down">
					  <!-- Dropdown Trigger -->
					  <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo Latte\Runtime\Filters::escapeHtml($user->getIdentity()->login, ENT_NOQUOTES) ?><i class="mdi-navigation-arrow-drop-down right"></i></a></li>
					</ul>
				</div>
			</div>
	</nav>
	<div class="container">
		<a class="button-collapse top-nav full" data-activates="nav-mobile" href="#">
			<i class="mdi-navigation-menu"></i>
		</a>
	</div>
<?php $_l->tmp = $_control->getComponent("menu"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->renderBootstrapNav() ?>
	</header>
	<main>
	<div class="container col s12 m10 l11 ">
<div id="<?php echo $_control->getSnippetId('flashMessage') ?>"><?php call_user_func(reset($_b->blocks['_flashMessage']), $_b, $template->getParameters()) ?>
</div><?php Latte\Macros\BlockMacros::callBlock($_b, 'content', $template->getParameters()) ?>
	</div>
	</main>
	<footer class="page-footer light-blue lighten-1">
		<div class="container">
		  <div class="row">
					  </div>
		</div>
		<div class="footer-copyright blue">
		  <div class="container">
			© 2015 Pavel Vaďura
		  </div>
		</div>
    </footer>
<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>
</body>
</html>
