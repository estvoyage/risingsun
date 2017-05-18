<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, comparison, ninteger\recipient\functor };

class any
	implements
		ointeger\comparison\binary
{
	private
		$comparison
	;

	function __construct(comparison\binary $comparison)
	{
		$this->comparison = $comparison;
	}

	function recipientOfOIntegerComparisonBetweenOperandAndReferenceIs(ointeger $ointeger, ointeger $reference, comparison\recipient $recipient)
	{
		$ointeger
			->recipientOfNIntegerIs(
				new functor(
					function($ointegerValue) use ($reference, $recipient)
					{
						$reference
							->recipientOfNIntegerIs(
								new functor(
									function($referenceValue) use ($ointegerValue, $recipient)
									{
										$this->comparison
											->recipientOfComparisonBetweenOperandAndReferenceIs(
												$ointegerValue,
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
