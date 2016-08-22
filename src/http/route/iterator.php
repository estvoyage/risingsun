<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http
;

interface iterator extends http\route
{
	function recipientOfRouteIteratorWithRouteIs(http\route $route, http\route\iterator\recipient $recipient);

}
