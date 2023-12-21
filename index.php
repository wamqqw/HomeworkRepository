<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    define("HOST", "localhost");
    define("DATABASE", "classicmodels");
    define("CHARSET", "utf8");
    define("USER", "root");
    define("PASSWORD", "");
    try {
        $pdo = new PDO("mysql:host=".HOST.";dbname=".DATABASE.";charset=".CHARSET, USER, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $sql = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->execute();
        echo "Message sent successfully!";
    } catch(PDOException $e) {
        echo "Error ->: " . $e->getMessage();
    }
    $pdo = null; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form method="post" action="index.php"> 
            <label for="name">Your name:</label> 
            <input type="text" id="name" name="name" placeholder = "Enter your name"><br><br> 
            <label for="email">Your email:</label> 
            <input type="email" id="email" name="email" placeholder = "Enter your email"><br><br> 
            <label for="message">Your message:</label><br> 
            <textarea id="message" name="message" rows="4" cols="50" placeholder = "enter you message and enjoy!"></textarea><br><br> 
            <button type="submit">Send message!</button>
    </form>
</body>
</html>