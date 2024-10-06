<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('addresses')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'company' => 'required|string',
        'phone' => 'required|string',
        'email' => 'required|email',
        'country' => 'required|string',
        'status' => 'required|string|in:active,inactive',
        'addresses' => 'required|array',
        'addresses.*' => 'required|string',
    ]);

    // Save the customer
    $customer = Customer::create($validated);

    // Save addresses
    foreach ($validated['addresses'] as $address) {
        $customer->addresses()->create(['address' => $address]);
    }

    return redirect()->route('customers.index');
}


    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
