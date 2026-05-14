<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            // store image in storage/app/public/customers
            $data['image'] = $request
                ->file('image')
                ->store('customers', 'public');
        }

        Customer::create($data);

        return response()->json([
                                    'success' => true,
                                    'message' => 'Customer created successfully'
                                ]);
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(
        UpdateCustomerRequest $request,
        Customer $customer
    )
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            // delete old image
            if (
                $customer->image &&
                Storage::disk('public')->exists($customer->image)
            ) {

                Storage::disk('public')->delete($customer->image);
            }

            // upload new image
            $data['image'] = $request
                ->file('image')
                ->store('customers', 'public');
        }

        $customer->update($data);

        return response()->json([
                                    'success' => true,
                                    'message' => 'Customer updated successfully'
                                ]);
    }

    public function destroy(Customer $customer)
    {
        // delete image
        if (
            $customer->image &&
            Storage::disk('public')->exists($customer->image)
        ) {

            Storage::disk('public')->delete($customer->image);
        }

        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully');
    }
}