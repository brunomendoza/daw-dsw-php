<?php

$id = "acme";
session_start();

if (isset($_SESSION[$id])) {
    setcookie($id, $_SESSION[$id], time() * 30 * 24 * 60 * 60);
}