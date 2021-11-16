<?php

namespace HomedoctorEs\Holded\Resources;

use HomedoctorEs\Holded\Resources\Abstracts\Invoicing;
use HomedoctorEs\Holded\Values\Contact as ContactValue;

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
     * @return ContactValue
     */
    public function get(string $id): ContactValue
    {
        $data = $this->_get($id);
        return ContactValue::make($data);
    }

    /**
     * @param ContactValue $contact
     * @return array
     */
    public function create(ContactValue $contact): array
    {
        return $this->_post(null, $contact->toArray());
    }

    /**
     * @param $id
     * @param ContactValue $contact
     * @return array
     */
    public function update($id, ContactValue $contact): array
    {
        return $this->_put($id, $contact->toArray());
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->_delete($id);
    }

}