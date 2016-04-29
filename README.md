# LeadFox API

installation via composer:

```
composer require hotfix31/leadfox
```

Exemple d'utilisation

```
<?php
include __DIR__. "/vendor/autoload.php";

try {
    $leadFoxAPI = new \Hotfix31\LeadFox\Api([
        'key' => '...',
        'secret' => '...'
    ]);
    
    $response = $leadFoxAPI->call('contact/save', [
        'email' => 'apitest@leadfox.co',
        'firstname' => 'Api',
        'lastname' => 'Test',
        'lifecycle' => 'lead',
        'properties' => [
            'test' => 'Test',
            'phone' => '(819) 565-1234'
        ],
        'lists' => [1, 2, 3]
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$message = $response->message();
if($response->success()) {
    $data = $response->data();
    $log = $response->log();
}
```
