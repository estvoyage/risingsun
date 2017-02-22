<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum\operation, datum, ointeger, block\functor };

class slicer
	implements
		operation\unary
{
	private
		$position,
		$length
	;

	function __construct(ointeger\unsigned $position, ointeger\unsigned $length)
	{
		$this->position = $position;
		$this->length = $length;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		$this->position
			->recipientOfNIntegerIs(
				new functor(
					function($positionValue) use ($datum, $recipient)
					{
						$this->length
							->recipientOfNIntegerIs(
								new functor(
									function($lengthValue) use ($datum, $recipient, $positionValue)
									{
										$datum
											->recipientOfNStringIs(
												new functor(
													function($datumValue) use ($datum, $recipient, $positionValue, $lengthValue)
													{
														$datum
															->recipientOfDatumWithValueIs(
																substr($datumValue, $positionValue, $lengthValue),
																$recipient
															)
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
				)
			)
		;

		return $this;
	}
}
