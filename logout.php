<?php
//uložená data v sessionu se zapomenou a uživatele to přesměruje na index
session_start();
session_destroy();
header("location: index.php");
