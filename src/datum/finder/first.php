<?php namespace estvoyage\risingsun\datum\finder;

use estvoyage\risingsun\{ ointeger, datum, nstring, comparison, block };

class first
	implements
		datum\finder
{
	private
		$start
	;

	function __construct(ointeger $start = null)
	{
		$this->start = $start ?: new ointeger\unsigned\any;
	}

	function recipientOfSearchOfDatumInDatumIs(datum $search, datum $datum, recipient $recipient)
	{
		$search
			->recipientOfNStringIs(
				new nstring\recipient\functor(
					function($searchValue) use ($datum, $recipient)
					{
						$datum
							->recipientOfNStringIs(
								new nstring\recipient\functor(
									function($datumValue) use ($searchValue, $recipient)
									{
										(new comparison\unary\with\numeric\type)
											->recipientOfComparisonWithOperandIs(
												$position = strpos($datumValue, $searchValue),
												new comparison\recipient\functor\ok(
													function() use ($recipient, & $position)
													{
														$this->start
															->recipientOfOIntegerWithNIntegerIs(
																$position,
																new ointeger\recipient\functor(
																	function($position) use ($recipient)
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
