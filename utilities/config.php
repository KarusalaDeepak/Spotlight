<?php
ob_start();
date_default_timezone_set("Asia/Kolkata");
try
{
    $con = new PDO("mysql:dbname=spotlight;host=localhost","root","");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
?>
    <script>
        alert("Connection to Database Failed!");
    </script>
<?php
}
?>