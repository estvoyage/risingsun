<?php namespace estvoyage\risingsun\http\method;

use estvoyage\risingsun\{ nstring, http, datum };

class get
	implements
		http\method
{
	function recipientOfNStringIs(nstring\recipient $recipient) :void
	{
		$recipient->nstringIs('GET');
	}

	function recipientOfDatumWithNStringIs(string $nstring, datum\recipient $recipient) :void
	{
	}

	function recipientOfDatumLengthIs(datum\length\recipient $recipient) :void
	{
		$recipient->datumLengthIs(new datum\length(3));
	}
}
