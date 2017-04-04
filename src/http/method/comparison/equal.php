<?php namespace estvoyage\risingsun\http\method\comparison;

use estvoyage\risingsun\{ http, block, nstring, comparison };

class equal
	implements
		http\method\comparison
{
	private
		$ok,
		$ko
	;

	function __construct(block $ok, block $ko)
	{
		$this->ok = $ok;
		$this->ko = $ko;
	}

	function referenceForComparisonWithHttpMethodIs(http\method $httpMethod, http\method $reference)
	{
		$httpMethod
			->recipientOfHttpMethodValueIs(
				new nstring\recipient\functor(
					function($httpMethodValue) use ($reference)
					{
						$reference
							->recipientOfHttpMethodValueIs(
								new nstring\recipient\functor(
									function($referenceValue) use ($httpMethodValue)
									{
										(
											new comparison\binary\equal(
												$this->ok,
												$this->ko
											)
										)
											->referenceForComparisonWithOperandIs($httpMethodValue, $referenceValue)
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
