<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
        
        /* About Container */
        .about-container {
            max-width: 800px;
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
        
        /* Description */
        p {
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        /* Team Section */
        .team-section {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 30px;
        }
        
        .team-member {
            text-align: center;
        }
        
        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .team-member img:hover {
            transform: scale(1.1);
        }
        
        .team-member h3 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .team-member p {
            color: #777;
        }
    </style>
</head>
<body>
    <?php include 'landing_page/navbar.php'; ?>
    <div class="about-container">
        <h1>About Us</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
        <div class="team-section">
            <div class="team-member">
                <img src="team-member1.jpg" alt="Team Member 1">
                <h3>John Doe</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <img src="team-member2.jpg" alt="Team Member 2">
                <h3>Jane Smith</h3>
                <p>Marketing Manager</p>
            </div>
            <div class="team-member">
                <img src="team-member3.jpg" alt="Team Member 3">
                <h3>David Johnson</h3>
                <p>Lead Developer</p>
            </div>
        </div>
    </div>
    <?php include 'landing_page/footer.php'; ?>

    <script src="./js/navbar.js"></script>

</body>
</html>
