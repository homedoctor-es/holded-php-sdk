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

namespace HomedoctorEs\Holded;

use HomedoctorEs\Holded\Exception\ResourceNotFoundException;
use HomedoctorEs\Holded\Resources\Contact;
use HomedoctorEs\Holded\Resources\Document;
use HomedoctorEs\Holded\Resources\Invoice;


/**
 * Class Holded
 *
 * @author Juan Solá <juan.sola@homedoctor.es>
 * 
 * @method Contact contact
 * @method Document document
 * @method Invoice invoice
 * 
 */
class Holded
{

    /**
     * The package version.
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * The Config repository instance.
     *
     * @var ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param string $apiKey
     * @param string $baseUri
     * @param int $requestRetries
     * @return void
     */
    public function __construct($apiKey = null, $baseUri = null, $requestRetries = null)
    {
        $this->config = new Config(self::VERSION, $apiKey, $baseUri, $requestRetries);
    }

    /**
     * Create a new Holded API instance.
     *
     * @param string $apiKey
     * @param int $requestRetries
     * @return Holded
     */
    public static function make($apiKey = null, $requestRetries = null): Holded
    {
        return new static($apiKey, $requestRetries);
    }

    /**
     * Returns the current package version.
     *
     * @return string
     */
    public static function getVersion(): string
    {
        return self::VERSION;
    }

    /**
     * Returns the Config repository instance.
     *
     * @return ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Sets the Config repository instance.
     *
     * @param ConfigInterface $config
     * @return $this
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Returns the Holded API key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->config->getApiKey();
    }

    /**
     * Sets the Holded API key.
     *
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->config->setApiKey($apiKey);

        return $this;
    }

    /**
     * Used to do a magic
     * 
     * @throws ResourceNotFoundException
     */
    public function __call($name, $arguments)
    {
        $class = 'HomedoctorEs\\Holded\\Resources\\' . ucfirst($name);
        if (!class_exists($class)) {
            throw new ResourceNotFoundException('The requested resource does not exists');
        }
        
        $params = [$this->getConfig()];
        if (!empty($arguments)) {
            $params = array_merge($params, $arguments);
        }
        return new $class(...$params);
    }

}
