<?php namespace estvoyage\risingsun\time\duration\seconde\micro\operation\unary\substraction;

use estvoyage\risingsun\{ time\duration, ninteger };

class seconde
{
	private
		$seconde
	;

	function __construct(duration\seconde $seconde)
	{
		$this->seconde = $seconde;
	}

	function microSecondeRecipientForOperationWithMicroSecondeIs(duration\seconde\micro $micro, duration\seconde\micro\recipient $recipient)
	{
		$micro
			->recipientOfNIntegerIs(
				new ninteger\recipient\functor(
					function($microValue) use ($micro, $recipient)
					{
						$this->seconde
							->recipientOfNIntegerIs(
								new ninteger\recipient\functor(
									function($secondeValue) use ($micro, $microValue, $recipient)
									{
										(new ninteger\operation\binary\multiplication)
											->recipientOfOperationOnNIntegersIs(
												$secondeValue,
												1000000,
												new ninteger\recipient\functor(
													function($secondAsMicro) use ($micro, $microValue, $recipient)
													{
														(new ninteger\operation\binary\substraction)
															->recipientOfOperationOnNIntegersIs(
																$secondAsMicro,
																$microValue,
																new ninteger\recipient\functor(
																	function($substraction) use ($micro, $recipient)
																	{
																		$micro
																			->recipientOfMicroSecondeWithNIntegerIs(
																				$substraction,
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
