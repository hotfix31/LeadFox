<?php

namespace Hotfix\LeadFox;

class Api
{
	const URL = 'https://app.leadfox.co/service/';

	private $secret = null;
	private $key = null;

	private $callCount = 0;
	
	public function __construct(array $config)
	{
		if (!array_key_exists('secret', $config) || !array_key_exists('key', $config)) {
			throw  new \Exception('secret and key api is mandatory in config');
		}

		$this->key = $config['key'];
		$this->secret = $config['secret'];
	}

	public function call($method, array $postData = array())
	{
		$url = sprintf('%s%s/', self::URL, $method);

		$postData['key'] = $this->key;
		$postData['secret'] = $this->secret;

		$client = new \GuzzleHttp\Client();
		$response = $client->request('POST', $url, [
			'form_params' => $postData
		]);

		if ($response->getStatusCode() !== 200) {
			throw new \Exception($response->getReasonPhrase(), $response->getStatusCode());
		}
		
		$this->callCount++;
		$body = (string) $response->getBody();
		return new Response(json_decode($body, true));
	}
}
