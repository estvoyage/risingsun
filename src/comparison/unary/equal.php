<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\{ comparison, block };

class equal extends any
{
	function __construct($reference)
	{
		parent::__construct($reference, new comparison\binary\equal);
	}
}
