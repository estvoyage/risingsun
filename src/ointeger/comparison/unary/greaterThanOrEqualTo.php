<?php namespace estvoyage\risingsun\ointeger\comparison\unary;

use estvoyage\risingsun\{ ointeger, block\functor, oboolean, block };

class greaterThanOrEqualTo
	implements
		ointeger\comparison\unary
{
	private
		$reference
	;

	function __construct(ointeger $reference = null)
	{
		$this->reference = $reference ?: new ointeger\any;
	}

	function recipientOfOIntegerComparisonWithOIntegerIs(ointeger $ointeger, oboolean\recipient $recipient)
	{
		$this->reference
			->recipientOfNIntegerIs(
				new functor(
					function($referenceValue) use ($ointeger, $recipient)
					{
						$ointeger
							->recipientOfNIntegerIs(
								new functor(
									function($ointegerValue) use ($referenceValue, $recipient)
									{
										$recipient->obooleanIs(oboolean\factory::isTrue($ointegerValue >= $referenceValue));
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

	function blockForComparisonWithOIntegerIs(ointeger $ointeger, block $block)
	{
		return $this
			->recipientOfOIntegerComparisonWithOIntegerIs(
				$ointeger,
				new functor(
					function($oboolean) use ($block)
					{
						$oboolean
							->blockForTrueIs(
								new functor(
									function() use ($block)
									{
										$block->blockArgumentsAre();
									}
								)
							)
						;
					}
				)
			)
		;
	}
}
