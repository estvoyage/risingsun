<?php namespace estvoyage\risingsun\ointeger\generator\operation\binary;

use estvoyage\risingsun\{ ointeger, ointeger\generator\operation\binary, ointeger\operation, block };

class addition extends binary
{
	function __construct(ointeger $start = null, ointeger $increment = null, ointeger $template = null, block $overflow = null)
	{
		parent::__construct($start ?: new ointeger\any, $increment ?: new ointeger\any(1), new operation\binary\addition($template ?: new ointeger\any, $overflow ?: new block\blackhole));
	}
}
