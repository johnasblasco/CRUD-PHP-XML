<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        h2 {
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="email"],
        input[type="hidden"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        button {
            margin-top: 10px;
            width: 100%;
            padding: 10px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover{
            background-color:#cf0606;
        }
    </style>
<body>
    
    <?php
    $movieCode = $_GET['code'] ?? '';

    $xml = simplexml_load_file('data.xml');

    if ($xml) {
        $userFound = false;
        foreach ($xml->movie as $movie) {
            if (strcasecmp($movie->code, $movieCode) === 0) {
                $userFound = true;
                $code = htmlspecialchars($movie->code);
                $title = htmlspecialchars($movie->title);
                $actor = htmlspecialchars($movie->actor);
                $genre = htmlspecialchars($movie->genre);
                $dor = htmlspecialchars($movie->dor);

                echo "<h2>Edit user</h2>";
                echo "<form action='edit.php' method='post'>";
                echo "<input type='hidden' name='original_code' value='$code'>";
                echo "Movie Code: <input type='text' name='edited_code' value='$code' required><br><br>";
                echo "Movie Title: <input type='text' name='title' value='$title' required><br><br>";
                echo "Movie Actor: <input type='text' name='actor' value='$actor' required><br><br>";
                echo "Movie Genre: <input type='text' name='genre' value='$genre' required><br><br>";
                echo "Date of Release: <input type='text' name='dor' value='$dor' required><br><br>";
                
                
                // button
                echo "<input type='submit' value='Update'>";
                echo "<a href='admin.php'><button>Back to Home</button></a>";
                echo "</form>";
                break;
            }
        }

        if (!$userFound) {
            echo "User not found.";
        }
    } else {
        echo "Error loading XML file.";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $originalcode= $_POST["original_code"];
        $editedcode = $_POST["edited_code"];
        $title = $_POST["title"];
        $actor = $_POST["actor"];
        $genre = $_POST["genre"];
        $dor = $_POST["dor"];

        foreach ($xml->movie as $movie) {
            if (strcasecmp($movie->code, $originalcode) === 0) {
                $movie->code = $editedcode;
                $movie->title = $title;
                $movie->actor = $actor;
                $movie->genre = $genre;
                $movie->dor = $dor;
                break;
            }
        }

        $xml->asXML("data.xml");

        header("Location: index.php");
        exit();
    }
?>



</body>
</html>
