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
 * @copyright  (c) 2021, Jose Lorente
 */

namespace Homedoctor\Holded\Exception;

class ApiLimitExceededException extends HoldedApiException
{

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('You have reached the Holded Api rate limit!');
    }

}
