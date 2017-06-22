<?php namespace estvoyage\risingsun\time\duration\formater;

use estvoyage\risingsun\{ output, time\duration, datum };

class seconde
	implements
		duration\formater
{
	private
		$operation
	;

	function __construct(datum\operation\unary $operation)
	{
		$this->operation = $operation;
	}

	function outputForDurationIs(duration $duration, output $output) :void
	{
		$duration
			->recipientOfNumberOfSecondeIs(
				new duration\seconde\recipient\functor(
					function($seconde) use ($output)
					{
						$this->operation
							->recipientOfDatumOperationWithDatumIs(
								$seconde,
								new datum\recipient\functor(
									function($datum) use ($output)
									{
										$output
											->datumIs($datum)
										;
									}
								)
							)
						;
					}
				)
			)
		;
	}
}
