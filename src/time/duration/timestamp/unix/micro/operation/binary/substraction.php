<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro\operation\binary;

use estvoyage\risingsun\nfloat;

class substraction extends any
{
	function __construct()
	{
		parent::__construct(new nfloat\operation\binary\substraction);
	}
}
