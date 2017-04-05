<?php namespace estvoyage\risingsun\block\output;

use estvoyage\risingsun\{ block, ostring, output };

class line
	implements
		block
{
	private
		$ostring,
		$output
	;

	function __construct(ostring $ostring, output $output = null)
	{
		$this->ostring = $ostring;
		$this->output = $output ?: new output\stdout;
	}

	function blockArgumentsAre(... $arguments)
	{
		$this->output->outputLineIs($this->ostring);

		return $this;
	}
}
