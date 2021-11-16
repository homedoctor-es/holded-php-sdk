<?php

namespace HomedoctorEs\Holded\Resources\Abstracts;

use HomedoctorEs\Holded\Core\Api;

abstract class Invoicing extends Api
{

    /**
     * @inheritDoc
     */
    public function baseUri(): string
    {
        return 'invoicing/v1/';
    }

}