<?php namespace estvoyage\risingsun\http\route\collection;

use estvoyage\{risingsun, risingsun\http};

interface payload
{
	function currentHttpRouteOfIteratorIs(risingsun\iterator $iterator, http\route $route);

}
