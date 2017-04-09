<?php namespace estvoyage\risingsun\time\duration\seconde\micro\operation\unary\substraction;

use estvoyage\risingsun\{ time\duration, ointeger };

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
			->recipientOfOIntegerIs(
				new ointeger\recipient\functor(
					function($microValue) use ($micro, $recipient)
					{
						$this->seconde
							->recipientOfOIntegerIs(
								new ointeger\recipient\functor(
									function($secondeValue) use ($micro, $microValue, $recipient)
									{
										(new ointeger\operation\binary\multiplication)
											->recipientOfOperationOnOIntegersIs(
												$secondeValue,
												new ointeger\any(1000000),
												new ointeger\recipient\functor(
													function($secondAsMicro) use ($micro, $microValue, $recipient)
													{
														(new ointeger\operation\binary\substraction)
															->recipientOfOperationOnOIntegersIs(
																$secondAsMicro,
																$microValue,
																new ointeger\recipient\functor(
																	function($substraction) use ($micro, $recipient)
																	{
																		$micro
																			->recipientOfMicroSecondeWithOIntegerIs(
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
