<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Customer;
use App\Models\User;
use App\Models\TicketAssignment;
use Illuminate\Http\Request;

class TicketingController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $status = $request->input('status');
        $priority = $request->input('priority');
        $users = User::all();

        $tickets = Ticket::with('assignments.user')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'LIKE', "%{$query}%");
            })
            ->when($status, function ($queryBuilder) use ($status) {
                return $queryBuilder->where('status', $status);
            })
            ->when($priority, function ($queryBuilder) use ($priority) {
                return $queryBuilder->where('priority', $priority);
            })
            ->paginate(10);
        return view('tickets.index', compact('tickets', 'users'));
    }



    public function searchByEmail(Request $request)
    {
        $email = $request->input('email');

        if (!$email) {
            return response()->json(['customer' => null]);
        }

        $customer = Customer::where('email', $email)->first();

        return response()->json(['customer' => $customer]);
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:open,inProgress,resolved,closed',
            'priority' => 'required',
        ]);

        Ticket::create($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function assign(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'assigned_user' => 'required|exists:users,id',
        ]);

        TicketAssignment::updateOrCreate(
            ['ticket_id' => $request->ticket_id],
            ['user_id' => $request->assigned_user]
        );

        return redirect()->route('tickets.index')->with('success', 'Ticket assigned successfully.');
    }

    public function edit($id)
    {
        $tickets = Ticket::findOrFail($id);
        return view('tickets.edit', compact('tickets'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:open,inProgress,resolved,closed',
            'priority' => 'required',
        ]);
        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
