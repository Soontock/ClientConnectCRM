    <x-app-layout>
        <div class="form-container">
            <h1>Generate Reports</h1>
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

        <style>
            h1 {
                text-align: center;
                color: #333;
                font-weight: bold;
                font-size: 25px;
                margin-bottom: 10px;
            }

            .form-container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
    
            form {
                margin-bottom: 20px;
            }
    
            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }
    
            input[type="date"] {
                padding: 8px;
                margin-bottom: 10px;
                width: calc(50% - 10px);
                margin-right: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
    
            .generateButton {
                background-color: #5fa0e6;
                color: white;
                padding: 10px 10px;
                border: 1px solid;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
                display: block;
                margin-top: 10px; 
            }
    
            .generateButton:hover {
                background-color: #0056b3;
            }
    
            .excelButtonGreen {
                color: white;
                padding: 10px 10px;
                border: 1px solid;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
                background-color: #28a745;
                margin-right: 10px;
            }
    
            .excelButtonGreen:hover {
                background-color: #218838;
            }
    
            .excelButton {
                display: flex;
                gap: 10px; 
                margin-top: 10px;
            }
    
            .dashed-line {
                border-top: 2px dashed #ccc;
                margin: 20px 0;
            }
        </style>
    </x-app-layout>

