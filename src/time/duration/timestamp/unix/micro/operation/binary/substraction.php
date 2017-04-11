<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro\operation\binary;

use estvoyage\risingsun\ninteger;

class substraction extends any
{
	function __construct()
	{
		parent::__construct(new ninteger\operation\binary\substraction);
	}
}
