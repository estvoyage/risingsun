<?php namespace estvoyage\risingsun\ostring;

use estvoyage\risingsun\{ nstring, ostring };

class any
	implements
		ostring
{
	private
		$value
	;

	function __construct($value = '')
	{
		$this->value = $value;
	}

	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs($this->value);
	}
}
