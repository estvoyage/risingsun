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

		$this->mockGenerator->allIsInterface();

		return parent::beforeTestMethod($method);
	}
}
