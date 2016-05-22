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

	foreach ($formInputs as $inputDefinition) {
		$input = parseInputDefinition($inputDefinition);
		$formBuilder->addInput($input);
	}


	$formName = substr($className, 0, $pos);
	$propertyName = substr(strtolower($className), 0, $pos) . "Id";
	$formBuilder->addProperty($propertyName);
	$formBuilder->build($path);
}

function parseInputDefinition($inputDefinition)
{
	$input = $label = $inputDefinition;
	if (strpos($inputDefinition, ':') !== FALSE) {
		$parts = explode(':', $inputDefinition);
		$input = $parts[0];
		$label = $parts[1];
	}

	$required = FALSE;
	if (substr($input, -1) === "*") {
		$input = substr($input, 0, -1);
		$required = TRUE;
	}

	return new \Helbrary\ClassBuilder\Control\Form\Input($input, $label, $required);
}
