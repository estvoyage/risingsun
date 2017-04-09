<?php namespace estvoyage\risingsun\time\duration\seconde\micro\operation\unary\division\euclidean;

use estvoyage\risingsun\{ time\duration, ointeger };

class seconde
{
	private
		$template
	;

	function __construct(duration\seconde $template)
	{
		$this->template = $template;
	}

	function secondeRecipientForOperationWithMicroSecondeIs(duration\seconde\micro $micro, duration\seconde\recipient $recipient)
	{
		$micro
			->recipientOfOIntegerIs(
				new ointeger\recipient\functor(
					function($microAsOInteger) use ($recipient)
					{
						(new ointeger\operation\binary\division)
							->recipientOfOperationOnOIntegersIs(
								$microAsOInteger,
								new ointeger\any(1000000),
								new ointeger\recipient\functor(
									function($secondeInMicroAsOInteger) use ($recipient)
									{
										$this->template
											->recipientOfSecondeWithOIntegerIs(
												$secondeInMicroAsOInteger,
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
