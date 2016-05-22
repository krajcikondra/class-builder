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
	
	public function __construct($name, $label, $type = self::TYPE_TEXT, $required = FALSE)
	{
		$this->name = $name;
		$this->type = $type;
		$this->label = $label;
		$this->required = $required;
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
			return "\$form->addText('$this->name', '$this->label');";
		} else {
			return "NOT IMPLEMENTED YET";
		}
	}

}
