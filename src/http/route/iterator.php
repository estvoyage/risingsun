<?php namespace estvoyage\risingsun\http\route;

use
	estvoyage\risingsun,
	estvoyage\risingsun\http,
	estvoyage\risingsun\block
;

class iterator
	implements
		http\route
{
	private
		$iterator,
		$collection
	;

	function __construct(risingsun\iterator $iterator, http\route... $routes)
	{
		$this->iterator = $iterator;
		$this->collection = new http\route\collection(... $routes);
	}

	function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
	{
		$this
			->collection
				->payloadForIteratorIs(
					$this->iterator,
					new block\functor(
						function($iterator, $route) use ($recipient, $request) {
							$route->recipientOfHttpResponseForRequestIs(
								$request,
								new http\response\recipient\block(
									new block\functor(
										function($response) use ($iterator, $recipient) {
											$iterator->nextIteratorValuesAreUseless();

											$recipient->httpResponseIs($response);
										}
									)
								)
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
