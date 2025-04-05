<?php
session_start();

session_destroy();

header("Location: http://localhost/TCC_PAPINHO/");
exit;
