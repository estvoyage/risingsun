<?php namespace estvoyage\risingsun\datum\finder;

use estvoyage\risingsun\{ datum\finder, datum, ointeger, block\functor };

class after
	implements
		finder
{
	private
		$finder,
		$offset
	;

	function __construct(datum\finder $finder, ointeger\unsigned $offset)
	{
		$this->finder = $finder;
		$this->offset = $offset;
	}

	function recipientOfSearchOfDatumInDatumIs(datum $search, datum $datum, finder\recipient $recipient)
	{
		$this->finder
			->recipientOfSearchOfDatumInDatumIs(
				$search,
				$datum,
				new datum\finder\recipient\proxy(
					new functor(
						function($position) use ($recipient)
						{
							$position
								->recipientOfOIntegerOperationIs(
									new ointeger\operation\unary\addition($this->offset),
									new functor(
										function($positionWithOffset) use ($recipient)
										{
											$recipient->datumIsAtPosition($positionWithOffset);
										}
									)
								)
							;
						}
					),
					new functor(
						function() use ($recipient)
						{
							$recipient->datumDoesNotExist();
						}
					)
				)
			)
		;

		return $this;
	}
}
