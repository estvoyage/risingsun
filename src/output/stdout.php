<?php namespace estvoyage\risingsun\output;

use estvoyage\risingsun\{ output, ostring, block\functor };

class stdout
	implements
		output
{
	function nstringIs(string $nstring)
	{
		echo $nstring;

		return $this;
	}

	function endOfLine()
	{
		return $this->nstringIs(PHP_EOL);
	}

	function outputLineIs(ostring $line)
	{
		$line->recipientOfNStringIs(
			new functor(
				function($nstring)
				{
					$this
						->nstringIs($nstring)
						->endOfLine()
					;
				}
			)
		);

		return $this;
	}
}
