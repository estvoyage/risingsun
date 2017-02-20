<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ datum\operation, datum, nstring, block\functor };

class addition
	implements
		operation\binary
{
	function recipientOfOperationOnDataIs(datum $firstDatum, datum $secondDatum, nstring\recipient $recipient)
	{
		$firstDatum->recipientOfNStringIs(
			new functor(
				function($firstDatumValue) use ($secondDatum, $recipient)
				{
					$secondDatum->recipientOfNStringIs(
						new functor(
							function($secondDatumValue) use ($firstDatumValue, $recipient)
							{
								$recipient->nstringIs($firstDatumValue . $secondDatumValue);
							}
						)
					);
				}
			)
		);

		return $this;
	}
}
