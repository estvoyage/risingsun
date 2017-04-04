<?php namespace estvoyage\risingsun\ointeger\comparison\binary;

use estvoyage\risingsun\{ ointeger, comparison\binary as comparison, ninteger\recipient\functor };

class any
	implements
		ointeger\comparison\binary
{
	private
		$comparison
	;

	function __construct(comparison $comparison)
	{
		$this->comparison = $comparison;
	}

	function referenceForComparisonWithOIntegerIs(ointeger $ointeger, ointeger $reference)
	{
		$ointeger
			->recipientOfNIntegerIs(
				new functor(
					function($ointegerValue) use ($reference)
					{
						$reference
							->recipientOfNIntegerIs(
								new functor(
									function($referenceValue) use ($ointegerValue)
									{
										$this->comparison
											->referenceForComparisonWithOperandIs(
												$ointegerValue,
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
