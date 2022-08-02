<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<?php
require_once("config.php");
$userMail = $_POST["mail"];
$password = $_POST["pwd"];
$query = $con->prepare("SELECT * FROM users WHERE mail=:userMail");
$query->bindParam(":userMail", $userMail);
$query->execute();
if($query->rowCount()==0)
{
    $query1 = $con->prepare("INSERT INTO users (mail, pwd) VALUES (:userMail, :pwd)");
    $query1->bindParam(":userMail", $userMail);
    $query1->bindParam(":pwd", $password);
    $query1->execute();
    echo "
    <script>
        $('.alert-danger', window.parent.document).hide();
        $('.alert-success', window.parent.document).text('Registering the user and Signing in!');
        $('.alert-success', window.parent.document).show();
        sessionStorage.setItem('userMail','$userMail');
        window.parent.location = '../home.php';
    </script>
    ";
}
else
{
    $sqldata = $query->fetch(PDO::FETCH_ASSOC);
    if($sqldata["pwd"]!=$password)
    {
        echo "
        <script>
            $('.alert-success', window.parent.document).hide();
            $('.alert-danger', window.parent.document).show();
        </script>";
    }
    else
    {
        echo "
        <script>
            $('.alert-danger', window.parent.document).hide();
            $('.alert-success', window.parent.document).text('Signing in!');
            $('.alert-success', window.parent.document).show();
            sessionStorage.setItem('userMail','$userMail');
            window.parent.location = '../home.php';
        </script>";
    }
}
?>