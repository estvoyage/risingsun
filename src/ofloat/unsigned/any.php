<?php namespace estvoyage\risingsun\ofloat\unsigned;

use estvoyage\risingsun\{ ofloat, datum, comparison };

class any extends ofloat\any
	implements
		ofloat\unsigned
{
	function __construct($value = 0.)
	{
		try
		{
			parent::__construct($value);

			(new ofloat\comparison\unary\lessThan(new ofloat\any))
				->recipientOfComparisonWithOFloatIs(
					$this,
					new comparison\recipient\error(
						new \typeError
					)
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
					(new ofloat\comparison\unary\greaterThanOrEqualTo(new ofloat\any))
						->recipientOfComparisonWithOFloatIs(
							$ofloat,
							new comparison\recipient\functor\ok(
								function() use ($ofloat, $recipient)
								{
									$recipient->datumIs($ofloat);
								}
							)
						)
					;
				}
			)
		);

		return $this;
	}
}
