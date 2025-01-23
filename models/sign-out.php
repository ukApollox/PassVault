<?php

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION)) {
    session_destroy();
    header("location: sign-in");
}
else {
    header("location: home");
}