<?php

namespace App\Services\CustomerServices;

use App\Models\Customer;
use Psr\Log\LoggerInterface;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;
use App\Services\CustomerServices\CustomerServiceInterface;
use App\Repositories\CustomerRepositories\CustomerRepositoryInterface;

class CustomerService implements CustomerServiceInterface
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository,
        private LoggerInterface $logger
    )
    {
    }

    /**
     * Save customer record to database
     */
    public function save(Customer $model): Customer
    {
        return $this->customerRepository->save($model);
    }

    /**
     * Create customer
     */
    public function createCustomer(array $data): CustomerResource
    {
        $customer = new Customer($data);

        $this->logger->debug("Request url: " . request()->url() . ". Route and action: " . Route::getCurrentRoute()->getActionName() . "\n - Model: " . $customer->toJson());

        $savedData = $this->save($customer);

        return new CustomerResource($savedData);
    }

    /**
     * Create customers with bulk function
     */
    public function bulkCreateCustomers(array $data): array
    {
        $createdData = [];

        foreach($data as $customerData) {
            $createdData[] = $this->createCustomer($customerData);
        }

        return $createdData;
    }

    /**
     * Update customer record by id
     */
    public function updateCustomer(int $id, array $data): CustomerResource
    {
        $customer = $this->getOneById($id);
        $customer->fill($data);

        $savedData = $this->save($customer);

        $this->logger->debug("Request url: " . request()->url() . ". Route and action: " . Route::getCurrentRoute()->getActionName() . "\n - Model: " . $customer->toJson());

        return new CustomerResource($savedData);
    }

    /**
     * Update customers with bulk function
     * Customer data required id field
     */
    public function bulkUpdateCustomers(array $data): array
    {
        $updatedData = [];

        foreach($data as $customerData) {
            $updatedData[] = $this->updateCustomer($customerData['id'], $customerData);
        }

        return $updatedData;
    }

    /**
     * Get customer record by id
     */
    public function getOneById(int $id): Customer
    {
        return $this->customerRepository->findById($id);
    }

    /**
     * Get all customers
     */
    public function getAllAsCustomerCollection(): CustomerCollection
    {
        $customers = $this->customerRepository->findAll();

        return new CustomerCollection($customers);
    }
}