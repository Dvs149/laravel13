<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\CustomerService;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(
        CustomerService $customerService
    ) {
        $this->customerService = $customerService;
    }

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $customers = $this->customerService->getAllCustomers();

        return view(
            'admin.customers.index',
            compact('customers')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.customers.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(
        StoreCustomerRequest $request
    ) {

        $this->customerService->storeCustomer(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Customer $customer)
    {
        return view(
            'admin.customers.edit',
            compact('customer')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        UpdateCustomerRequest $request,
        Customer $customer
    ) {

        $this->customerService->updateCustomer(
            $customer,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy(Customer $customer)
    {
        $this->customerService
            ->deleteCustomer($customer);

        return redirect()
            ->route('admin.customers.index')
            ->with(
                'success',
                'Customer deleted successfully'
            );
    }
    public function restore($id)
    {
        Customer::withTrashed()
            ->find($id)
            ->restore();
    
        return back()->with(
            'success',
            'Customer restored successfully'
        );
    }
}