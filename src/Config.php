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

namespace Homedoctor\Holded;

class Config implements ConfigInterface
{

    /**
     * The current base URI.
     * 
     * @var string 
     */
    protected $baseUri;

    /**
     * The current package version.
     *
     * @var string
     */
    protected $version;

    /**
     * The Holded API key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The Holded API token.
     *
     * @var string
     */
    protected $requestRetries;

    /**
     * Constructor.
     *
     * @param  string  $version
     * @param  string  $apiKey
     * @param  string  $requestRetries
     * @return void
     * @throws \RuntimeException
     */
    public function __construct($version, $apiKey, $baseUri, $requestRetries = 0)
    {
        $this->setVersion($version);

        $this->setApiKey($apiKey ?: getenv('HOLDED_API_KEY'));

        $this->setBaseUri($baseUri ?: getenv('HOLDED_BASE_URI'));

        $this->setRequestRetries($requestRetries ?: getenv('HOLDED_REQUEST_RETRIES') ?: 0);

        if (!$this->apiKey) {
            throw new \RuntimeException('The Holded api_key is not defined!');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseUri($uri)
    {
        $this->baseUri = $uri;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * {@inheritdoc}
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestRetries()
    {
        return $this->requestRetries;
    }

    /**
     * {@inheritdoc}
     */
    public function setRequestRetries($retries)
    {
        $this->requestRetries = $retries;
        return $this;
    }

}
