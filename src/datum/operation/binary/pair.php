<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ datum, datum\operation, block\functor, ostring, datum\operation\unary\addition, datum\operation\unary };

class pair
	implements
		operation\binary
{
	private
		$prefix,
		$separator,
		$suffix
	;

	function __construct(datum $prefix = null, datum $separator = null, datum $suffix = null)
	{
		$this->prefix = $prefix ?: new ostring\any('(');
		$this->separator = $separator ?: new ostring\any(':');
		$this->suffix = $suffix ?: new ostring\any(')');
	}

	function recipientOfDatumOperationOnDataIs(datum $firstDatum, datum $secondDatum, datum\recipient $recipient)
	{
		(
			new unary\pipe(
				new unary\container\collection(
					new addition($this->prefix),
					new addition($firstDatum),
					new addition($this->separator),
					new addition($secondDatum),
					new addition($this->suffix)
				)
			)
		)
			->recipientOfDatumOperationIs(
				$recipient
			)
		;

		return $this;
	}
}
