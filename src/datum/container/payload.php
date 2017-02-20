<?php namespace estvoyage\risingsun\datum\container;

use estvoyage\risingsun\{ container\iterator\controller, datum, ointeger };

interface payload
{
	function containerIteratorControllerForDatumAtPositionIs(datum $datum, ointeger $position, controller $controller);
}
