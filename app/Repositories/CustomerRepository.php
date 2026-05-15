<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    /*
    |--------------------------------------------------------------------------
    | Get All Customers
    |--------------------------------------------------------------------------
    */

    public function getAll()
    {
        return Customer::latest()->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Create Customer
    |--------------------------------------------------------------------------
    */

    public function create(array $data)
    {
        return Customer::create($data);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Customer
    |--------------------------------------------------------------------------
    */

    public function update(
        Customer $customer,
        array $data
    ) {

        return $customer->update($data);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Customer
    |--------------------------------------------------------------------------
    */

    public function delete(Customer $customer)
    {
        return $customer->delete();
    }

    public function restore($id)
    {
        return Customer::withTrashed()
            ->find($id)
            ->restore();
    }
}