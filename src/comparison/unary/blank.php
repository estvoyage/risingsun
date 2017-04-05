<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\{ comparison, block };

class blank extends equal
{
	function __construct(block $ok, block $ko = null)
	{
		parent::__construct('', $ok, $ko);
	}
}
