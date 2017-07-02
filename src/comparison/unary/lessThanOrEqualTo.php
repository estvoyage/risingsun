<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\comparison;

class lessThanOrEqualTo extends any
{
	function __construct($reference)
	{
		parent::__construct($reference, new comparison\binary\lessThanOrEqualTo);
	}
}
