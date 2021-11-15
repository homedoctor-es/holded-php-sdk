<?php

/**
 * Part of the Holded package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Holded
 * @version    1.0.0
 * @author     Juan Solá
 * @license    BSD License (3-clause)
 * @copyright (c) 2021, Homedoctor Smart Medicine

 */

namespace Homedoctor\Holded\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Homedoctor\Holded\ConfigInterface;
use Homedoctor\Holded\Exception\Handler;
use Homedoctor\Holded\Exception\UnauthorizedException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class Api implements ApiInterface
{

    /**
     * The client access token obtained from the Holded API.
     * 
     * @var string
     */
    protected $cachedAccessToken;

    /**
     * The Config repository instance.
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param ConfigInterface $config
     * @return void
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function _get($url = null, $parameters = [])
    {
        return $this->execute('get', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _head($url = null, array $parameters = [])
    {
        return $this->execute('head', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _delete($url = null, array $parameters = [])
    {
        return $this->execute('delete', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _put($url = null, array $parameters = [])
    {
        return $this->execute('put', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _patch($url = null, array $parameters = [])
    {
        return $this->execute('patch', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _post($url = null, array $parameters = [])
    {
        return $this->execute('post', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _options($url = null, array $parameters = [])
    {
        return $this->execute('options', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($httpMethod, $url, array $parameters = [])
    {
        try {
            return $this->doExecute($httpMethod, $url, $parameters);
        } catch (ClientException $e) {
            try {
                new Handler($e);
            } catch (UnauthorizedException $ex) {
                new Handler($e);
            }
        }
    }

    /**
     * Executes the request without error control.
     *
     * @param string $httpMethod
     * @param string $url
     * @param array $parameters
     * @return array
     */
    protected function doExecute($httpMethod, $url, array $parameters = []): array
    {
        $response = $this->getClient($this->config)->{$httpMethod}($this->composeUrl($url), $parameters);

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Composes the url of the request.
     * 
     * @param string $url
     * @return string
     */
    protected function composeUrl($url): string
    {
        return $this->baseUri() . '/' . $url;
    }

    /**
     * Returns an Http client instance.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getClient(ConfigInterface $config)
    {
        return new Client([
            'base_uri' => $config->getBaseUri(), 'handler' => $this->createHandler($config)
        ]);
    }

    /**
     * Create the client handler.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    protected function createHandler(ConfigInterface $config)
    {
        $stack = HandlerStack::create();
        $stack->push($this->getAccessTokenMiddleware($config));
        $stack->push(Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, TransferException $exception = null) use ($config) {
                    return $retries < $config->getRequestRetries() && ($exception instanceof ConnectException || ($response && $response->getStatusCode() >= 500));
                }, function ($retries) {
                    return (int) pow(2, $retries) * 1000;
                }));
        return $stack;
    }

    /**
     * 
     * @param ConfigInterface $config
     * @return callable
     */
    protected function getAccessTokenMiddleware(ConfigInterface $config)
    {
        return function (callable $next) use ($config) {
            return function (RequestInterface $request, array $options) use ($next, $config) {
                return $next($this->applyAccessToken($request, $config), $options);
            };
        };
    }

    /**
     * 
     * @param RequestInterface $request
     * @return RequestInterface
     */
    protected function applyAccessToken(RequestInterface $request, ConfigInterface $config)
    {
        return $request->withHeader('key', $this->getAccessToken($config));
    }

    /**
     * Gets the access token needed to call the api.
     * 
     * @return string
     */
    public function getAccessToken(ConfigInterface $config)
    {
        $token = $config->getApiKey();
        return $this->isAccessTokenValid($token) === false ? null : $token;
    }

    /**
     * Checks whether the client token is valid or not.
     * 
     * @param string $token
     * @return bool
     */
    public function isAccessTokenValid($token = null)
    {
        return !!$token;
    }

    /**
     * Returns the base uri fragment for this container. 
     * 
     * Do not set leading or ending slashes "/".
     * 
     * @return string
     */
    public function baseUri()
    {
        return '';
    }

}
