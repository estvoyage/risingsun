<?php namespace estvoyage\risingsun\output;

use
	estvoyage\risingsun\block,
	estvoyage\risingsun\output
;

class console
	implements
		output
{
	private
		$output,
		$formater
	;

	function __construct(output $output, output\stream\formater $formater)
	{
		$this->output = $output;
		$this->formater = $formater;
	}

	function outputStreamIs(output\stream $stream)
	{
		$this
			->formater
				->recipientOfOutputStreamWithEndOfLineIs(
					$stream,
					new output\stream\recipient\block(
						new block\functor(
							function($stream)  {
								$this
									->output
										->outputStreamIs($stream)
								;
							}
						)
					)
				)
		;

		return $this;
	}
}
