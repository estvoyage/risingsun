<?php namespace estvoyage\risingsun\ointeger\ninteger;

use estvoyage\risingsun\{ block, ointeger, ninteger };

class aggregator
{
	private
		$ointeger1,
		$ointeger2
	;

	function __construct(ointeger $ointeger1, ointeger $ointeger2)
	{
		$this->ointeger1 = $ointeger1;
		$this->ointeger2 = $ointeger2;
	}

	function blockIs(block $block)
	{
		$this->ointeger1
			->recipientOfNIntegerIs(
				new ninteger\recipient\functor(
					function($ninteger1) use ($block)
					{
						$this->ointeger2
							->recipientOfNIntegerIs(
								new ninteger\recipient\functor(
									function($ninteger2) use ($ninteger1, $block)
									{
										$block->blockArgumentsAre($ninteger1, $ninteger2);
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
