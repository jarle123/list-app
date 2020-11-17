<?php

// DB connection info
$host = 'localhost';
$pw = '¤%90Dffodla&%#gDSDrna';
$dbName = 'list';
$username = 'list';

$con = new mysqli($host, $username, $pw, $dbName);

if ($con->connect_errno) {
    echo "Failed to connect:  {$con->connect_error}";
    return;
}

function deleteList($listId, $owner)
{
    global $con;

    $sql =  'DELETE FROM li_lists WHERE list_id = ? AND owner = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ii', $listId, $owner);

    return $stmt->execute();
}

function insertListItem($name, $listId)
{
    global $con;

    $sql = 'INSERT INTO li_list_item (name, active, list_id)
            VALUES (?, 1, ?)';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('si', $name, $listId);
    $success = $stmt->execute();

    if ($success) {
        return $con->insert_id;
    }

    return 0;
}

function getList($id)
{
    global $con;

    $sql = 'SELECT list_id, name FROM li_lists WHERE list_id = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();

    return $res->fetch_assoc();
}

function getLists()
{
    global $con;

    $sql = 'SELECT list_id, name FROM li_lists ';
    $res = $con->query($sql);

    return $res->fetch_all(MYSQLI_ASSOC);
}

function getListItems($listId)
{
    global $con;

    $sql = 'SELECT list_item_id, name, list_id FROM li_list_item 
            WHERE list_id = ? AND
                  active = 1';

    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $listId);
    $stmt->execute();
    $res = $stmt->get_result();

    return $res->fetch_all(MYSQLI_ASSOC);
}

function insertLog($info)
{
    global $con;

    $sql = 'INSERT INTO li_log (info)
            VALUES(?)';

    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $info);
    return $stmt->execute();
}

function updateColumnValue($table,  $columnName, $newVal, $keyColumn, $key)
{
    global $con;

    if ($table !== 'li_list_item') {
        return 0;
    }

    // Should whitelist $table and $columnName
    $sql = "UPDATE $table SET $columnName = ? WHERE $keyColumn = ?";

    if (!$stmt = $con->prepare($sql)) {
        echo 'failed to prepare';
        return 0;
    }

    $stmt->bind_param('ii', $newVal,  $key);
    $stmt->execute();
    $res = $stmt->get_result();

    return $res;
}
