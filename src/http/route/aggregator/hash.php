<?php namespace estvoyage\risingsun\http\route\aggregator;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator,
	estvoyage\risingsun\oboolean
;

class hash
	implements
		http\route
{
	private
		$routeHash,
		$routeAggregator
	;

	function __construct(http\route\aggregator $routeAggregator, http\route\hash $routeHash, http\route... $routes)
	{
		(
			new class($routeAggregator, $routeHash, new block\functor(function($routeAggregator, $routeHash) { $this->routeAggregator = $routeAggregator; $this->routeHash = $routeHash; }))
				implements
					http\route\hash\recipient,
					http\route\aggregator\recipient
			{
				private
					$routeAggregator,
					$routeHash,
					$block
				;

				function __construct(http\route\aggregator $routeAggregator, http\route\hash $routeHash, block $block)
				{
					$this->routeAggregator = $routeAggregator;
					$this->routeHash = $routeHash;
					$this->block = $block;
				}

				function httpRouteHashIs(http\route\hash $hash)
				{
					$this->routeHash = $hash;

					$this->route = null;
				}

				function httpRouteAggregatorIs(http\route\aggregator $aggregator)
				{
					$this->routeAggregator = $aggregator;
				}

				function httpRoutesAre(http\route... $routes)
				{
					(new iterator\fifo)
						->iteratorPayloadForValuesIs(
							$routes,
							new block\functor(
								function($iterator, $route) {
									$this->route = $route;

									$this->routeHash->recipientOfHttpRouteHashWithRouteIs($this->route, $this);

									risingsun\oboolean::isNotNull($this->route)
										->ifTrue(new block\functor(function() {
													$this->routeAggregator->recipientOfRouteAggregatorWithRouteIs($this->route, $this);
												}
											)
										)
									;
								}
							)
						)
					;

					$this->block->blockArgumentsAre($this->routeAggregator, $this->routeHash);
				}
			}
		)
			->httpRoutesAre(... $routes)
		;
	}

	function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
	{
		(
			new class($this->routeAggregator, $this->routeHash)
				implements
					http\response\recipient
			{
				private
					$routeAggregator,
					$routeHash,
					$recipient
				;

				function __construct(http\route\aggregator $routeAggregator, http\route\hash $routeHash)
				{
					$this->routeAggregator = $routeAggregator;
					$this->routeHash = $routeHash;
				}

				function httpResponseIs(http\response $response)
				{
					$this->recipient->httpResponseIs($response);

					$this->recipient = null;
				}

				function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
				{
					$this->recipient = $recipient;

					$this->routeHash->recipientOfHttpResponseForRequestIs($request, $this);

					oboolean::isNotNull($this->recipient)
						->ifTrue(new block\functor(function() use ($recipient, $request) {
									$this->routeAggregator->recipientOfHttpResponseForRequestIs($request, $recipient);
								}
							)
						)
					;
				}
			}
		)
			->recipientOfHttpResponseForRequestIs($request, $recipient)
		;

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
		return $this;
	}
}
