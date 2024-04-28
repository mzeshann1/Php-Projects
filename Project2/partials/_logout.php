<?php
session_start();
session_unset();
session_destroy();
header("location:/zeeshan_projects/Project2/index.php?logout=true");
exit();
?>





    
