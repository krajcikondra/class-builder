<?php
// Create nette control with latte and with factory
// using: php createControl.php app

require_once __DIR__ . DIRECTORY_SEPARATOR . 'NetteControl' . DIRECTORY_SEPARATOR . 'Form' . DIRECTORY_SEPARATOR . 'Builder.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'NetteControl' . DIRECTORY_SEPARATOR . 'Form' . DIRECTORY_SEPARATOR . 'Input.php';




$path = $argv[1]; // path to folder where control have to be created
$namespace = $argv[2]; // namespace of class
$className = $argv[3]; // class name = name of control
$formInputs = explode(',', $argv[4]);

if (($pos = strrpos($className, 'Form')) !== FALSE) {
	$formBuilder = new \Helbrary\ClassBuilder\Control\Form\Builder($className, $namespace);

	foreach ($formInputs as $input) {

		$label = $input;
		if (strpos($input, ':') !== FALSE) {
			$parts = explode(':', $input);
			$input = $parts[0];
			$label = $parts[1];
		}

		$formBuilder->addInput(new \Helbrary\ClassBuilder\Control\Form\Input($input, $label));
	}


	$formName = substr($className, 0, $pos);
	$propertyName = substr(strtolower($className), 0, $pos) . "Id";
	$formBuilder->addProperty($propertyName);
	$formBuilder->build($path);
}

