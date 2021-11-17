<?php

namespace HomedoctorEs\Holded\Resources\Abstracts;

use HomedoctorEs\Holded\Core\Api;


/**
 * Crud class to manage resources
 *
 * @author Juan Solá <juan.sola@homedoctor.es>
 */
abstract class Resource extends Api
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
     * Returns a single resource using its id
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        return $this->_get($id); 
    }

    /**
     * Create a resource in Holded
     *
     * @param array $data
     * @return array
     */
    public function create(array $data = []): array
    {
        return $this->_post(null, $data);
    }

    /**
     * Update a resource in Holded
     *
     * @param $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data = []): array
    {
        return $this->_put($id, $data);
    }

    /**
     * Delete a resource in Holded
     * 
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        return $this->_delete($id);
    }

}