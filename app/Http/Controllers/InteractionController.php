<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interaction;
use App\Models\Customer;

class InteractionController extends Controller
{
    public function create(Request $request){
        $customers = Customer::all(); 
        return view('interactions.create', compact('customers'));
    }

    public function index(Request $request)
    {
        $query = $request->input('query');

        $interactions = Interaction::with('customer')
            ->whereHas('customer', function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->paginate(10); 

        return view('interactions.index', compact('interactions'));
    }


public function store(Request $request){
  $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'date_time' => 'required|date',
        'type' => 'required|string',
        'notes'=>'nullable|string',
    ]);
    $data = $request->all();
    $data['notes'] = $data['notes'] ?? '';
    Interaction::create($data);
   
    return redirect()->route('interactions.index');
    }
    
    public function edit($id)
    {
        $interactions = Interaction::findOrFail($id);
        $customers = Customer::all(); 
    
        return view('interactions.edit', compact('interactions', 'customers')); // Pass customers to the view
    }
    

    public function update(Request $request, $id)
    {
        $interactions=Interaction::findOrFail($id);
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date_time' => 'required|date',
            'type' => 'required|string',
            'notes'=>'nullable|string',
        ]);
        $interactions->update($request->all());
        return redirect()->route('interactions.index')
                        ->with('success', 'Interaction updated successfully.');
    }

    public function destroy($id)
    {
        $interaction=Interaction::findOrFail($id);
        $interaction->delete();
        return redirect()   ->route('interactions.index')
                            ->with('success', 'Interaction deleted successfully.');
    }

}