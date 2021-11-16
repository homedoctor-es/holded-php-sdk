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

namespace HomedoctorEs\Holded\Core;

interface ApiInterface
{

    /**
     * Send a GET request.
     *
     * @param string|null $url
     * @param array $parameters
     * @return array
     */
    public function _get(string $url = null, array $parameters = []);

    /**
     * Send a HEAD request.
     *
     * @param string|null $url
     * @param  array  $parameters
     * @return array
     */
    public function _head(string $url = null, array $parameters = []);

    /**
     * Send a DELETE request.
     *
     * @param string|null $url
     * @param  array  $parameters
     * @return array
     */
    public function _delete(string $url = null, array $parameters = []);

    /**
     * Send a PUT request.
     *
     * @param string|null $url
     * @param  array  $parameters
     * @return array
     */
    public function _put(string $url = null, array $parameters = []);

    /**
     * Send a PATCH request.
     *
     * @param string|null $url
     * @param  array  $parameters
     * @return array
     */
    public function _patch(string $url = null, array $parameters = []);

    /**
     * Send a POST request.
     *
     * @param string|null $url
     * @param  array  $parameters
     * @return array
     */
    public function _post(string $url = null, array $parameters = []);

    /**
     * Send an OPTIONS request.
     *
     * @param string|null $url
     * @param  array  $parameters
     * @return array
     */
    public function _options(string $url = null, array $parameters = []);

    /**
     * Executes the HTTP request.
     *
     * @param string $httpMethod
     * @param string $url
     * @param  array  $parameters
     * @return array
     */
    public function execute(string $httpMethod, string $url, array $parameters = []): array;
}
