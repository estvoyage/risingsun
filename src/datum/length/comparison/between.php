<?php namespace estvoyage\risingsun\datum\length\comparison;

use estvoyage\risingsun\{ ointeger, oboolean, datum, ointeger\comparison\binary as comparison };

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
				new ointeger\unsigned\recipient\functor(
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
				new oboolean\recipient\functor(
					function($greater) use ($length, $recipient)
					{
						$greater
							->blockForFalseIs(
								new oboolean\recipient\functor(
									function() use ($recipient)
									{
										$recipient->obooleanIs(new oboolean\ko);
									}
								)
							)
							->blockForTrueIs(
								new oboolean\recipient\functor(
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
