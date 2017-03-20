<?php namespace estvoyage\risingsun\datum\length\comparison;

use estvoyage\risingsun\{ ointeger, oboolean, block\functor, datum, ointeger\comparison\binary as comparison, block\proxy };

class between
	implements
		datum\length\comparison
{
	private
		$ointeger,
		$less,
		$greater
	;

	function __construct(ointeger $ointeger, comparison\lessThanOrEqualTo $less = null, comparison\greaterThanOrEqualTo $greater = null)
	{
		$this->ointeger = $ointeger;
		$this->less = $less ?: new comparison\lessThanOrEqualTo;
		$this->greater = $greater ?: new comparison\greaterThanOrEqualTo;
	}

	function recipientOfDatumLengthComparisonWithDatumIs(datum $datum, oboolean\recipient $recipient)
	{
		$datum
			->recipientOfDatumLengthIs(
				new functor(
					function($length) use ($recipient)
					{
						$this
							->recipientOfDatumLengthComparisonWithDatumLengthIs(
								$length,
								$recipient
							)
						;
					}
				)
			)
		;

		return $this;
	}

	function recipientOfDatumLengthComparisonWithDatumLengthIs(ointeger\unsigned $length, oboolean\recipient $recipient)
	{
		$this->greater
			->recipientOfOIntegerComparisonBetweenOIntegersIs(
				$this->ointeger,
				new ointeger\any,
				new functor(
					function($greater) use ($length, $recipient)
					{
						$greater
							->blockForFalseIs(
								new functor(
									function() use ($recipient)
									{
										$recipient->obooleanIs(new oboolean\ko);
									}
								)
							)
							->blockForTrueIs(
								new functor(
									function() use ($length, $recipient)
									{
										$this->less
											->recipientOfOIntegerComparisonBetweenOIntegersIs(
												$this->ointeger,
												$length,
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

		return $this;
	}
}
