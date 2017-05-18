<?php namespace estvoyage\risingsun\http\method;

use estvoyage\risingsun\{ nstring, http, datum };

class get
	implements
		http\method
{
	function recipientOfNStringIs(nstring\recipient $recipient)
	{
		$recipient->nstringIs('GET');
	}

	function recipientOfDatumWithNStringIs(string $nstring, datum\recipient $recipient)
	{
		return $this;
	}

	function recipientOfDatumLengthIs(datum\length\recipient $recipient)
	{
		$recipient->datumLengthIs(new datum\length(3));
	}
}
