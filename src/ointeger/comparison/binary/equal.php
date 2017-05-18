<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ block, comparison };

class equal extends any
{
	function __construct()
	{
		parent::__construct(new comparison\binary\equal);
	}
}
