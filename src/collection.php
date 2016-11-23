<?php namespace estvoyage\risingsun;

class collection
{
	private
		$values
	;

	function __construct(... $values)
	{
		$this->values = $values;
	}

	function payloadForIteratorIs(iterator $iterator, iterator\payload $payload)
	{
		$iterator->iteratorPayloadForValuesIs($this->values, $payload);

		return $this;
	}

	function recipientOfCollectionWithValueIs($value, collection\recipient $recipient)
	{
		$_this = clone $this;
		$_this->values[] = $value;

		$recipient->collectionIs($_this);

		return $this;
	}
}
