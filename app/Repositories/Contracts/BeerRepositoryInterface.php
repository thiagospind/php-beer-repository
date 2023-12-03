<?php

namespace App\Repositories\Contracts;

interface BeerRepositoryInterface
{
    // List all beers
    public function all();

    // List a beer
    public function find($id);

    // Create beer
    public function create(array $data);

    // Update a beer
    public function update($id, array $data);

    // Delete a beer
    public function delete($id);

}
