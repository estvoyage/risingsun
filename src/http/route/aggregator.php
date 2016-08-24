<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http
;

interface aggregator extends http\route
{
	function recipientOfRouteAggregatorWithRouteIs(http\route $route, http\route\aggregator\recipient $recipient);

}
