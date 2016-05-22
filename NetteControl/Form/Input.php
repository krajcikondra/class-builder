<?php

namespace Helbrary\ClassBuilder\Control\Form;

class Input {


	const TYPE_TEXT = 'text';
	const TYPE_CHECKBOX = 'checkbox';
	const TYPE_TEXT_AREA = 'text_area';

	/** @var  string */
	protected $name;

	/** @var  string */
	protected $type;

	/** @var  bool */
	protected $required;
	
	public function __construct($name, $type = self::TYPE_TEXT, $required = FALSE)
	{
		$this->name = $name;
		$this->type = $type;
		$this->required = $required;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @return boolean
	 */
	public function isRequired()
	{
		return $this->required;
	}
	
	public function render()
	{
		if ($this->type === self::TYPE_TEXT) {
			return "\$form->addText('$this->name', '$this->name');";
		} else {
			return "NOT IMPLEMENTED YET";
		}
	}

}
