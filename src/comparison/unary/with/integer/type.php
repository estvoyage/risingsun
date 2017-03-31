<?php namespace estvoyage\risingsun\comparison\unary\with\integer;

use estvoyage\risingsun\{ comparison, oboolean, block };

class type
	implements
		comparison\unary
{
	private
		$ok,
		$ko
	;

	function __construct(oboolean $ok = null, oboolean $ko = null)
	{
		$this->ok = $ok ?: new oboolean\ok;
		$this->ko = $ko ?: new oboolean\ko;
	}

	function recipientOfComparisonWithValueIs($value, oboolean\recipient $recipient)
	{
		(new comparison\unary\numeric)
			->recipientOfComparisonWithValueIs(
				$value,
				new oboolean\recipient\switcher(
					new block\functor(
						function() use ($recipient, $value)
						{
							(new comparison\binary\equal($this->ok, $this->ko))
								->recipientOfComparisonBetweenValuesIs(
									$value,
									(int) $value,
									$recipient
								)
							;
						}
					),
					new block\functor(
						function() use ($recipient)
						{
							$recipient->obooleanIs($this->ko);
						}
					)
				)
			)
		;

		return $this;
	}
}
