<?php namespace estvoyage\risingsun\datum\finder;

use estvoyage\risingsun\{ ointeger, datum, nstring, oboolean };

class first
	implements
		datum\finder
{
	private
		$start
	;

	function __construct(ointeger\unsigned $start = null)
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
										oboolean\factory::isFalse($position = strpos($datumValue, $searchValue))
											->blockForFalseIs(
												new oboolean\recipient\functor(
													function() use ($recipient, $position)
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
