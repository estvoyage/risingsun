<?php namespace estvoyage\risingsun\hash\value;

use
	estvoyage\risingsun\hash
;

class withKey
	implements
		hash\value
{
	private
		$key,
		$value
	;

	function __construct($value, hash\key $key)
	{
		$this->key = $key;
		$this->value = $value;
	}

	function recipientOfHashValueContentsIs(hash\value\contents\recipient $recipient)
	{
		$recipient->hashValueContentsHasKey($this->value, $this->key);

		return $this;
	}
}
