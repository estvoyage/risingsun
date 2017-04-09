<?php namespace estvoyage\risingsun\block;

use estvoyage\risingsun;

class fowarder
	implements
		risingsun\block
{
	private
		$value,
		$block
	;

	function __construct($value, risingsun\block $block)
	{
		$this->value = $value;
		$this->block = $block;
	}

	function blockArgumentsAre(... $arguments)
	{
		$this->block->blockArgumentsAre($this->value);

		return $this;
	}
}
