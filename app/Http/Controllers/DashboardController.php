<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interaction;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getDashboardData();

        if (Auth::id()) {
            $userType = Auth::user()->userType;

            if ($userType == 'support') {
                $users = User::all();
                $query = $request->input('query');
                $status = $request->input('status');
                $priority = $request->input('priority');

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
            } else {
                return view('dashboard', $data);
            }
        }

        return view('home');
    }

    private function getDashboardData()
    {
        $totalCustomers = Customer::count();
        $recentInteractions = Interaction::orderBy('created_at', 'desc')->take(4)->get();
        $pendingFollowUps = Ticket::whereIn('status', ['open', 'inProgress'])->count();
        $activeTickets = Ticket::whereIn('status', ['open', 'inProgress'])->get();

        $priorityCounts = Ticket::whereIn('status', ['open', 'inProgress'])
            ->select('priority', \DB::raw('count(*) as count'))
            ->groupBy('priority')
            ->pluck('count', 'priority');

        $ticketStatusCounts = Ticket::select('status', \DB::raw('count(*) as count'))
            ->whereIn('status', ['open', 'inProgress'])
            ->groupBy('status')
            ->orderBy('count', 'desc')
            ->pluck('count', 'status');

        return compact('totalCustomers', 'recentInteractions', 'pendingFollowUps', 'activeTickets', 'ticketStatusCounts', 'priorityCounts');
    }
}
