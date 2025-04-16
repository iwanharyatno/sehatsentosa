<?php

require "../config/constants.php";

if (!isset($_COOKIE[COOKIE_KEY_USER_ID])) {
    header('Location: login.php');
    return;
}

if ($_GET['id'] && $_GET['status']) {
    require "../config/db.php";

    $sql = "UPDATE booking SET `status` = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("si", $_GET['status'], $_GET['id']);
    $stmt->execute();
}

header('Location: ' . $_GET['return']);