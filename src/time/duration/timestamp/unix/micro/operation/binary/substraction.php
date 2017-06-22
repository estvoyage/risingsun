<?php namespace estvoyage\risingsun\time\duration\timestamp\unix\micro\operation\binary;

use estvoyage\risingsun\{ ninteger, time\duration\timestamp };

class substraction extends any
{
	function __construct(timestamp\unix\micro $template)
	{
		parent::__construct($template, new ninteger\operation\binary\substraction);
	}
}
