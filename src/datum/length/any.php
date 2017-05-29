<?php namespace estvoyage\risingsun\datum\length;

use estvoyage\risingsun\{ datum, ointeger, nstring };

class any
	implements
		datum\length
{
	private
		$template
	;

	function __construct(ointeger $template = null)
	{
		$this->template = $template ?: new ointeger\any;
	}

	function recipientOfLengthOfDatumIs(datum $datum, ointeger\recipient $recipient) :void
	{
		$datum
			->recipientOfNStringIs(
				new nstring\recipient\functor(
					function($nstring) use ($recipient) {
						$this->template
							->recipientOfOIntegerWithNIntegerIs(
								strlen($nstring),
								$recipient
							)
						;
					}
				)
			)
		;
	}
}
