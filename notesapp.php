<!DOCTYPE html>
<html lang="en">

<head>
  

    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notecloud</title>
    <link rel="stylesheet" href="notesapp.css">
</head>

<body>
    <nav>
        <img src="logo.png" alt="notecloud.com"><span id="log">NoteCloud</span>
        <li id="home"><a href="notesapp.php" id="home1">Home</a></li>
        <div class="box">
            <div class="search">
            <li id="search"><a href="input form.php" id="out">Log out</a></li>

            </div>
        </div>
    </nav>
    <h1 class="heading">Welcome to Notecloud</h1>
    <hr width="75%">
    <h2 class="heading">Add Notes:</h2>
    <div class="container1">
        <textarea name="headtextarea" id="addtexthead" placeholder="Add a title here..."></textarea>
        <textarea name="txtarea" id="txtarea" placeholder="Add your note here..."></textarea>
        <button id="addbtn">Add</button>
    </div>
    <h2 class="heading">Your Notes:</h2>
    <div id="sresult"></div>
    <hr id="belowsearch">
    <div class="container2"> </div>
    </div>
    <button id="deleteall">Delete all</button>
</body>
<script src="notes app project.js"></script>

</html>