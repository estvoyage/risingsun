<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\comparison;

class greaterThanOrEqualTo extends not
{
	function __construct($reference)
	{
		parent::__construct(new comparison\unary\lessThan($reference));
	}
}
