<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator
;

class node
	implements
		http\route
{
	private
		$iterator,
		$collection
	;

	function __construct(iterator $iterator, http\route... $routes)
	{
		$this->iterator = $iterator;
		$this->collection = new http\route\collection(... $routes);
	}

	function httpRouteControllerHasRequest(http\route\controller $controller, http\request $request)
	{
		$this
			->collection
				->payloadForIteratorIs(
					$this->iterator,
					new block\functor(
						function($iterator, $route) use ($controller, $request) {
							$route->httpRouteControllerHasRequest(
								new http\route\controller\block\functor(
									new block\functor(
										function($response) use ($iterator, $controller) {
											$iterator->nextIteratorValuesAreUseless();

											$controller->httpResponseIs($response);
										}
									)
								),
								$request
							);
						}
					)
				)
		;

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
	}
}
