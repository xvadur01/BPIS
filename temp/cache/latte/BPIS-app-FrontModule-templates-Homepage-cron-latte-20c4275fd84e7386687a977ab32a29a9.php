<?php
// source: C:\xampp\htdocs\BPIS\app\FrontModule/templates/Homepage/cron.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0034148395', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Upozornění na blížící se událost</title>
    <style>

    </style>
</head>
<body>
    <p>Dobrý den,</p>

    <p>dne <?php echo Latte\Runtime\Filters::escapeHtml($template->date($event['datum'], '%d.%m.%Y'), ENT_NOQUOTES) ?> se uskuteční událost:</p>
	<p>
		<?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ?>

		<?php echo Latte\Runtime\Filters::escapeHtml($event->popis, ENT_NOQUOTES) ?>

	</p>
</body>
</html>