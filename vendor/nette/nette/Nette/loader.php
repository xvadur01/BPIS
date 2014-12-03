<?php

/**
 * Nette Framework (version 2.3-dev released on $WCDATE$, http://nette.org)
 * Copyright (c) 2004, 2014 David Grudl (http://davidgrudl.com)
 */


if (PHP_VERSION_ID < 50301) {
	throw new Exception('Nette Framework requires PHP 5.3.1 or newer.');
}


if (!class_exists('Nette\Loaders\NetteLoader')) {
	require __DIR__ . '/Loaders/NetteLoader.php';
}

Nette\Loaders\NetteLoader::getInstance()->register();
