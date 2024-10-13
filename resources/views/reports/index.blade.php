    <x-app-layout>
        <div class="report-container">
            <h1 class="text-2xl font-semibold mb-4">Generate Reports</h1>
            <form action="/reports/customers/pdf" method="GET">
                <label>Customers data</label>

                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date">

                <label for="end_date">End Date:</label>
                <input type="date" name="end_date">

                <button class="generateButton" type="submit">Generate Customer PDF</button>
            </form>

            <form action="/reports/tickets/pdf" method="GET">
                <label>Tickets data</label>
            
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date">
            
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date">
            
                <label for="status">Status:</label>
                <select name="status">
                    <option value="">All</option>
                    <option value="open">Open</option>
                    <option value="inProgress">In Progress</option>
                    <option value="resolved">Resolved</option>
                    <option value="closed">Closed</option>
                </select>
            
                <button class="generateButton" type="submit">Generate Ticket PDF</button>
            </form>
            

            <div class="dashed-line"></div>

            <label>Excel File</label>
            <div class="excelButton">
                <form action="/reports/customers/csv" method="GET">
                    <button class="excelButtonGreen" type="submit">Download Customer CSV</button>
                </form>

                <form action="/reports/tickets/csv" method="GET">
                    <button class="excelButtonGreen" type="submit">Download Ticket CSV</button>
                </form>
            </div>
        </div>
    </x-app-layout>

