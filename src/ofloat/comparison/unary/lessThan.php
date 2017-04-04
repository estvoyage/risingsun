<?php namespace estvoyage\risingsun\ofloat\comparison\unary;

use estvoyage\risingsun\{ ofloat, block };

class lessThan extends any
{
	function __construct(block $ok, ofloat $reference = null, block $ko = null)
	{
		parent::__construct(new ofloat\comparison\binary\lessThan($ok, $ko), $reference);
	}
}
