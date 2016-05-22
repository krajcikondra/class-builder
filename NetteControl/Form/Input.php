<?php

namespace Helbrary\ClassBuilder\Control\Form;

class Input {


	const TYPE_TEXT = 'text';
	const TYPE_CHECKBOX = 'checkbox';
	const TYPE_TEXT_AREA = 'text_area';

	/** @var  string */
	protected $name;

	/** @var string */
	protected $label;

	/** @var  string */
	protected $type;

	/** @var  bool */
	protected $required;
	
	public function __construct($name, $label, $required = FALSE, $type = self::TYPE_TEXT)
	{
		$this->name = $name;
		$this->label = $label;
		$this->required = $required;
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	public function render()
	{
		if ($this->type === self::TYPE_TEXT) {
			$input = "\$form->addText('$this->name', '$this->label')";
		} else {
			return "NOT IMPLEMENTED YET";
		}
		if ($this->required) {
			$input .= "\n			->setRequired()";
		}
		return $input . ";";
	}

}
