<?php namespace estvoyage\risingsun\output;

use estvoyage\risingsun\{ output, datum, datum\operation, nstring\recipient\functor, ostring };

class stderr extends stdout
{
	function datumIs(datum $datum)
	{
		$datum
			->recipientOfNStringIs(
				new functor(
					function($datumValue)
					{
						file_put_contents('php://stderr', $datumValue, FILE_APPEND | LOCK_EX);
					}
				)
			)
		;

		return $this;
	}
}
