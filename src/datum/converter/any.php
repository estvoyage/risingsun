<?php namespace estvoyage\risingsun\datum\converter;

use estvoyage\risingsun\{ datum, nstring\recipient\functor, ostring };

class any
	implements
		datum\converter
{
	private
		$template
	;

	function __construct(datum $template = null)
	{
		$this->template = $template ?: new ostring\any;
	}

	function recipientOfDatumIs(datum $datum, datum\recipient $recipient)
	{
		$datum
			->recipientOfNStringIs(
				new functor(
					function($nstring) use ($recipient)
					{
						$this->template
							->recipientOfDatumWithNStringIs(
								$nstring,
								$recipient
							)
						;
					}
				)
			)
		;

		return $this;
	}
}
