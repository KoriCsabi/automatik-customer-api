<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\BulkCreateCustomerRequest;
use App\Services\CustomerServices\CustomerServiceInterface;

class CustomerController extends Controller
{

    public function __construct(
        private CustomerServiceInterface $customerService
    )
    {        
    }

    /**
     * List all customers
     */
    public function list() 
    {
        $customers = $this->customerService->getAllAsCustomerCollection();

        return $customers;
    }

    /**
     * Create customer record
     */
    public function create(CreateCustomerRequest $request)
    {
        $data = $request->validated();

        return $this->customerService->createCustomer($data);
    }

    /**
     * Create customers with bulk action
     * Required array of customer records
     */
    public function bulkCreate(Request $request)
    {
        $data = $request->input('data');

        return $this->customerService->bulkCreateCustomers($data);
    }

    /**
     * Update customer by id
     */
    public function update(UpdateCustomerRequest $request) 
    {
        $data = $request->validated();

        return $this->customerService->updateCustomer($data['id'], $data);
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->input('data');

        return $this->customerService->bulkUpdateCustomers($data);
    }
}
