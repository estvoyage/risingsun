<?php namespace estvoyage\risingsun\ostring;

use estvoyage\risingsun\{ nstring, ostring, datum };

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

	function recipientOfDatumFromDatumIs(datum $datum, datum\recipient $recipient) :void
	{
		$datum
			->recipientOfNStringIs(
				new nstring\recipient\functor(
					function($nstring) use ($recipient)
					{
						$this
							->recipientOfDatumWithNStringIs(
								$nstring,
								$recipient
							)
						;
					}
				)
			)
		;
	}

	function recipientOfDatumLengthIs(datum\length\recipient $recipient) :void
	{
		$recipient->datumLengthIs(new datum\length(strlen($this->value)));
	}
}
