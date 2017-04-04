<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\block;

class notNumeric extends numeric
{
	function __construct(block $ok, block $ko = null)
	{
		parent::__construct($ko ?: new block\blackhole, $ok);
	}
}
