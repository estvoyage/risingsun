<?php namespace estvoyage\risingsun\comparison\unary\not\with\integer;

use estvoyage\risingsun\{ comparison, block };

class type extends comparison\unary\with\integer\type
{
	function __construct(block $ok, block $ko = null)
	{
		parent::__construct($ko ?: new block\blackhole, $ok);
	}
}