<?php namespace estvoyage\risingsun\tests\units\block;

require __DIR__ . '/../../runner.php';

use estvoyage\risingsun\tests\units;
use mock\estvoyage\risingsun\{ oboolean as mockOfOBoolean, container as mockOfContainer, ointeger as mockOfOInteger, datum as mockOfDatum };

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('estvoyage\risingsun\block')
			->implements('estvoyage\risingsun\nstring\recipient')
			->implements('estvoyage\risingsun\oboolean\recipient')
			->implements('estvoyage\risingsun\container\iterator\engine')
			->implements('estvoyage\risingsun\container\payload')
			->implements('estvoyage\risingsun\ointeger\recipient')
			->implements('estvoyage\risingsun\ninteger\recipient')
			->implements('estvoyage\risingsun\datum\recipient')
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

	function testNstringIs()
	{
		$this
			->given(
				$nstring = uniqid(),

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->nstringIs($nstring))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $nstring ])
		;
	}

	function testOBooleanIs()
	{
		$this
			->given(
				$oboolean = new mockOfOBoolean,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->obooleanIs($oboolean))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $oboolean ])
		;
	}

	function testControllerOfContainerIteratorIs()
	{
		$this
			->given(
				$controller = new mockOfContainer\iterator\controller,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->controllerOfContainerIteratorIs($controller))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $controller ])
		;
	}

	function testContainerIteratorControllerForValueAtPositionIs()
	{
		$this
			->given(
				$value = uniqid(),
				$position = new mockOfContainer\iterator\position,
				$controller = new mockOfContainer\iterator\controller,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->containerIteratorControllerForValueAtPositionIs($value, $position, $controller))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $value, $position, $controller ])
		;
	}

	function testOIntegerIs()
	{
		$this
			->given(
				$ointeger = new mockOfOInteger,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->ointegerIs($ointeger))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $ointeger ])
		;
	}

	function testNIntegerIs()
	{
		$this
			->given(
				$ninteger = rand(- PHP_INT_MAX, PHP_INT_MAX),

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->nintegerIs($ninteger))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $ninteger ])
		;
	}

	function testDatumIs()
	{
		$this
			->given(
				$datum = new mockOfDatum,

				$callable = function() use (& $arguments) {
					$arguments = func_get_args();
				}
			)
			->if(
				$this->newTestedInstance($callable)
			)
			->then
				->object($this->testedInstance->datumIs($datum))
					->isEqualTo($this->newTestedInstance($callable))
				->array($arguments)
					->isEqualTo([ $datum ])
		;
	}
}
