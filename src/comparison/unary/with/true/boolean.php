<?php namespace estvoyage\risingsun\comparison\unary\with\true;

use estvoyage\risingsun\{ comparison, block };

class boolean extends comparison\unary\identical
{
	function __construct()
	{
		parent::__construct(true);
	}
}
