<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ oboolean as mockOfOBoolean, container as mockOfContainer, ointeger as mockOfOInteger, datum as mockOfDatum, ofloat as mockOfOFloat };

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
			->implements('estvoyage\risingsun\datum\operation\unary\container\payload')
			->implements('estvoyage\risingsun\nfloat\recipient')
			->implements('estvoyage\risingsun\ointeger\unsigned\recipient')
			->implements('estvoyage\risingsun\ofloat\recipient')
		;
	}

	function testBlockArgumentsAre()
	{
		$this
			->given(
				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->blockArgumentsAre())
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEmpty

			->if(
				$firstArg = uniqid(),
				$secondArg = uniqid()
			)
			->then
				->object($this->testedInstance->blockArgumentsAre($firstArg, $secondArg))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $firstArg, $secondArg ])
		;
	}

	function testContainerIteratorEngineControllerForDatumAtPositionIs()
	{
		$this
			->given(
				$datum = new mockOfDatum,
				$position = new mockOfContainer\iterator\position,
				$controller = new mockOfContainer\iterator\engine\controller,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->containerIteratorEngineControllerForDatumAtPositionIs($datum, $position, $controller))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $datum, $position, $controller ])
		;
	}

	function testContainerIteratorEngineControllerForUnaryDatumOperationAtPositionIs()
	{
		$this
			->given(
				$operation = new mockOfDatum\operation\unary,
				$position = new mockOfContainer\iterator\position,
				$controller = new mockOfContainer\iterator\engine\controller,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->containerIteratorEngineControllerForUnaryDatumOperationAtPositionIs($operation, $position, $controller))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $operation, $position, $controller ])
		;
	}

	function testNFloatIs()
	{
		$this
			->given(
				$nfloat = (float) rand(- PHP_INT_MAX, PHP_INT_MAX),

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->nfloatIs($nfloat))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $nfloat ])
		;
	}

	function testUnsignedOIntegerIs()
	{
		$this
			->given(
				$ointeger = new mockOfOInteger\unsigned,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->unsignedOIntegerIs($ointeger))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $ointeger ])
		;
	}

	function testOFloatIs()
	{
		$this
			->given(
				$ofloat = new mockOfOFloat,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->ofloatIs($ofloat))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $ofloat ])
		;
	}
}
