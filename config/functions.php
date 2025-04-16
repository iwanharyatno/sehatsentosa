<?php

require "constants.php";

function save_login($user_id, $poli_id = null) {
    setcookie(COOKIE_KEY_USER_ID, $user_id, time()+60*60*24*30, "/");
    if ($poli_id) {
        setcookie(COOKIE_KEY_POLI_ID, $poli_id, time()+60*60*24*30, "/");
    }
}

function logout() {
    if (isset($_COOKIE[COOKIE_KEY_USER_ID])) setcookie(COOKIE_KEY_USER_ID, "", -1, "/");
    if (isset($_COOKIE[COOKIE_KEY_POLI_ID])) setcookie(COOKIE_KEY_POLI_ID, "", -1, "/");
}