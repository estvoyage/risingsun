<?php namespace estvoyage\risingsun\ostring;

use estvoyage\risingsun\{ nstring, ostring, datum, ointeger };

class any
	implements
		ostring
{
	private
		$value
	;

	function __construct($value = '')
	{
		$this->value = (string) $value;
	}

	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs($this->value);
	}

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient)
	{
		$datum = clone $this;
		$datum->value = $value;

		$recipient->datumIs($datum);

		return $this;
	}

	function recipientOfDatumLengthIs(ointeger\unsigned\recipient $recipient)
	{
		$recipient->unsignedOIntegerIs(new ointeger\unsigned\any(strlen($this->value)));

		return $this;
	}
}
