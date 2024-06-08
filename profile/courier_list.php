<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/complain_history.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="icon" href="favicon.ico">
</head>
<body>
    <!-- Include the sidebar using PHP -->
    <?php include '../shared/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Courier List</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Courier ID</th>
                        <th>Courier Name</th>
                        <th>Complain Count</th>
                    </tr>
                </thead>
                <tbody id="courier-table-body">
                    <!-- Courier data will be loaded here dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('get_courier_data.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('courier-table-body');
                    tableBody.innerHTML = '';
                    data.forEach(courier => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${courier.id}</td>
                            <td>${courier.courierName}</td>
                            <td>${courier.complainCount}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                    document.querySelector('.main-content').style.display = 'block';
                })
                .catch(error => console.error('Error fetching courier data:', error));
        });
    </script>
</body>
</html>
