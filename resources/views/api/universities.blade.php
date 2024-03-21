@extends('products.layout')
@section('content')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- CSS for the green button and button container -->
<style>
    .green-button {
        background-color: green;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .green-button:hover {
        background-color: darkgreen;
    }

    .button-container {
        margin-top: 20px;
        text-align: center;
    }
</style>

<!-- Div to contain the button -->
<div class="button-container">
    <!-- Button to trigger fetching and displaying the table -->
    <button id="fetchTableButton" class="green-button">Get API</button>
</div>


<!-- Div to contain the table initially hidden -->
<div id="tableContainer" style="display: none;">
    <table id="universities-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>University Name</th>
                <th>Country</th>
                <th>Code</th>
                <th>Domain</th>
                <th>Web Page</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table body content will be populated dynamically -->
        </tbody>
    </table>
</div>

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        // Event listener for the button click
        $('#fetchTableButton').on('click', function() {
            // Fetch data via AJAX
            $.ajax({
                url: 'http://universities.hipolabs.com/search?country=United+States',
                method: 'GET',
                success: function(data) {
                    // Check if data is an array and not empty
                    if (Array.isArray(data) && data.length > 0) {
                        // Populate table body with fetched data
                        populateTable(data);
                        // Show the table
                        $('#tableContainer').show();
                        // Initialize DataTables
                        $('#universities-table').DataTable();
                    } else {
                        console.error('Empty or invalid data returned from the API.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
        
        // Function to populate table body with data
        function populateTable(data) {
            var tableBody = $('#universities-table tbody');
            tableBody.empty(); // Clear existing table rows
            
            // Iterate over the data and append rows to the table
            $.each(data, function(index, row) {
                var newRow = $('<tr>').append(
                    $('<td>').text(row.name),
                    $('<td>').text(row.country),
                    $('<td>').text(row.alpha_two_code),
                    $('<td>').text(row.domains ? row.domains[0] : ''),
                    $('<td>').html('<a href="' + (row.web_pages ? row.web_pages[0] : '') + '" target="_blank">' + (row.web_pages ? row.web_pages[0] : '') + '</a>')
                );
                tableBody.append(newRow);
            });
        }
    });
</script>
@endsection
