<?php

namespace App\Repositories\Contracts;

interface BeerStyleRepositoryInterface
{
    // List all beer styles
    public function paginate($itemsPaginate);

    // List a beer style
    public function find($id);

    // Create beer style
    public function create(array $data);

    // Update a beer style
    public function update($id, array $data);

    // Delete a beer style
    public function delete($id);

}
