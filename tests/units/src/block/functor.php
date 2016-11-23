<?php

namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use
	estvoyage\risingsun\tests\units,
	estvoyage\risingsun,
	mock\estvoyage\risingsun\iterator as mockOfIterator
;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
			->implements('estvoyage\risingsun\error\manager')
			->implements('estvoyage\risingsun\iterator\payload')
		;
	}

	function testBlockArgumentsAre()
	{
		$this
			->given(
				$callable = function() use (& $arguments) { $arguments = func_get_args(); }
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
				$argument1 = uniqid(),
				$argument2 = uniqid(),
				$argument3 = uniqid()
			)
			->then
				->object($this->testedInstance->blockArgumentsAre($argument1, $argument2, $argument3))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isIdenticalTo([ $argument1, $argument2, $argument3 ])
		;
	}

	function testCurrentValueOfIteratorIs()
	{
		$this
			->given(
				$callable = function() use (& $arguments) { $arguments = func_get_args(); },
				$iterator = new mockOfIterator,
				$value = uniqid()
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->currentValueOfIteratorIs($iterator, $value))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isIdenticalTo([ $iterator, $value ])
		;
	}

	function testErrorIs()
	{
		$this
			->given(
				$callable = function() use (& $arguments) { $arguments = func_get_args(); },
				$error = new risingsun\error(uniqid())
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->errorIs($error))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isIdenticalTo([ $error ])
		;
	}
}
