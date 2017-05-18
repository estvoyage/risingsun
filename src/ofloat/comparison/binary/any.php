<?php namespace estvoyage\risingsun\ofloat\comparison\binary;

use estvoyage\risingsun\{ ofloat, comparison, nfloat };

class any
	implements
		ofloat\comparison\binary
{
	private
		$comparison
	;

	function __construct(comparison\binary $comparison)
	{
		$this->comparison = $comparison;
	}

	function recipientOfOFloatComparisonBetweenOperandAndReferenceIs(ofloat $ofloat, ofloat $reference, comparison\recipient $recipient)
	{
		$ofloat
			->recipientOfNFloatIs(
				new nfloat\recipient\functor(
					function($ofloatValue) use ($reference, $recipient)
					{
						$reference
							->recipientOfNFloatIs(
								new nfloat\recipient\functor(
									function($referenceValue) use ($ofloatValue, $recipient)
									{
										$this->comparison
											->recipientOfComparisonBetweenOperandAndReferenceIs(
												$ofloatValue,
												$referenceValue,
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
