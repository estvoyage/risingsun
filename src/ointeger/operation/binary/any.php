<?php namespace estvoyage\risingsun\ointeger\operation\binary;

use estvoyage\risingsun\{ ointeger\operation, ointeger, ninteger, ninteger\recipient\functor };

class any
	implements
		operation\binary
{
	private
		$template,
		$operation
	;

	function __construct(ointeger $template, ninteger\operation\binary $operation)
	{
		$this->template = $template;
		$this->operation = $operation;
	}

	function recipientOfOperationOnOIntegersIs(ointeger $firstOperand, ointeger $secondOperand, ointeger\recipient $recipient)
	{
		(new ointeger\ninteger\operation\binary($firstOperand, $secondOperand, $this->operation))
			->recipientOfNIntegerIs(
				new ninteger\recipient\functor(
					function($ninteger) use ($firstOperand, $recipient)
					{
						$this->template->recipientOfOIntegerWithNIntegerIs(
							$ninteger,
							$recipient
						);
					}
				)
			)
		;

		return $this;
	}
}
