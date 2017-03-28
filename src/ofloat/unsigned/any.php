<?php namespace estvoyage\risingsun\ofloat\unsigned;

use estvoyage\risingsun\{ ofloat, datum, oboolean, block };

class any extends ofloat\any
	implements
		ofloat\unsigned
{
	function __construct($value = 0.)
	{
		try
		{
			parent::__construct($value);

			self::recipientOfLessThanZeroComparisonOnOFloatIs(
				$this,
				new block\error(new \typeError)
			);
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
					self::recipientOfLessThanZeroComparisonOnOFloatIs(
						$ofloat,
						new oboolean\recipient\false\block(
							new block\functor(
								function() use ($ofloat, $recipient)
								{
									$recipient->datumIs($ofloat);
								}
							)
						)
					);
				}
			)
		);

		return $this;
	}

	private static function recipientOfLessThanZeroComparisonOnOFloatIs(ofloat $ofloat, oboolean\recipient $recipient)
	{
		(new ofloat\comparison\unary\lessThan)
			->recipientOfOFloatComparisonWithOFloatIs(
				$ofloat,
				$recipient
			)
		;
	}
}
