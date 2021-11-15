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

interface ConfigInterface
{

    /**
     * Returns the configuration headers.
     *
     * @return array
     */
    public function getHeaders();

    /**
     * Returns the API base uri.
     *
     * @return string
     */
    public function getBaseUri();

    /**
     * Sets the API base uri.
     *
     * @param string $uri
     * @return $this
     */
    public function setBaseUri($uri);

    /**
     * Returns the current package version.
     *
     * @return string
     */
    public function getVersion();

    /**
     * Sets the current package version.
     *
     * @param  string  $version
     * @return $this
     */
    public function setVersion($version);

    /**
     * Returns the Holded API key.
     *
     * @return string
     */
    public function getApiKey();

    /**
     * Sets the Holded API key.
     *
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey);

    /**
     * Returns the Holded request retries value.
     *
     * @return string
     */
    public function getRequestRetries();

    /**
     * Sets the Holded API key.
     *
     * @param string $retries
     * @return $this
     */
    public function setRequestRetries($retries);
}
