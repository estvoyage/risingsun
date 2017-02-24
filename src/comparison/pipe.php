<?php namespace estvoyage\risingsun\comparison;

use estvoyage\risingsun\{ comparison, oboolean, block\functor };

class pipe
	implements
		comparison
{
	private
		$comparisons
	;

	function __construct(comparison... $comparisons)
	{
		$this->comparisons = $comparisons;
	}

	function recipientOfComparisonIs(oboolean\recipient $recipient)
	{
		$currentOBoolean = new oboolean\ko;

		foreach ($this->comparisons as $comparison)
		{
			$comparison
				->recipientOfComparisonIs(
					new functor(
						function($oboolean) use (& $currentOBoolean)
						{
							$currentOBoolean = $oboolean;
						}
					)
				)
			;

			$currentOBoolean
				->blockForFalseIs(
					new functor(
						function() use (& $break)
						{
							$break = true;
						}
					)
				)
			;

			if ($break)
			{
				break;
			}
		}

		$recipient->obooleanIs($currentOBoolean);

		return $this;
	}
}
