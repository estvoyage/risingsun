<?php namespace estvoyage\risingsun\comparison\unary\container\payload;

use estvoyage\risingsun\{ container, comparison, ointeger, block };

class disjunction
	implements
		comparison\unary\container\payload
{
	private
		$operand,
		$recipient
	;

	function __construct($operand, comparison\recipient $recipient)
	{
		$this->operand = $operand;
		$this->recipient = $recipient;
	}

	function containerIteratorEngineControllerForUnaryComparisonAtPositionIs(comparison\unary $comparison, ointeger $position, container\iterator\engine\controller $controller)
	{
		$comparison
			->recipientOfComparisonWithOperandIs(
				$this->operand,
				new comparison\recipient\block(
					new block\functor(
						function($nboolean) use ($controller)
						{
							$this->recipient->nbooleanIs($nboolean);

							(new comparison\unary\with\true\boolean)
								->recipientOfComparisonWithOperandIs(
									$nboolean,
									new comparison\recipient\functor\ok(
										function() use ($controller)
										{
											$controller->remainingIterationsInContainerIteratorEngineAreUseless();
										}
									)
								)
							;
						}
					)
				)
			)
		;
	}
}
