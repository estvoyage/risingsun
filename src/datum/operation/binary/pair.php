<?php namespace estvoyage\risingsun\datum\operation\binary;

use estvoyage\risingsun\{ datum, datum\operation, nstring, block\functor, ostring };

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
		(
			$prefix ?: new ostring\any('(')
		)
			->recipientOfNStringIs(
				new functor(
					function($nstring) {
						$this->prefix = $nstring;
					}
				)
			)
		;

		(
			$separator ?: new ostring\any(':')
		)
			->recipientOfNStringIs(
				new functor(
					function($nstring) {
						$this->separator = $nstring;
					}
				)
			)
		;

		(
			$suffix ?: new ostring\any(')')
		)
			->recipientOfNStringIs(
				new functor(
					function($nstring) {
						$this->suffix = $nstring;
					}
				)
			)
		;
	}

	function recipientOfOperationOnDataIs(datum $firstDatum, datum $secondDatum, nstring\recipient $recipient)
	{
		$firstDatum->recipientOfNStringIs(
			new functor(
				function($firstDatumValue) use ($firstDatum, $secondDatum, $recipient)
				{
					$secondDatum->recipientOfNStringIs(
						new functor(
							function ($secondDatumValue) use ($firstDatum, $firstDatumValue, $recipient)
							{
								$recipient->nstringIs(
									$this->prefix . $firstDatumValue . $this->separator . $secondDatumValue . $this->suffix
								);
							}
						)
					);
				}
			)
		);

		return $this;
	}
}
