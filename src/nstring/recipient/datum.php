<?php namespace estvoyage\risingsun\nstring\recipient;

use estvoyage\risingsun;

class datum
	implements
		risingsun\nstring\recipient
{
	private
		$datum,
		$recipient
	;

	function __construct(risingsun\datum $datum, risingsun\datum\recipient $recipient)
	{
		$this->datum = $datum;
		$this->recipient = $recipient;
	}

	function nstringIs(string $nstring)
	{
		$this->datum
			->recipientOfDatumWithNStringIs(
				$nstring,
				$this->recipient
			)
		;
	}
}
