<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum, ostring, container\iterator, datum\operation\unary\container\payload };

class pipe
	implements
		datum\operation\unary
{
	private
		$container
	;

	function __construct(datum\operation\unary\container $container)
	{
		$this->container = $container;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		$currentDatum = $datum;

		$this->container
			->payloadForUnaryDatumOperationContainerIteratorIs(
				new iterator,
				new payload\functor(
					function($operation) use (& $currentDatum)
					{
						$operation->recipientOfDatumOperationWithDatumIs(
							$currentDatum,
							new datum\recipient\functor(
								function($datum) use (& $currentDatum)
								{
									$currentDatum = $datum;
								}
							)
						);
					}
				)
			)
		;

		$recipient->datumIs($currentDatum);

		return $this;
	}

	function recipientOfDatumOperationIs(datum\recipient $recipient)
	{
		return $this->recipientOfDatumOperationWithDatumIs(
			new ostring\any,
			$recipient
		);
	}
}
