<?php

namespace estvoyage\risingsun\tests\units;

use
	mageekguy\atoum\mock
;

class test extends \atoum
{
	function beforeTestMethod($method)
	{
		mock\controller::disableAutoBindForNewMock();

		$this->mockGenerator
			->allIsInterface()
			->eachInstanceIsUnique()
		;

		return parent::beforeTestMethod($method);
	}

	function childOfTestedClass()
	{
		$testedClassName = $this->getTestedClassName();
		$childOfTestedClass = $this->getClassNamespace() . '\childOfTestedClass';

		if (class_exists($testedClassName) && ! class_exists($childOfTestedClass) && ! (new \reflectionClass($testedClassName))->isFinal())
		{
			eval('namespace ' . $this->getClassNamespace() . ' { class childOfTestedClass extends \\' . $testedClassName . ' {} }');
		}

		if (class_exists($childOfTestedClass))
		{
			return new $childOfTestedClass(... func_get_args());
		}
	}
}
