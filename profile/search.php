<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="stylesheet" type="text/css" href="../css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../css/search.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <?php include '../shared/sidebar.php'; ?>
    <div class="container">
        <h2>Search Page</h2>
        <form method="post" action="">
            <div class="search-box">
                <input type="text" id="search" name="search" placeholder="Enter search term">
                <select name="search_by" id="search_by">
                    <option value="name">Search by Name</option>
                    <option value="email">Search by Email</option>
                    <option value="phone">Search by Phone Number</option>
                    <option value="facebook">Search by Facebook ID</option>
                    <option value="booking">Search by Booking ID</option>
                </select>
                <button type="submit" name="submit" id="submit-btn">Search</button>
            </div>
        </form>

        <div class="results-table">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Facebook ID</th>
                        <th>Booking ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>john@example.com</td>
                        <td>1234567890</td>
                        <td>john.doe</td>
                        <td>123ABC</td>
                        <td><a href="view_user.php">View</a></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
