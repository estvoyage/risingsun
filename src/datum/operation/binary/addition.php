<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ datum\operation, datum, block\functor };

class addition
	implements
		operation\binary
{
	function recipientOfOperationOnDataIs(datum $firstDatum, datum $secondDatum, datum\recipient $recipient)
	{
		$firstDatum->recipientOfNStringIs(
			new functor(
				function($firstDatumValue) use ($firstDatum, $secondDatum, $recipient)
				{
					$secondDatum->recipientOfNStringIs(
						new functor(
							function($secondDatumValue) use ($firstDatum, $firstDatumValue, $recipient)
							{
								$firstDatum->recipientOfDatumWithValueIs(
									$firstDatumValue . $secondDatumValue,
									$recipient
								);
							}
						)
					);
				}
			)
		);

		return $this;
	}
}
