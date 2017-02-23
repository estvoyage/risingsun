<?php namespace estvoyage\risingsun\datum\length\comparison;

use estvoyage\risingsun\{ ointeger, oboolean, block\functor, datum };

class between
	implements
		datum\length\comparison
{
	private
		$ointeger
	;

	function __construct(ointeger $ointeger)
	{
		$this->ointeger = $ointeger;
	}

	function recipientOfDatumLengthComparisonWithDatumLengthIs(ointeger\unsigned $length, oboolean\recipient $recipient)
	{
		$this->ointeger
			->recipientOfOIntegerComparisonIs(
				new ointeger\comparison\unary\greaterThanOrEqualTo,
				new functor(
					function($greaterThanOrEqualTo) use ($length, $recipient)
					{
						$greaterThanOrEqualTo
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
										$this->ointeger
											->recipientOfOIntegerComparisonIs(
												new ointeger\comparison\unary\lessThanOrEqualTo($length),
												new functor(
													function($lessThanOrEqualTo) use ($recipient)
													{
														$lessThanOrEqualTo
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
																	function() use ($recipient)
																	{
																		$recipient->obooleanIs(new oboolean\ok);
																	}
																)
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
					}
				)
			)
		;

		return $this;
	}
}
