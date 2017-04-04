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

	function referenceForComparisonWithOFloatIs(ofloat $ofloat, ofloat $reference)
	{
		$ofloat
			->recipientOfNFloatIs(
				new nfloat\recipient\functor(
					function($ofloatValue) use ($reference)
					{
						$reference
							->recipientOfNFloatIs(
								new nfloat\recipient\functor(
									function($referenceValue) use ($ofloatValue)
									{
										$this->comparison
											->referenceForComparisonWithOperandIs(
												$ofloatValue,
												$referenceValue
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
