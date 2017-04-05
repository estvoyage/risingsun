<?php namespace estvoyage\risingsun\comparison\unary\not\with\numeric;

use estvoyage\risingsun\{ comparison, block };

class type extends comparison\unary\with\numeric\type
{
	function __construct(block $ok, block $ko = null)
	{
		parent::__construct($ko ?: new block\blackhole, $ok);
	}
}
