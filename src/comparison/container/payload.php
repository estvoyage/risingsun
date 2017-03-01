<?php namespace estvoyage\risingsun\comparison\container;

use estvoyage\risingsun\{ comparison, container, ointeger };

interface payload
{
	function iteratorControllerForComparisonAtPositionIs(comparison\binary $comparison, ointeger $position, container\iterator\controller $controller);
}
