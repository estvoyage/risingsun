<?php namespace estvoyage\risingsun\comparison\binary\container;

use estvoyage\risingsun\{ comparison\binary as comparison, container, ointeger };

interface payload
{
	function iteratorControllerForBinaryComparisonAtPositionIs(comparison $comparison, ointeger $position, container\iterator\controller $controller);
}
