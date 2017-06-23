<?php namespace estvoyage\risingsun\datum\operation\unary;

use estvoyage\risingsun\{ datum, ostring };

class surround
	implements
		datum\operation\unary
{
	private
		$leftSurrounder,
		$rightSurrounder,
		$template
	;

	function __construct(datum $template, datum $leftSurrounder, datum $rightSurrounder)
	{
		$this->template = $template;
		$this->leftSurrounder = $leftSurrounder;
		$this->rightSurrounder = $rightSurrounder;
	}

	function recipientOfDatumOperationWithDatumIs(datum $datum, datum\recipient $recipient)
	{
		(new datum\operation\unary\addition(new ostring\any, $datum))
			->recipientOfDatumOperationWithDatumIs(
				$this->leftSurrounder,
				new datum\recipient\functor(
					function($datum) use ($recipient)
					{
						(new datum\operation\unary\addition($this->template, $this->rightSurrounder))
							->recipientOfDatumOperationWithDatumIs(
								$datum,
								new datum\recipient\functor(
									function($datum) use ($recipient)
									{
										$recipient->datumIs($datum);
									}
								)
							)
						;
					}
				)
			)
		;
	}
}
