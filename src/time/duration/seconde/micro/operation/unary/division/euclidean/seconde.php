<?php namespace estvoyage\risingsun\time\duration\seconde\micro\operation\unary\division\euclidean;

use estvoyage\risingsun\{ time\duration, ninteger, ointeger };

class seconde
{
	private
		$template
	;

	function __construct(duration\seconde $template = null)
	{
		$this->template = $template ?: new duration\seconde\any;
	}

	function secondeRecipientForOperationWithMicroSecondeIs(duration\seconde\micro $micro, duration\seconde\recipient $recipient)
	{
		$micro
			->recipientOfNIntegerIs(
				new ninteger\recipient\functor(
					function($ninteger) use ($recipient)
					{
						(new ninteger\operation\binary\division)
							->recipientOfOperationOnNIntegersIs(
								$ninteger,
								1000000,
								new ninteger\recipient\functor(
									function($ninteger) use ($recipient)
									{
										$this->template
											->recipientOfOIntegerWithNIntegerIs(
												$ninteger,
												new ointeger\recipient\functor(
													function($seconde) use ($recipient)
													{
														$recipient->secondeIs($seconde);
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
