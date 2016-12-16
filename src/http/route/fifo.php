<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block,
	estvoyage\risingsun\iterator,
	estvoyage\risingsun\oboolean
;

class fifo
	implements
		http\route
{
	private
		$routes
	;

	function __construct(http\route... $routes)
	{
		$this->routes = $routes;
	}

	function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
	{
		(
			new class(... $this->routes)
				implements
					http\response\recipient
			{
				private
					$routes,
					$response
				;

				function __construct(http\route... $routes)
				{
					$this->routes = $routes;
				}

				function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
				{
					(new iterator\fifo)
						->iteratorPayloadForValuesIs(
							$this->routes,
							new block\functor(
								function($iterator, $route) use ($recipient, $request) {
									$this->response = null;

									$route
										->recipientOfHttpResponseForRequestIs(
											$request,
											$this
										)
									;

									oboolean::isNotNull($this->response)
										->ifTrue(
											new block\functor(
												function() use ($recipient, $iterator) {
													$iterator->nextIteratorValuesAreUseless();

													$recipient->httpResponseIs($this->response);
												}
											)
										)
									;
								}
							)
						)
					;
				}

				function httpResponseIs(http\response $response)
				{
					$this->response = $response;
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
