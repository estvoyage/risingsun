<?php namespace estvoyage\risingsun\ofloat\comparison\unary;

use estvoyage\risingsun\ofloat;

class greaterThanOrEqualTo extends any
{
	function __construct(ofloat $reference)
	{
		parent::__construct(new ofloat\comparison\binary\greaterThanOrEqualTo, $reference);
	}
}
