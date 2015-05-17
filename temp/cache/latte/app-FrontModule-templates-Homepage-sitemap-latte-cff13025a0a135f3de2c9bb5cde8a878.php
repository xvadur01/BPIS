<?php
// source: C:\xampp\htdocs\BPIS\app\FrontModule/templates/Homepage/sitemap.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3210194896', 'xml')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
header('Content-Type: application/xml') ?>
<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php $iterations = 0; foreach ($sitemap as $s) { ?>
         <url>
             <loc><?php echo Latte\Runtime\Filters::escapeXml($_control->link("//Homepage:default", array($s->id))) ?></loc>
         </url>
<?php $iterations++; } ?>
</urlset>