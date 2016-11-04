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
			->object(testedClass::newInstance(true))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::newInstance(true, true))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::newInstance(false))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::newInstance(true, false))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}

	function testKeyIsInArray()
	{
		$this
			->object(testedClass::keyIsInArray($keyValue = uniqid(), [ $keyValue => '' ]))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::keyIsInArray($keyValue = 1, [ '1' => '' ]))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::keyIsInArray($keyValue = '1', [ 1 => '' ]))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::keyIsInArray($keyValue = uniqid(), [ uniqid() => '' ]))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}

	function testIsNotNull()
	{
		$this
			->object(testedClass::isNotNull(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNotNull(null))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotNull(uniqid(), null))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}

	function testIsFalse()
	{
		$this
			->object(testedClass::isFalse(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isFalse(null))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isFalse(uniqid(), null))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isFalse(false))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isFalse(false, uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isFalse(false, false))->isInstanceOf('estvoyage\risingsun\oboolean\right')
		;
	}

	function testIsTrue()
	{
		$this
			->object(testedClass::isTrue(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isTrue(null))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isTrue(uniqid(), null))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isTrue(false))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isTrue(false, uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isTrue(false, false))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isTrue(true))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isTrue(true, true))->isInstanceOf('estvoyage\risingsun\oboolean\right')
		;
	}

	function testIsNotFalse()
	{
		$this
			->object(testedClass::isNotFalse(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNotFalse(null))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNotFalse(uniqid(), null))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNotFalse(false))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotFalse(false, uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotFalse(false, false))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
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
				->object(testedClass::throwException($block))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->if(
				$this->calling($block)->blockArgumentsAre = function() { throw new \exception; }
			)
			->then
				->object(testedClass::throwException($block))->isInstanceOf('estvoyage\risingsun\oboolean\right')
		;
	}

	function testIsZero()
	{
		$this
			->object(testedClass::isZero(0))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isZero(rand(1, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isZero(0, 0))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isZero(0, rand(1, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}

	function testIsNotZero()
	{
		$this
			->object(testedClass::isNotZero(0))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotZero(rand(1, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNotZero(0, 0))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotZero(0, rand(1, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}

	function testComplement()
	{
		$this
			->object(testedClass::complement(testedClass::newInstance(false)))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::complement(testedClass::newInstance(true)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
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
				->object(testedClass::generateError($block))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')

			->if(
				$this->calling($block)->blockArgumentsAre = function() { trigger_error(uniqid()); }
			)
			->then
				->object(testedClass::generateError($block))->isInstanceOf('estvoyage\risingsun\oboolean\right')
		;
	}

	function testIsIdentical()
	{
		$this
			->object(testedClass::isIdentical(1, 1))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isIdentical(1, 1, 1))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isIdentical(1, '1', 1))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isIdentical(1, 1, '1'))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}

	function testIsEqual()
	{
		$this
			->object(testedClass::isEqual(1, 1))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isEqual(1, rand(2, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isEqual(1, 1, 1))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isEqual(1, '1', 1))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isEqual(1, 1, rand(2, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}

	function testIsNumeric()
	{
		$this
			->object(testedClass::isNumeric(rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNumeric((string) rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNumeric(rand(- PHP_INT_MAX, PHP_INT_MAX), rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNumeric(M_PI))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNumeric(rand(- PHP_INT_MAX, PHP_INT_MAX), 'foo'))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNumeric('foo'))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}

	function testIsNotNumeric()
	{
		$this
			->object(testedClass::isNotNumeric(rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotNumeric((string) rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotNumeric(rand(- PHP_INT_MAX, PHP_INT_MAX), rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotNumeric(M_PI))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotNumeric(rand(- PHP_INT_MAX, PHP_INT_MAX), 'foo'))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNotNumeric('foo'))->isInstanceOf('estvoyage\risingsun\oboolean\right')
		;
	}

	function testIsInteger()
	{
		$this
			->object(testedClass::isInteger(rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isInteger((string) rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isInteger(rand(- PHP_INT_MAX, PHP_INT_MAX), rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isInteger(rand(- PHP_INT_MAX, PHP_INT_MAX), 'foo'))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isInteger('foo'))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isInteger(M_PI))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}

	function testIsString()
	{
		$this
			->object(testedClass::isString(rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isString((string) rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isString(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isString(uniqid(), rand(- PHP_INT_MAX, PHP_INT_MAX)))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isString(uniqid(), uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isString(new objectWithToString))->isInstanceOf('estvoyage\risingsun\oboolean\right')
		;
	}

	function testIsEmptyString()
	{
		$this
			->object(testedClass::isEmptyString(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isEmptyString(uniqid(), uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isEmptyString('', uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isEmptyString(uniqid(), ''))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isEmptyString(''))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isEmptyString('', ''))->isInstanceOf('estvoyage\risingsun\oboolean\right')
		;
	}

	function testIsNotEmptyString()
	{
		$this
			->object(testedClass::isNotEmptyString(uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNotEmptyString(uniqid(), uniqid()))->isInstanceOf('estvoyage\risingsun\oboolean\right')
			->object(testedClass::isNotEmptyString(uniqid(), ''))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotEmptyString(''))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
			->object(testedClass::isNotEmptyString('', ''))->isInstanceOf('estvoyage\risingsun\oboolean\wrong')
		;
	}
}

class objectWithToString
{
	function __toString()
	{
		return '';
	}
}
