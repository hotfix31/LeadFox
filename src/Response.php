<?php

namespace Hotfix31\LeadFox;

class Response
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
	
	public function __call($name, $args)
	{
		return (array_key_exists($name, $this->data)) ? $this->data[$name] : null;
	}
}