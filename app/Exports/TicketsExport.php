<?php
namespace App\Exports;

use App\Models\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;

class TicketsExport implements FromCollection
{
    public function collection()
    {
        return Ticket::with('customer')->get();
    }
}
