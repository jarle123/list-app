<!DOCTYPE html>
<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'dbmethods.php';
require_once 'html-factory.php';

$lists = getLists();
$id = $lists[0]['list_id'];
$list1 = getListItems($lists[0]['list_id']);


?>


<html lang="nb">
<head>
    <title>Lister</title>
    <meta charset="UTF-8">
    <meta name="Description" content="App for all your list needs!">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="icon" href="../favicon.ico">
    <link rel="stylesheet" href="main.css">
    <script src="main.js" type="text/javascript"></script>

    <link rel="manifest" href="manifest.json">
</head>
<body>


<div id="mainContainer">


    <div id="list-container">
        <div class="list" >
            <input type="hidden" value="1" id="list-id-1">
            <ul id="list-1">
                <?php 

                    foreach($list1 as $listItem) {
                        echo getListItem($count, $listItem['list_item_id'], $listItem['name']);
                    }

                ?>

                <li id="li-new-list-item">
                    <label for="newListItem">
                        <input id="newListItem" type="text" name="newListItem" value="" placeholder="Ny" aria-label="New list item">
                    </label>
                </li>
            </ul>
        </div>
    </div>

    <button id="btn-add-list">Add list</button>
    <button id="btn-a2hs" style="display:none;">Add to home screen</button>
</div>

</body>
</html>


<script>
    if('serviceWorker' in navigator) {
        console.log("Will the service worker register?");

        navigator.serviceWorker.register('service-worker.js')
            .then(function (reg) {
                console.log("Yes it did");
            }).catch(function(err) {
                console.log("No it didtn, this happened: ", err);

        });
    }

    let deferredPrompt;

    // Listen for beforeinstallprompt
    window.addEventListener("beforeinstallprompt", (e) => {
        // Prevent Chrome 67 and earlier from automatically showing the promt;
        console.log("Intallprompt");
        document.getElementById('btn-a2hs').style.display = "block";
        // Stash the event so it can be triggered;
     //   deferredPrompt = e;
    });

    // Button to add to home screen
    let btnAdd = document.getElementById('btn-a2hs');
    btnAdd.addEventListener("click", (e) => {

        console.log("clickety");
    });


</script>












