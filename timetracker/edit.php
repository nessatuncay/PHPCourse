<?php

require "connect.php";


/*this makes sure that it can get the id*/ 
if (!isset($_GET['id']))
    {
        die("There is no task id");
    }

$taskId = $_GET['id'];


