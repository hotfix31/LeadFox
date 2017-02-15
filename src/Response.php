<?php

namespace Hotfix31\LeadFox;

class Response implements \JsonSerializable
{
	protected $data;
	
	public function __construct(array $data) 
	{
		$this->data = $data;
	}
	
	public function success()
	{
		return (array_key_exists('success', $this->data) && $this->data['success']);
	}

	public function warning()
	{
		return (array_key_exists('warning', $this->data) && $this->data['warning']);
	}

	public function hasLog()
	{
		return (array_key_exists('log', $this->data) && is_array($this->data['log']) && count($this->data['log']) > 0);
	}
	
	public function __call($name, $args)
	{
		return (array_key_exists($name, $this->data)) ? $this->data[$name] : null;
	}
	
	public function jsonSerialize()
	{
		return $this->data;
	}
}
