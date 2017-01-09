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

	function __construct(collection\iterator $iterator, collection $collection)
	{
		$this->iterator = $iterator;
		$this->collection = $collection;
	}

	function recipientOfHttpResponseForRequestIs(http\request $request, http\response\recipient $recipient)
	{
		$this->collection->payloadForIteratorIs($this->iterator, new http\route\collection\payload\requestFromRecipient($request, $recipient));

		return $this;
	}

	function recipientOfHttpUrlPathIs(http\url\path\recipient $recipient)
	{
	}
}
