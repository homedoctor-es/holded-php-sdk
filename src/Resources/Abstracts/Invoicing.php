<?php

namespace HomedoctorEs\Holded\Resources\Abstracts;

abstract class Invoicing extends Resource
{

    /**
     * @inheritDoc
     */
    public function baseUri(): string
    {
        return 'invoicing/v1/';
    }

}