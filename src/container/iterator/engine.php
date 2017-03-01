<?php namespace estvoyage\risingsun\container\iterator;

interface engine
{
	function controllerOfContainerIteratorIs(controller $controller);
	function nextIterationsAreUseless();
}
