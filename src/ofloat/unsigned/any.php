<?php namespace estvoyage\risingsun\ofloat\unsigned;

use estvoyage\risingsun\{ ofloat, datum, block };

class any extends ofloat\any
	implements
		ofloat\unsigned
{
	function __construct($value = 0.)
	{
		try
		{
			parent::__construct($value);

			(
				new ofloat\comparison\unary\lessThan
				(
					new block\error(new \typeError)
				)
			)
				->oFloatForComparisonIs(
					$this
				)
			;
		}
		catch (\typeError $exception)
		{
			throw new \typeError('Value should be an unsigned float');
		}
	}

	function recipientOfDatumWithNStringIs(string $string, datum\recipient $recipient)
	{
		parent::recipientOfDatumWithNStringIs(
			$string,
			new datum\recipient\functor(
				function($ofloat) use ($recipient)
				{
					(
						new ofloat\comparison\unary\greaterThanOrEqualTo
						(
							new block\functor(
								function() use ($ofloat, $recipient)
								{
									$recipient->datumIs($ofloat);
								}
							)
						)
					)
						->oFloatForComparisonIs(
							$ofloat
						)
					;
				}
			)
		);

		return $this;
	}

	private function blockForOFloatIs(ofloat $ofloat, block $block)
	{
	}
}
