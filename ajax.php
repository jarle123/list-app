<?php

require_once 'dbmethods.php';


if ($_REQUEST['ajaxAction']) {

    $action = $_REQUEST['ajaxAction'];


    insertLog("in ajax, action is $action");

    if ($action === 'insertListItem') {
        $itemName = $_REQUEST['name'];
        $listId = $_REQUEST['listId'];
        echo '<br>itrying to inser '. $_REQUEST['name'];

        $listItemId = insertListItem($itemName, $listId);

        if($listItemId) {
            echo "booom";
            echo "<br> $itemName inserted <br>";
            $htmlListItem = getListItem($itemNo, $listItemId, $itemName);
            echo $htmlListItem;
        }
        else {
            echo 'failed to insert';
        }
    }
    elseif ($action === 'updateListItem') {
        $column = $_REQUEST['column'];
        $newValue = $_REQUEST['newValue'];
        $listItemId = $_REQUEST['listItemId'];

        insertLog("updateListItem id: $listItemId");


        $ok = updateColumnValue('li_list_item', $column, $newValue, 'list_item_id', $listItemId);


        echo 'updateddd222';

        return "kkkk";
    }
    elseif ($action === 'printListItem') {
        $itemNo = $_REQUEST['itemNo'];
        $listItemId = $_REQUEST['listItemId'];
        $itemName = $_REQUEST['itemName'];
        return getListItem($itemNo, $listItemId, $itemName);
    }

    return;
}