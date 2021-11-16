<?php

namespace HomedoctorEs\Holded\Resources;

use HomedoctorEs\Holded\Resources\Abstracts\Invoicing;

class Contact extends Invoicing
{

    /**
     * @inheritDoc
     */
    public function baseUri(): string
    {
        return parent::baseUri() . 'contacts';
    }

    /**
     * Returns a list of contacts
     *
     * @return array
     */
    public function list(): array
    {
        return $this->_get();
    }

    /**
     * Returns a single contact using its id
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        return $this->_get($id);
    }

}