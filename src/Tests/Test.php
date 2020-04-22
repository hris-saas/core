<?php

namespace HRis\Core\Tests;

use HRis\Core\Traits\UseCreateApplication;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Routing\Middleware\ThrottleRequests;

class Test extends TestCase
{
    use UseCreateApplication;
    
    /**
     * Service providers to load during this test.
     *
     * @var array
     */
    protected $loadProviders = [];

    public $appPaths = [];

    public $config = [];

    protected $token;

    protected $faker;

    public $mockConsoleOutput = false;


    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(
            ThrottleRequests::class
        );
    }

    public function log_me_in()
    {
        if ($this->token) {
            return $this->token;
        }

        $data = [
            'email'    => 'tenant1@hris-saas.com',
            'password' => 'password',
        ];

        $response = $this->json('POST', 'api/login', $data);

        $data = $response->getData();

        $this->token = $data->token;

        return $this->token;
    }

    public function authApi($method, $endpoint, $data = [], $headers = [])
    {
        $token = $this->log_me_in();

        $authorizationHeader = [
            'Authorization' => 'Bearer ' . $token,
        ];

        $headers = array_merge($headers, $authorizationHeader);

        return $this->json($method, $endpoint, $data, $headers);
    }
}
