<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Template</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo img {
            max-width: 150px;
            height: auto;
        }
        
        .content {
            margin-bottom: 20px;
        }
        
        .footer {
            text-align: center;
            color: #888888;
            font-size: 12px;
        }

        /* CSS styles for the button */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .btn:hover {
            background-color: #45a049;
        }
        
        .btn:active {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="http://34.224.79.83/build/assets/logo-9a0800b4.svg" alt="Logo" class="logo">
        </div>
        
        <div class="content">
            <h1>Elev3n</h1>
            <p>Subject: Elev3n- Contact Us Inquiry</p>
            <p>Dear Admin,</p>
            <p>We have received a message through the contact form on our website. The details are as follows:<p>
            <p>{{ $details['name'] }} ,</p>
            <p><b>Phone:</b>{{ $details['phone'] }}</p>
            <p><b>Email:</b>{{ $details['email'] }}</p>
            <p><b>Message:</b>{{ $details['message'] }}</p>
            <p>Please respond to the sender's inquiry as soon as possible. Thank you for your attention to this matter.</p>

        </div>
        
        <div class="footer">
            <p>Best regards,<br>Elev3n</p>
        </div>
    </div>
</body>
</html>



