<?php namespace estvoyage\risingsun\ointeger\operation\unary;

use estvoyage\risingsun\{ ointeger\operation, ointeger, ninteger\recipient\functor };

class pow
	implements
		operation\unary
{
	private
		$pow
	;

	function __construct(ointeger $pow)
	{
		$this->pow = $pow;
	}

	function recipientOfOperationWithOIntegerIs(ointeger $ointeger, ointeger\recipient $recipient)
	{
		$this->pow
			->recipientOfNIntegerIs(
				new functor(
					function($powValue)  use ($ointeger, $recipient)
					{
						$ointeger
							->recipientOfNIntegerIs(
								new functor(
									function($ointegerValue) use ($ointeger, $recipient, $powValue)
									{
										$ointeger
											->recipientOfOIntegerWithNIntegerIs(
												pow($ointegerValue, $powValue),
												$recipient
											)
										;
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
