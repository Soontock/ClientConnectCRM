<x-app-layout>
    <div class="container dashboardContainer mt-5" style="max-width: 60%; width: 100%;">
        <div class="titleDashboard">
            <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

            @auth
            <p>Welcome, {{ Auth::user()->name }}!</p>
            @endauth</div>
        

        <div class="row">
            <div> 
                <div class="col-md-3">
                <div class="card text-center dashboardCard">
                    <div class="card-header">
                        Total Customers
                    </div>
                    <div class="card-body">
                        <h2 class="card-customer">{{ $totalCustomers }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card dashboardCard">
                    <div class="card-header">
                        Recent Interactions
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($recentInteractions as $interaction)
                            <li class="list-group-item">
                                {{ $loop->iteration }}.
                               {{ $interaction->created_at->format('Y-m-d')}}  {{ $interaction->customer->name }}  by "{{ $interaction->type }}"
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
            <div class="col-md-4">
                <div class="card dashboardCard">
                    <div class="card-header">
                        Pending Follow-Ups : {{ $pendingFollowUps }}
                    </div>
                    <div class="card-body">
                        <canvas id="priorityChart"></canvas>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card dashboardCard">
                    <div class="card-header">
                        Active Tickets by Status
                    </div>
                    <div class="card-body">
                        <canvas class="ticketStatusChart" id="ticketsStatusChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
               
                <div class="card dashboardCard">
                    <div class="card-header">
                        Active Tickets
                    </div>
                    <table class="activeTicketTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activeTickets as $ticket)
                                <tr>
                                    <td class="text-ellipsis">{{ $ticket->title }}</td>
                                    <td class="text-ellipsis">{{ $ticket->description }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>{{ $ticket->priority }}</td>
                                    <td>{{ $ticket->created_at->format('Y-m-d')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

    @push('scripts')
    <script>
        const priorityCounts = @json($priorityCounts);
        const priorityLabels = Object.keys(priorityCounts);  // ['low', 'medium', 'high']
        const priorityData = Object.values(priorityCounts);  // [count of low, count of medium, ...]

        const priorityCtx = document.getElementById('priorityChart').getContext('2d');
        const priorityChart = new Chart(priorityCtx, {
            type: 'doughnut', // Doughnut or Pie for better visual representation
            data: {
                labels: priorityLabels,
                datasets: [{
                    label: 'Number of Pending Follow-Ups',
                    data: priorityData,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
    @endpush

    @push('scripts')
    <script>
        const ticketStatusCounts = @json($ticketStatusCounts);
        const labels = Object.keys(ticketStatusCounts);
        const data = Object.values(ticketStatusCounts);

        const ctx = document.getElementById('ticketsStatusChart').getContext('2d');
        const ticketsStatusChart = new Chart(ctx, {
            type: 'pie', // You can change this to 'line', 'pie', etc.
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Tickets',
                    data: data,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    @endpush

    <style>
        :root {
            --text-color: #000;
            --input-background: #fff;
            --input-text: #000;
            --input-border: #ccc;
            --button-primary-bg: #007bff;
            --button-secondary-bg: #6c757d;
        }

        /* Dark mode variables */
        @media (prefers-color-scheme: dark) {
            :root {
               
                --text-color: #fff;
                --input-background: #333;
                --input-text: #fff;
                --input-border: #555;
                --button-primary-bg: #0d6efd;
                --button-secondary-bg: #adb5bd;
            }
        }

        .titleDashboard{
            font-weight: bold;
        }

        .card-customer{
            font-size: 60px;
        }

        .ticketStatusChart {
            background-color: transparent; 
            border: 2px solid black;
        }

        .card {
            background-color: #fff;
            color: black; 
            margin-bottom: 20px;
            
        }

        .dashboardCard {
            height: auto; 
            transition: border 0.3s, box-shadow 0.3s;
            min-width:250px;
            margin-right:2rem;
        }

        .dashboardCard:hover {
            border: 2px solid #007bff; 
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5); 
        }

        .dashboardContainer {
            background-color: var(--background-color);
            color: var(--text-color);
            padding: 20px;
            border-radius: 10px;
            max-width: 60%; 
            margin: auto; 
        }

        .list-group-item{
            border-bottom: 1px solid black;
            font-size: 25px;
        }

        .card-header {
            background-color: rgb(122, 122, 160); 
            color: white;
            font-size:30px;
            border:1px solid black;
            border-bottom:0px;
        }

        .activeTicketTable {
            width: 50px;
        }

        .activeTicketTable th {
            background-color: rgb(122, 122, 160); 
            color: white;
            padding: 5px;
            border:1px solid black;
        }

        .text-ellipsis {
            overflow: hidden;     
            white-space: nowrap;     
            text-overflow: ellipsis;
            min-width:150px; 
            max-width:150px;    
        }

        .activeTicketTable td {
            height: 50px;
            vertical-align: middle; 
            border:1px solid black;
            padding:5px;
        }

        .activeTicketTable tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.2); 
        }

        .row {
            display: flex;
            flex-wrap: wrap; 
        }
    </style>
</x-app-layout>
