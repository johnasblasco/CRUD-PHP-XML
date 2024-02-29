<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["code"])) {
    $code = $_POST["code"];
    $title = $_POST["title"];
    $actor = $_POST["actor"];
    $genre = $_POST["genre"];
    $dor = $_POST["dor"];

    // Load the XML file
    $xml = simplexml_load_file("data.xml");


    // Create a new user node
    $user = $xml->addChild("movie");

    // Add name attribute to the user node
    $user->addChild("code", $code);
    $user->addChild("title", $title);
    $user->addChild("actor", $actor);
    $user->addChild("genre", $genre);
    $user->addChild("dor", $dor);

    // Save the changes back to the XML file
    $result = $xml->asXML("data.xml");

    header("location: index.php");
    exit();
} else {
    // If the form is not submitted or name is not provided, redirect to index.html
    header("Location: index.php");
    exit();
}
?>
