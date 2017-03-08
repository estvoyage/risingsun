<?php namespace estvoyage\risingsun\ninteger\operation\binary;

use estvoyage\risingsun\{ ninteger\recipient, ninteger\operation, comparison, block\functor, oboolean };

class addition
	implements
		operation\binary
{
	private
		$controller
	;

	function __construct(operation\controller $controller = null)
	{
		$this->controller = $controller ?: new operation\controller\blackhole;
	}

	function recipientOfOperationWithNIntegersIs(int $firstOperand, int $secondOperand, recipient $recipient)
	{
		(new comparison\unary\isFloat)
			->recipientOfComparisonWithValueIs(
				$addition = $firstOperand + $secondOperand,
				new oboolean\recipient\switching(
					new functor(
						function()
						{
							$this->controller->nintegerOperationGenerateOverflow();
						}
					),
					new functor(
						function() use ($addition, $recipient)
						{
							$recipient->nintegerIs($addition);
						}
					)
				)
			)
		;

		return $this;
	}
}
