<?php namespace estvoyage\risingsun\comparison\unary\container\payload;

use estvoyage\{ risingsun, risingsun\comparison, risingsun\container, risingsun\ointeger };

class block
	implements
		comparison\unary\container\payload
{
	private
		$block
	;

	function __construct(risingsun\block $block)
	{
		$this->block = $block;
	}

	function containerIteratorEngineControllerForUnaryComparisonAtPositionIs(comparison\unary $comparison, ointeger $position, container\iterator\engine\controller $controller)
	{
		$this->block->blockArgumentsAre($comparison, $position, $controller);
	}
}
