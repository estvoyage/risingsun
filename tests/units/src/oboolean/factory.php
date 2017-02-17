<?php namespace estvoyage\risingsun\tests\units\oboolean;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\{ tests\units, oboolean\ok, oboolean, oboolean\ko };

class factory extends units\test
{
	function testAreEquals()
	{
		$this->object(oboolean\factory::areEquals(1, 1))->isEqualTo(new ok);
		$this->object(oboolean\factory::areEquals(1, 1.))->isEqualTo(new ok);
		$this->object(oboolean\factory::areEquals(1, '1.'))->isEqualTo(new ok);
		$this->object(oboolean\factory::areEquals(1, '1.0'))->isEqualTo(new ok);
		$this->object(oboolean\factory::areEquals(1, '1'))->isEqualTo(new ok);
		$this->object(oboolean\factory::areEquals(1, rand(2, PHP_INT_MAX)))->isEqualTo(new ko);
		$this->object(oboolean\factory::areEquals('foo', 'foo'))->isEqualTo(new ok);
		$this->object(oboolean\factory::areEquals('foo', 'bar'))->isEqualTo(new ko);
	}

	function testAreIdenticals()
	{
		$this->object(oboolean\factory::areIdenticals(1, 1))->isEqualTo(new ok);
		$this->object(oboolean\factory::areIdenticals(1, 1.))->isEqualTo(new ko);
		$this->object(oboolean\factory::areIdenticals(1, '1.'))->isEqualTo(new ko);
		$this->object(oboolean\factory::areIdenticals(1, '1.0'))->isEqualTo(new ko);
		$this->object(oboolean\factory::areIdenticals(1, '1'))->isEqualTo(new ko);
		$this->object(oboolean\factory::areIdenticals(1, rand(2, PHP_INT_MAX)))->isEqualTo(new ko);
		$this->object(oboolean\factory::areIdenticals('foo', 'foo'))->isEqualTo(new ok);
		$this->object(oboolean\factory::areIdenticals('foo', 'bar'))->isEqualTo(new ko);
	}

	function testIsTrue()
	{
		$this->object(oboolean\factory::isTrue(true))->isEqualTo(new ok);
		$this->object(oboolean\factory::isTrue(false))->isEqualTo(new ko);
	}
}
