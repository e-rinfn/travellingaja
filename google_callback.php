<?php
session_start();
require 'vendor/autoload.php';

$client_id = "647816211691-e22qe1qd1ram4mftqrecmgf5hmc52lk8.apps.googleusercontent.com";

$credential = $_POST['credential'];

$client = new Google_Client(['client_id' => $client_id]);

$payload = $client->verifyIdToken($credential);

if ($payload) {
    $_SESSION['nama'] = $payload['name'];
    $_SESSION['email'] = $payload['email'];

    // 🔥 redirect
    header("Location: index.php");
    exit;
} else {
    echo "Login gagal ❌";
}