<?php namespace estvoyage\risingsun\datum\length\comparison;

use estvoyage\{ risingsun, risingsun\datum\length, risingsun\block, risingsun\ointeger };

class datum
	implements
		length\comparison
{
	private
		$datum,
		$ok,
		$ko
	;

	function __construct(block $ok, risingsun\datum $datum = null, block $ko = null)
	{
		$this->datum = $datum ?: new risingsun\ostring\any;
		$this->ok = $ok;
		$this->ko = $ko ?: new block\blackhole;
	}

	function datumLengthForComparisonIs(length $length)
	{
		$this->datum
			->recipientOfDatumLengthIs(
				new length\recipient\functor(
					function($datumLength) use ($length)
					{
						(new ointeger\comparison\binary\lessThanOrEqualTo)
							->recipientOfOIntegerComparisonBetweenOperandAndReferenceIs(
								$length,
								$datumLength,
								new risingsun\comparison\recipient\oboolean(
									$this->ok,
									$this->ko
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
