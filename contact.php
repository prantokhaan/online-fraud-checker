<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="images/favicon.png">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        
        /* Contact Container */
        .contact-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        /* Title */
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 36px;
            color: #007bff;
            position: relative;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        h1::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: #007bff;
            transition: width 0.3s ease;
        }
        
        h1:hover::after {
            width: 100px;
        }

        h1:hover {
            color: #0056b3;
        }
        
        /* Form */
        form {
            margin-top: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
            background-color: #f9f9f9;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        
        textarea {
            resize: vertical;
        }
        
        /* Submit Button */
        .submit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .submit-btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <?php include 'landing_page/navbar.php'; ?>
    <div class="contact-container">
        <h1>Contact Us</h1>
        <form action="#">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="6" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>
    <script src="./js/navbar.js"></script>
</body>
</html>
