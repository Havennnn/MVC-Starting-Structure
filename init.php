<?php
spl_autoload_register(function ($class) {
	$base = __DIR__;
	$class = str_replace('\\', '/', $class);
	$paths = ["$base/$class.php", "$base/" . strtolower($class) . '.php'];

	foreach($paths as $file) {
		if (is_file($file)) {
			require $file; 
			return;
		}
	}
});

require __DIR__ . '/system/config.php';
require __DIR__ . '/core/App.php';
require __DIR__ . '/core/Controller.php';
require __DIR__ . '/core/Model.php';
require __DIR__ . '/core/View.php';