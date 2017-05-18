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

	function recipientOfNStringIs(nstring\recipient $recipient) :void
	{
		$recipient->nstringIs($this->value);
	}

	function recipientOfDatumWithNStringIs(string $value, datum\recipient $recipient) :void
	{
		$datum = clone $this;
		$datum->value = $value;

		$recipient->datumIs($datum);
	}

	function recipientOfDatumLengthIs(datum\length\recipient $recipient) :void
	{
		$recipient->datumLengthIs(new datum\length(strlen($this->value)));
	}
}
