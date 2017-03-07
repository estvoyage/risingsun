<?php namespace estvoyage\risingsun\datum\container;

use estvoyage\risingsun\{ container\iterator\engine, datum, ointeger };

interface payload
{
	function containerIteratorEngineControllerForDatumAtPositionIs(datum $datum, ointeger $position, engine\controller $controller);
}
