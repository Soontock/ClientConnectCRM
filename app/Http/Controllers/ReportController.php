<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;
use App\Exports\CustomersExport;

class ReportController extends Controller
{

    public function index()
    {
        return view('reports.index');
    }

    public function exportCustomersCSV()
    {
        return Excel::download(new CustomersExport, 'customers.csv');
    }

    public function exportTicketsCSV()
    {
        return Excel::download(new TicketsExport, 'tickets.csv');
    }

    public function exportCustomersPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Customer::query();

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }


        $customers = $query->get();
        $pdf = PDF::loadView('reports.customers_pdf', compact('customers'));
        return $pdf->download('customers.pdf');
    }

    public function exportTicketsPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $query = Ticket::with('customer');

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $tickets = $query->get();

        $pdf = PDF::loadView('reports.tickets_pdf', compact('tickets'));

        return $pdf->download('tickets.pdf');
    }


}
