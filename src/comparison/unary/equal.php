<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\{ comparison, block };

class equal extends any
{
	function __construct($reference, block $ok, block $ko = null)
	{
		parent::__construct($reference, new comparison\binary\equal($ok, $ko));
	}
}
