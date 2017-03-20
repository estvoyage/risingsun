<?php namespace estvoyage\risingsun\datum\finder;

use estvoyage\risingsun\{ datum, ointeger, block\functor };

class operation
	implements
		datum\finder
{
	private
		$finder,
		$operation
	;

	function __construct(datum\finder $finder, ointeger\operation\unary $operation)
	{
		$this->finder = $finder;
		$this->operation = $operation;
	}

	function recipientOfSearchOfDatumInDatumIs(datum $search, datum $datum, datum\finder\recipient $recipient)
	{
		$this->finder
			->recipientOfSearchOfDatumInDatumIs(
				$search,
				$datum,
				new functor(
					function($position) use ($datum, $recipient)
					{
						$this->operation
							->recipientOfOperationWithOIntegerIs(
								$position,
								new functor(
									function($position) use ($datum, $recipient)
									{
										(new datum\length\comparison\between($position))
											->recipientOfDatumLengthComparisonWithDatumIs(
												$datum,
												new functor(
													function($comparison) use ($position, $recipient)
													{
														$comparison
															->blockForTrueIs(
																new functor(
																	function() use ($position, $recipient)
																	{
																		$recipient->datumIsAtPosition($position);
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
