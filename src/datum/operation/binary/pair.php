<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ datum, datum\operation, block\functor, ostring, datum\operation\unary\addition, datum\operation\unary, container };

class pair
	implements
		operation\binary
{
	private
		$template,
		$prefix,
		$separator,
		$suffix
	;

	function __construct(datum $template, datum $prefix = null, datum $separator = null, datum $suffix = null)
	{
		$this->template = $template;
		$this->prefix = $prefix ?: new ostring\any('(');
		$this->separator = $separator ?: new ostring\any(':');
		$this->suffix = $suffix ?: new ostring\any(')');
	}

	function recipientOfDatumOperationOnDataIs(datum $firstDatum, datum $secondDatum, datum\recipient $recipient)
	{
		(
			new unary\pipe(
				$this->template,
				new unary\container\iterator\any(new container\iterator\engine\fifo),
				new unary\container\collection(
					new addition(new ostring\any, $this->prefix),
					new addition(new ostring\any, $firstDatum),
					new addition(new ostring\any, $this->separator),
					new addition(new ostring\any, $secondDatum),
					new addition(new ostring\any, $this->suffix)
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
