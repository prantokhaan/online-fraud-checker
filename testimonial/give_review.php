<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="icon" href="../images/favicon.png">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            
        }
        .review-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 280px;
        }
        .review-container h2 {
            margin-bottom: 1.5rem;
        }
        .alert {
            display: none;
        }
    </style>
</head>
<body>
    <?php include '../shared/sidebar.php'; ?>
    <div class="review-container">
        <h2>Give Your Review</h2>
        <form id="reviewForm">
            <div class="form-group">
                <label for="reviewText">Review</label>
                <textarea class="form-control" id="reviewText" rows="4" placeholder="Write your review here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
        <div id="reviewAlert" class="alert alert-success mt-3" role="alert">
            Thank you for your beautiful review!
        </div>
        <div id="reviewErrorAlert" class="alert alert-danger mt-3" role="alert">
            There was an error submitting your review.
        </div>
    </div>

    <script>
        document.getElementById('reviewForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var reviewText = document.getElementById('reviewText').value;
            var username = localStorage.getItem('username');
            
            if (!username) {
                alert('No username found in localStorage.');
                return;
            }
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'submit_review.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('reviewAlert').style.display = 'block';
                    document.getElementById('reviewErrorAlert').style.display = 'none';
                } else {
                    document.getElementById('reviewErrorAlert').style.display = 'block';
                    document.getElementById('reviewAlert').style.display = 'none';
                }
            };
            xhr.send('username=' + encodeURIComponent(username) + '&reviewText=' + encodeURIComponent(reviewText));
        });
    </script>
</body>
</html>
