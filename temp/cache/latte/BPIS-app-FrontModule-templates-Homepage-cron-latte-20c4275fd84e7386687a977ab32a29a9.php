<?php
// source: C:\xampp\htdocs\BPIS\app\FrontModule/templates/Homepage/cron.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9433066072', 'html')
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
<html style="margin: 0;padding: 0;font-family: 'Trebuchet MS', Helvetica, sans-serif;">
<head style="margin: 0;padding: 0;font-family: 'Trebuchet MS', Helvetica, sans-serif;">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Upozornění na blížící se událost</title>
</head>
<body>
<div style="width: 90%;margin: 20px auto;box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.16), 2px 2px 10px 2px rgba(0, 0, 0, 0.12);">
		<div style="width: 100%;	background-color: #2196f3;color: white;height: 70px;text-align: center;margin: 0;padding: 0;">
			<h1 style="padding-top: 20px;margin-top: 0;"><i>Událost:</i> <?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ?></h1>
		</div>
		<div style="padding: 50px;margin: 0 auto;width: 90%;">
			<p>Dobrý den,</p>
			<p>dne <?php echo Latte\Runtime\Filters::escapeHtml($template->date($event['datum'], '%d.%m.%Y %H:%M'), ENT_NOQUOTES) ?> se uskuteční událost:</p>
			<div style="padding: 20px;box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.16), 2px 2px 10px 2px rgba(0, 0, 0, 0.12);">
				<div>
					<div class="section">
						<span>
						<i style="font-size:15px;line-height:24px;color: #9e9e9e !important;">Název akce:</i>
						</span>
						<br>
						<span style="color: #2196f3 !important;"><?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ?></span>
					</div>
				</div>
				<div style="background-color: #e0e0e0;height: 1px;overflow: hidden;"></div>
				<div>
					<div class="section">
						<span>
						<i style="font-size:15px;line-height:24px;color: #9e9e9e !important;">Organizátor:</i>
						</span>
						<br>
						<span style="color: #2196f3 !important;"><?php echo Latte\Runtime\Filters::escapeHtml($eventUser->prijmeni, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($eventUser->jmeno, ENT_NOQUOTES) ?></span>
					</div>
				</div>
				<div style="background-color: #e0e0e0;height: 1px;overflow: hidden;"></div>
				<div>
					<div class="section">
						<span>
						<i style="font-size:15px;line-height:24px;color: #9e9e9e !important;">Datum konání:</i>
						</span>
						<br>
						<span style="color: #2196f3 !important;"><?php echo Latte\Runtime\Filters::escapeHtml($event->datum, ENT_NOQUOTES) ?></span>
					</div>
				</div>
				<div style="background-color: #e0e0e0;height: 1px;overflow: hidden;"></div>
					<div>
					<div class="section">
						<span>
						<i style="font-size:15px;line-height:24px;color: #9e9e9e !important;">Místo konání:</i>
						</span>
						<br>
						<span style="color: #2196f3 !important;"><?php echo Latte\Runtime\Filters::escapeHtml($event->misto, ENT_NOQUOTES) ?></span>
					</div>
				</div>

				<div style="background-color: #e0e0e0;height: 1px;overflow: hidden;"></div>
				<div>
					<div class="section">
						<span>
						<i style="font-size:15px;line-height:24px;color: #9e9e9e !important;">popis akce:</i>
						</span>
						<br>
						<span style="color: #2196f3 !important;"><?php echo Latte\Runtime\Filters::escapeHtml($event->popis, ENT_NOQUOTES) ?></span>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
</html>