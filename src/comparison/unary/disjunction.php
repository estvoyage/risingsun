<?php namespace estvoyage\risingsun\comparison\unary;

use estvoyage\risingsun\{ comparison, block, oboolean };

class disjunction
	implements
		comparison\unary
{
	private
		$comparisons,
		$oboolean
	;

	function __construct(comparison\unary\container $comparisons, oboolean $oboolean)
	{
		$this->comparisons = $comparisons;
		$this->oboolean = $oboolean;
	}

	function recipientOfComparisonWithOperandIs($operand, comparison\recipient $recipient)
	{
		$self = clone $this;

		$self->comparisons
			->payloadForUnaryComparisonContainerIteratorIs(
				new comparison\unary\container\iterator\any,
				new comparison\unary\container\payload\disjunction(
					$operand,
					new comparison\recipient\oboolean(
						$self->oboolean,
						new oboolean\recipient\functor(
							new block\functor(
								function($oboolean) use ($self)
								{
									$self->oboolean = $oboolean;
								}
							)
						)
					)
				)
			)
		;

		$self->oboolean->recipientOfNBooleanIs($recipient);
	}
}
