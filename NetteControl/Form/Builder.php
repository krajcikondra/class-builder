<?php

namespace Helbrary\ClassBuilder\Control\Form;

use Helbrary\ClassBuilder\Control\Form;

class Builder {


	/** @var  string */
	private $className;

	/** @var  string */
	private $namespace;

	/** @var  Input[] */
	protected $inputs;

	/** @var  string */
	protected $propertyName;

	/**
	 * Builder constructor.
	 * @param string $className
	 * @param string $namespace
	 */
	public function __construct($className, $namespace)
	{
		$this->className = $className;
		$this->namespace = $namespace;
	}

	/**
	 * Add property
	 * @param string $name
	 */
	public function addProperty($name)
	{
		$this->propertyName = $name;
	}

	public function addInput(Input $input)
	{
		$this->inputs[$input->getName()] = $input;
	}


	protected function renderProperty()
	{
		if (!$this->propertyName) return "";
		return "	/** @var int */ \n"
			. "	protected \$" . $this->propertyName . ";";
	}

	protected function renderPropertySetter()
	{
		$setter = "	public function set" . strtoupper(substr($this->propertyName, 0, 1)) . substr($this->propertyName, 1) . "(\$" . $this->propertyName . ")
	{
		\$this->" . $this->propertyName . " = \$" . $this->propertyName . ";
	}";
		return $setter;
	}

	protected function renderFormInputs()
	{
		$content = "";
		foreach ($this->inputs as $input) {
			/** @var $input \Helbrary\ClassBuilder\Control\Form\Input */
			$content .= "		" . $input->render() . "\n";
		}
		return trim($content);
	}

	public function render()
	{
		$controlContent = "<?php

namespace " . $this->namespace . ";

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;


class " . $this->className . " extends Control
{

" . $this->renderProperty() . "

	public function render()
	{
		\$this->template->setFile(__DIR__ . DIRECTORY_SEPARATOR . '" . $this->className . ".latte');
		\$this->template->render();
	}

". $this->renderPropertySetter() . "
	
	public function createComponentForm()
	{
		\$form = new Form();
		" . $this->renderFormInputs() . "
		\$form->addSubmit('submit', 'Uložit');
		\$form->onSuccess[] = array(\$this, 'formSubmitted');
		return \$form;
	}

	public function formSubmitted(Form \$form, \$values)
	{
		\$values = \$form->getValues();
	}

}";
		return $controlContent;
	}
	
	public function renderFactory()
	{
		$factoryContent = "<?php\n\n"
		. "namespace " . $this->namespace . ";\n\n";
		$factoryContent .= "interface I" . $this->className . "Factory";
		$factoryContent .= "\n{";
		$factoryContent .= "\n	/**";
		$factoryContent .= "\n	 * @return " . $this->className;
		$factoryContent .= "\n	*/";
		$factoryContent .= "\n	public function create();";
		$factoryContent .= "\n}\n";
		return $factoryContent;
	}
	
	public function renderLatte()
	{
		return "{control form}\n";
	}

	/**
	 * Build files
	 * @param string $path
	 */
	public function build($path)
	{
		mkdir($path . DIRECTORY_SEPARATOR . $this->className);
		file_put_contents($path . DIRECTORY_SEPARATOR . $this->className . DIRECTORY_SEPARATOR . $this->className . ".php", $this->render());
		file_put_contents($path . DIRECTORY_SEPARATOR . $this->className . DIRECTORY_SEPARATOR . $this->className . ".latte", $this->renderLatte());
		file_put_contents($path . DIRECTORY_SEPARATOR . $this->className . DIRECTORY_SEPARATOR . "I" . $this->className . "Factory.php", $this->renderFactory());
	}
	
}