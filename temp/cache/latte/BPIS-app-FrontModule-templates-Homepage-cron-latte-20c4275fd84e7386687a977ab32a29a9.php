<?php
// source: C:\xampp\htdocs\BPIS\app\FrontModule/templates/Homepage/cron.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7174739381', 'html')
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
		html, body{
			margin: 0;
			padding: 0;
			font-family: "Trebuchet MS", Helvetica, sans-serif;
		}

		.header {
			width: 100%;
			background-color: #2196f3;
			color: white;
			height: 70px;
			text-align: center;
			margin: 0;
			padding: 0;
			box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
		}
		h1 {
			padding-top: 20px;
			margin-top: 0;
		}
		.content{

			width: 90%;
			margin: 20px auto;
			box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.16), 2px 2px 10px 2px rgba(0, 0, 0, 0.12);
		}

		.event{
			padding: 20px;
			box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.16), 2px 2px 10px 2px rgba(0, 0, 0, 0.12);
		}
		.text{
			padding: 50px;
			margin: 0 auto;
			width: 90%;
		}
		i{
			font-size:	15px;
			color:	rgb(158,​ 158,​ 158);
			line-height:	24px;
		}
		.divider {
			background-color: #e0e0e0;
			height: 1px;
			overflow: hidden;
		}
		.blue-text {
			color: #2196f3 !important;
		}
		.grey-text {
			color: #9e9e9e !important;
		}

    </style>
</head>
<body>

	<div class="content">
		<div class="header">
			<h1><i>Událost:</i> <?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ?></h1>
		</div>
		<div class="text">
			<p>Dobrý den,</p>
			<p>dne <?php echo Latte\Runtime\Filters::escapeHtml($template->date($event['datum'], '%d.%m.%Y %H:%M'), ENT_NOQUOTES) ?> se uskuteční událost:</p>
			<div class="event">
				<div>
					<div class="section">
						<span>
						<i class="grey-text">Název akce:</i>
						</span>
						<br>
						<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($event->nazev, ENT_NOQUOTES) ?></span>
					</div>
				</div>
				<div class="divider"></div>
				<div>
					<div class="section">
						<span>
						<i class="grey-text">Organizátor:</i>
						</span>
						<br>
						<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($eventUser->prijmeni, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($eventUser->jmeno, ENT_NOQUOTES) ?></span>
					</div>
				</div>
				<div class="divider"></div>
				<div>
					<div class="section">
						<span>
						<i class="grey-text">Datum konání:</i>
						</span>
						<br>
						<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($event->datum, ENT_NOQUOTES) ?></span>
					</div>
				</div>
				<div class="divider"></div>
				<div>
					<div class="section">
						<span>
						<i class="grey-text">popis akce:</i>
						</span>
						<br>
						<span class="blue-text"><?php echo Latte\Runtime\Filters::escapeHtml($event->popis, ENT_NOQUOTES) ?></span>
					</div>
				</div>

			</div>
		</div>
	</div>
</body>
</html>