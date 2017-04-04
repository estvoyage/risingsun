<?php

namespace estvoyage\risingsun\tests\units;

use
	mageekguy\atoum\mock
;

class test extends \atoum
{
	function beforeTestMethod($method)
	{
		$testedClassName = $this->getTestedClassName();

		if (class_exists($testedClassName) && ! class_exists($this->getClassNamespace() . '\childOfTestedClass') && ! (new \reflectionClass($testedClassName))->isFinal())
		{
			eval('namespace ' . $this->getClassNamespace() . ' { class childOfTestedClass extends \\' . $testedClassName . ' {} }');
		}

		mock\controller::disableAutoBindForNewMock();

		$this->mockGenerator
			->allIsInterface()
			->eachInstanceIsUnique()
		;

		return parent::beforeTestMethod($method);
	}
}
