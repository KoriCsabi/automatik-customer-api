<?php

namespace App\Repositories\CustomerRepositories;

use App\Models\Customer;
use App\Repositories\AbstractBaseRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CustomerRepositories\CustomerRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CustomerRepository extends AbstractBaseRepository implements CustomerRepositoryInterface
{

    public function save(Model $customer): Model 
    {
        return $customer->updateOrCreate(
            [
                'id' => $customer->id
            ],
            [
                'name' => $customer->name,
                'address' => $customer->address,
                'customer_code' => $customer->customer_code,
                'contract_date' => $customer->contract_date
            ]
        );
    }

    public function findById(int $id): Model
    {
        return Customer::query()->findOrFail($id);
    }

    public function findAll(): Collection
    {
        return Customer::all();
    }
}