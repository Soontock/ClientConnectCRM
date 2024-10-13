<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $customers = Customer::where('name', 'LIKE', "%{$query}%")->paginate(10);
        } else {
            $customers = Customer::paginate(10);
        }

        return view('customer.index', compact('customers'));
    }


    public function create()
    {
        return view('customer.createCustomer');
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'id_number' => 'required',
            'phoneNum' => 'required',
            'address' => 'required',
        ]);

        Customer::create($req->all());

        return redirect()->route('customer.index');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'id_number' => 'required',
            'phoneNum' => 'required',
            'address' => 'required',
        ]);
        $customer->update($request->all());
        return redirect()->route('customer.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customer.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
