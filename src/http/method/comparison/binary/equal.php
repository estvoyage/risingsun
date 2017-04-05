<?php namespace estvoyage\risingsun\http\method\comparison\binary;

use estvoyage\risingsun\{ http, block, nstring, comparison };

class equal extends comparison\binary\equal
	implements
		http\method\comparison\binary
{
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
										parent::referenceForComparisonWithOperandIs(
											$httpMethodValue,
											$referenceValue
										);
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
