<?php namespace estvoyage\risingsun\tests\units;

require __DIR__ . '/../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun\hash,
	estvoyage\risingsun\oboolean as testedClass,
	mock\estvoyage\risingsun\block as mockOfBlock
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

	function testIsFalse()
	{
		$this
			->object(testedClass::isFalse(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isFalse(null))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isFalse(uniqid(), null))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isFalse(false))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::isFalse(false, uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isFalse(false, false))->isInstanceOf('estvoyage\risingsun\oboolean\true')
		;
	}

	function testIsTrue()
	{
		$this
			->object(testedClass::isTrue(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isTrue(null))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isTrue(uniqid(), null))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isTrue(false))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isTrue(false, uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isTrue(false, false))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isTrue(true))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::isTrue(true, true))->isInstanceOf('estvoyage\risingsun\oboolean\true')
		;
	}

	function testIsNotFalse()
	{
		$this
			->object(testedClass::isNotFalse(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::isNotFalse(null))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::isNotFalse(uniqid(), null))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::isNotFalse(false))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isNotFalse(false, uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isNotFalse(false, false))->isInstanceOf('estvoyage\risingsun\oboolean\false')
		;
	}

	function testThrowException()
	{
		$this
			->given(
				$block = new mockOfBlock
			)
			->if(
				$this->calling($block)->blockArgumentsAre->doesNothing
			)
			->then
				->object(testedClass::throwException($block))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->if(
				$this->calling($block)->blockArgumentsAre = function() { throw new \exception; }
			)
			->then
				->object(testedClass::throwException($block))->isInstanceOf('estvoyage\risingsun\oboolean\true')
		;
	}

	function testIsZero()
	{
		$this
			->object(testedClass::isZero(0))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::isZero(rand(1, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isZero(0, 0))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::isZero(0, rand(1, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\false')
		;
	}

	function testIsNotZero()
	{
		$this
			->object(testedClass::isNotZero(0))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isNotZero(rand(1, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::isNotZero(0, 0))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->object(testedClass::isNotZero(0, rand(1, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\false')
		;
	}

	function testComplement()
	{
		$this
			->object(testedClass::complement(testedClass::newInstance(false)))->isInstanceOf('estvoyage\risingsun\oboolean\true')
			->object(testedClass::complement(testedClass::newInstance(true)))->isInstanceOf('estvoyage\risingsun\oboolean\false')
		;
	}

	function testGenerateError()
	{
		$this
			->given(
				$block = new mockOfBlock
			)
			->if(
				$this->calling($block)->blockArgumentsAre->doesNothing
			)
			->then
				->object(testedClass::generateError($block))->isInstanceOf('estvoyage\risingsun\oboolean\false')
			->if(
				$this->calling($block)->blockArgumentsAre = function() { trigger_error(uniqid()); }
			)
			->then
				->object(testedClass::generateError($block))->isInstanceOf('estvoyage\risingsun\oboolean\true')
		;
	}
}
