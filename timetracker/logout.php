<?php

require "auth.php";


/*this clears the info in the session so a new blank one can start */
$_SESSION = [];

/*unsets all the info */
session_unset();

/*destroys the unique session and completely removes from server so it cant be used by malicious people */
session_destroy();

exit;