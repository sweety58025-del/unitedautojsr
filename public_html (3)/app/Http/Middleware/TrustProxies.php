<?php
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     * '*' trusts all proxies — safe only in ephemeral dev environments like Codespaces.
     * In production, no proxies are trusted by default; set explicit IPs here if you're
     * behind a load balancer/CDN that adds X-Forwarded-* headers.
     *
     * @var array|string|null
     */
    protected $proxies;

    public function __construct(\Illuminate\Contracts\Foundation\Application $app, \Illuminate\Routing\ResponseFactory $response)
    {
        parent::__construct($app, $response);
        $this->proxies = $app->environment('production') ? null : '*';
    }

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
