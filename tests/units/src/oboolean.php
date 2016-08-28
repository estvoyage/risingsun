<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\hash,
	estvoyage\risingsun\oboolean as testedClass
;

class oboolean extends units\test
{
	function testNewInstance()
	{
		$this
			->object(testedClass::newInstance(true))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::newInstance(true, true))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::newInstance(false))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::newInstance(true, false))->isInstanceOf('estvoyage\risingsun\oboolean\false')
		;
	}

	function testKeyIsInArray()
	{
		$this
			->object(testedClass::keyIsInArray($keyValue = uniqid(), [ $keyValue => '' ]))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::keyIsInArray($keyValue = uniqid(), [ uniqid() => '' ]))->isInstanceOf('estvoyage\risingsun\oboolean\false')
		;
	}

	function testIsNotNull()
	{
		$this
			->object(testedClass::isNotNull(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::isNotNull(null))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isNotNull(uniqid(), null))->isInstanceOf('estvoyage\risingsun\oboolean\false')
		;
	}
}
