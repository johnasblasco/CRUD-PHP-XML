<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            width:20px;
            height:20px;
        }
        *{
            margin: 0;
            paddding: 0;
            box-sizing: border-box;
        }
    #container{
        display:grid;
        grid-template-columns: 1fr auto auto;
        padding:10px;
    }
    #search-input, #search-button{
        height: 40px;
    }
    #btn{
        font-size: large;
        padding: 10px;
        margin-bottom: 10px;
        border:none;
        color: white;
        background-color: limegreen;
    }
    tr:nth-child(even) {
            background-color: #f2f2f2;
        }

    table{
        
        border: none;   
        text-align: center;
    } 
    th,td{
        border: none;
    }
    table{
        width: 100%;   
        
    }
    th{
        
        background-color: lightgray;
    }
    #hid{
        display: flex;
        justify-content: center;
    }

    </style>
</head>
<body>

<div id="container">
        <a href="add.html"><input id="btn" type="button" value = " + Add New Record"></a>
        <input type="text" id="search-input" placeholder="Search by Movie Code" />
        <button id="search-button" onclick="searchMovies()">Search</button>
    </div>
<table cellspacing="5" cellpadding="5" border="1" id="user-table">
    <tr>
        <th>Movie Code</th>
        <th>Movie Title</th>
        <th>Movie Actors</th>
        <th>Movie Genre</th>
        <th>Date of Release</th>
        <th>Action</th>
    </tr>
    <?php
    $xml = simplexml_load_file('data.xml');

    if ($xml) {
        foreach ($xml->movie as $movie) {
            echo "<tr>";
            echo "<td>" . $movie->code . "</td>";
            echo "<td>" . $movie->title . "</td>";
            echo "<td>" . $movie->actor . "</td>";
            echo "<td>" . $movie->genre . "</td>";
            echo "<td>" . $movie->dor . "</td>";
            echo "<td id = 'hid'>";
            echo "<a href='edit.php?code=" . $movie->code . "'><button id='ed'><img src ='edit.png'></button></a>";
            echo "<form action='delete.php' method='post' onsubmit='return confirm(`Are you sure you want to delete this record?`);'>";
            echo "<input type='hidden'  name='code' value='" . $movie->code . "'>";
            echo "<button type='submit' id='del'><img src ='del.png'></button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";

        }
    } else {
        echo "Error loading XML file.";
    }
?>

    <script>
        function searchMovies() {
            var searchTerm = document.getElementById('search-input').value;
            window.location.href = 'edit.php?code=' + searchTerm;
        }
    </script>
</table>
</body>
