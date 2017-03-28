<?php namespace estvoyage\risingsun\nstring\recipient;

use estvoyage\risingsun\{ nstring, block };

class functor extends block\functor
	implements
		nstring\recipient
{
	function nstringIs(string $string)
	{
		return $this->blockArgumentsAre($string);
	}
}
