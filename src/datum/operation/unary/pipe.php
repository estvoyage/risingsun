<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum, ostring };

class pipe
	implements
		datum\operation\unary
{
	private
		$template,
		$iterator,
		$container
	;

	function __construct(datum $template, datum\operation\unary\container\iterator $iterator, datum\operation\unary\container $container)
	{
		$this->template = $template;
		$this->iterator = $iterator;
		$this->container = $container;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		$currentDatum = $datum;

		$this->container
			->payloadForUnaryDatumOperationContainerIteratorIs(
				$this->iterator,
				new datum\operation\unary\container\payload\functor(
					function($operation) use (& $currentDatum)
					{
						$operation
							->recipientOfDatumOperationWithDatumIs(
								$currentDatum,
								new datum\recipient\functor(
									function($datum) use (& $currentDatum)
									{
										$currentDatum = $datum;
									}
								)
							)
						;
					}
				)
			)
		;

		$this->template
			->recipientOfDatumFromDatumIs(
				$currentDatum,
				$recipient
			)
		;
	}

	function recipientOfDatumOperationIs(datum\recipient $recipient)
	{
		$this
			->recipientOfDatumOperationWithDatumIs(
				new ostring\any,
				$recipient
			)
		;
	}
}
