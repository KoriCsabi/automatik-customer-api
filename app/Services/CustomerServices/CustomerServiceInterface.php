<?php

namespace App\Services\CustomerServices;

use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;

interface CustomerServiceInterface 
{
    public function save(Customer $model): Customer;

    public function createCustomer(array $data): CustomerResource;

    public function bulkCreateCustomers(array $data): array;

    public function updateCustomer(int $id, array $data): CustomerResource;

    public function bulkUpdateCustomers(array $data): array;

    public function getOneById(int $id): Customer;

    public function getAllAsCustomerCollection(): CustomerCollection;
}