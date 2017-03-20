<?php namespace estvoyage\risingsun\ofloat\operation\binary;

use estvoyage\risingsun\{ ofloat\operation, ofloat, nfloat };

class substraction extends any
{
	function __construct()
	{
		parent::__construct(new nfloat\operation\binary\substraction);
	}
}
