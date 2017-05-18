<?php namespace estvoyage\risingsun\ofloat\comparison\binary;

use estvoyage\risingsun\{ block, comparison };

class lessThan extends any
{
	function __construct()
	{
		parent::__construct(new comparison\binary\lessThan);
	}
}
