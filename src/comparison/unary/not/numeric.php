<?php namespace estvoyage\risingsun\comparison\unary\not;

use estvoyage\risingsun\{ comparison, block };

class numeric extends comparison\unary\numeric
{
	function __construct(block $ok, block $ko = null)
	{
		parent::__construct($ko ?: new block\blackhole, $ok);
	}
}
