<?php namespace estvoyage\risingsun\http\route\collection\payload;

use estvoyage\{ risingsun, risingsun\block, risingsun\http };

class requestFromRecipient
	implements
		http\route\collection\payload
{
	private
		$request,
		$recipient
	;

	function __construct(http\request $request, http\response\recipient $recipient)
	{
		$this->request = $request;
		$this->recipient = $recipient;
	}

	function currentHttpRouteOfIteratorIs(risingsun\iterator $iterator, http\route $route)
	{
		$route
			->recipientOfHttpResponseForRequestIs(
				$this->request,
				new http\response\recipient\block(
					new block\functor(
						function($response) use ($iterator) {
							$iterator->nextIteratorValuesAreUseless();

							$this->recipient->httpResponseIs($response);
						}
					)
				)
			)
		;

		return $this;
	}
}
