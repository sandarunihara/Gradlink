<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 100px;
            color: #ff4757;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background: #ff4757;
            color: white;
            border-radius: 5px;
            transition: 0.3s;
        }
        a:hover {
            background: #e84148;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Oops! Page Not Found</h2>
        <p>The page you're looking for doesn't exist or has been moved.</p>
        <a href="#" onclick="history.back()">Go Back</a>
    </div>
</body>
</html>
