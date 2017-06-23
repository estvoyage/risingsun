<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ datum, datum\operation, block\functor, ostring, datum\operation\unary\addition, datum\operation\unary, container, nstring };

class pair
	implements
		operation\binary
{
	private
		$join,
		$surround
	;

	function __construct(datum $template, datum $prefix = null, datum $separator = null, datum $suffix = null)
	{
		$this->join = new operation\binary\join(new ostring\any, $separator ?: new ostring\any(':'));
		$this->surround = new operation\unary\surround($template, $prefix ?: new ostring\any('('), $suffix ?: new ostring\any(')'));
	}

	function recipientOfDatumOperationOnDataIs(datum $firstDatum, datum $secondDatum, datum\recipient $recipient)
	{
		$this->join
			->recipientOfDatumOperationOnDataIs(
				$firstDatum,
				$secondDatum,
				new datum\recipient\operation(
					$this->surround,
					$recipient
				)
			)
		;
	}
}
