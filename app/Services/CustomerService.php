<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CustomerRepository;

class CustomerService
{
    protected $customerRepository;

    public function __construct(
        CustomerRepository $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    /*
    |--------------------------------------------------------------------------
    | Get All Customers
    |--------------------------------------------------------------------------
    */

    public function getAllCustomers()
    {
        return $this->customerRepository->getAll();
    }

    /*
    |--------------------------------------------------------------------------
    | Store Customer
    |--------------------------------------------------------------------------
    */

    public function storeCustomer(array $data)
    {
        if (request()->hasFile('image')) {

            $data['image'] = request()
                ->file('image')
                ->store('customers', 'public');
        }

        return $this->customerRepository->create($data);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Customer
    |--------------------------------------------------------------------------
    */

    public function updateCustomer(
        Customer $customer,
        array $data
    ) {

        if (request()->hasFile('image')) {

            // delete old image

            if (
                $customer->image &&
                Storage::disk('public')->exists(
                    $customer->image
                )
            ) {

                Storage::disk('public')->delete(
                    $customer->image
                );
            }

            // upload new image

            $data['image'] = request()
                ->file('image')
                ->store('customers', 'public');
        }

        return $this->customerRepository->update(
            $customer,
            $data
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Customer
    |--------------------------------------------------------------------------
    */

    public function deleteCustomer(Customer $customer)
    {
        if (
            $customer->image &&
            Storage::disk('public')->exists(
                $customer->image
            )
        ) {

            Storage::disk('public')->delete(
                $customer->image
            );
        }

        return $this->customerRepository->delete(
            $customer
        );
    }
}