<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

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

            $image = $request->file('image');

            $imageName = time() . '.' . $image->extension();

            $image->move(public_path('uploads/customers'), $imageName);

            $data['image'] = $imageName;
        }

        Customer::create($data);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer created successfully');
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

            if (
                $customer->image &&
                file_exists(public_path('uploads/customers/' . $customer->image))
            ) {

                unlink(public_path('uploads/customers/' . $customer->image));
            }

            $image = $request->file('image');

            $imageName = time() . '.' . $image->extension();

            $image->move(public_path('uploads/customers'), $imageName);

            $data['image'] = $imageName;
        }

        $customer->update($data);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer updated successfully');
    }

    public function destroy(Customer $customer)
    {
        if (
            $customer->image &&
            file_exists(public_path('uploads/customers/' . $customer->image))
        ) {

            unlink(public_path('uploads/customers/' . $customer->image));
        }

        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully');
    }
}