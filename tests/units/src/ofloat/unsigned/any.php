<?php namespace estvoyage\risingsun\tests\units\ofloat\unsigned;

require __DIR__ . '/../../../runner.php';

use estvoyage\risingsun\tests\units;

class any extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\ofloat\unsigned')
		;
	}

	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('typeError')
				->hasMessage('Value should be an unsigned float')
		;
	}

	protected function invalidValueProvider()
	{
		return [
			null,
			true,
			false,
			'foobar',
			new \stdclass,
		 	rand(- PHP_INT_MAX, -1),
		 	(string) rand(- PHP_INT_MAX, -1),
			- M_PI,
			(string) - M_PI,
		];
	}
}
