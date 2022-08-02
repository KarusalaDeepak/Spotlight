<?php
require_once("config.php");
$userMail = $_POST["userMail"];
$musicURL = $_POST["musicURL"];
$albumID = $_POST["albumID"];
$query1 = $con->prepare("SELECT * FROM users WHERE mail=:userMail");
$query1->bindParam(":userMail", $userMail);
$query1->execute();
$sqldata1 = $query1->fetch(PDO::FETCH_ASSOC);
$recent1 = $sqldata1["recent2"];
$recent2 = $sqldata1["recent3"];
$recent3 = $sqldata1["recent4"];
$recent4 = $sqldata1["recent5"];
$recent5 = $sqldata1["recent6"];
$recent6 = $sqldata1["recent7"];
$recent7 = $albumID;
$query2 = $con->prepare("UPDATE users SET recent1=:recent1, recent2=:recent2, recent3=:recent3, recent4=:recent4, recent5=:recent5, recent6=:recent6, recent7=:recent7 WHERE mail=:userMail");
$query2->bindParam(":recent1", $recent1);
$query2->bindParam(":recent2", $recent2);
$query2->bindParam(":recent3", $recent3);
$query2->bindParam(":recent4", $recent4);
$query2->bindParam(":recent5", $recent5);
$query2->bindParam(":recent6", $recent6);
$query2->bindParam(":recent7", $recent7);
$query2->bindParam(":userMail", $userMail);
$query2->execute();
$query3 = $con->prepare("SELECT * FROM trendingplays WHERE musicURL=:musicURL and userMail=:userMail");
$query3->bindParam(":musicURL", $musicURL);
$query3->bindParam(":userMail", $userMail);
$query3->execute();
if($query3->rowCount()==0)
{
    $query4 = $con->prepare("INSERT INTO trendingplays (musicURL, userMail, lastDate) VALUES(:musicURL, :userMail, CURDATE())");
    $query4->bindParam(":musicURL", $musicURL);
    $query4->bindParam(":userMail", $userMail);
    $query4->execute();
}
else
{
    $sqldata3 = $query3->fetch(PDO::FETCH_ASSOC);
    $sqlday = substr($sqldata3["lastDate"], 8);
    echo intval(date('d'))-intval($sqlday);
    echo "<br/>";
    echo intval(date('d'));
    echo "<br/>";
    echo intval($sqlday);
    if($sqldata3["trendingPlays"]<5)
    {
        $query5 = $con->prepare("UPDATE trendingPlays SET trendingPlays = trendingPlays+1, lastDate = CURDATE() WHERE musicURL=:musicURL AND userMail=:userMail");
        $query5->bindParam(":musicURL", $musicURL);
        $query5->bindParam(":userMail", $userMail);
        $query5->execute();
    }
    else if(intval(date('d'))-intval($sqlday)>=1)
    {
        echo "Date crossed";
        $query6 = $con->prepare("UPDATE trendingPlays SET trendingPlays = 1, lastDate = CURDATE() WHERE musicURL=:musicURL AND userMail=:userMail");
        $query6->bindParam(":musicURL", $musicURL);
        $query6->bindParam(":userMail", $userMail);
        $query6->execute();
    }
    else
    {
        exit;
    }
}
$query7 = $con->prepare("SELECT * FROM music WHERE musicURL=:musicURL");
$query7->bindParam(":musicURL", $musicURL);
$query7->execute();
$sqldata7 = $query7->fetch(PDO::FETCH_ASSOC);
if($sqldata7["playtime"]==0)
{
    $query8 = $con->prepare("UPDATE music SET trendingScore=trendingScore+(1/(UNIX_TIMESTAMP(CURRENT_TIMESTAMP())-1651858017)), playtime=playtime+1, lastPlayed=CURRENT_TIMESTAMP() WHERE musicURL=:musicURL");
    $query8->bindParam(":musicURL", $musicURL);
    $query8->execute();
}
else
{
    $sqlday = substr($sqldata7["lastPlayed"], 8, 2);
    if(intval(date('d'))-intval($sqlday)>=2)
    {
        $query9 = $con->prepare("UPDATE music SET trendingScore=0 WHERE musicURL=:musicURL");
        $query9->bindParam(":musicURL", $musicURL);
        $query9->execute();
    }
    $lastPlayed = $sqldata7["lastPlayed"];
    $query10 = $con->prepare("UPDATE music SET trendingScore=trendingScore+(1/(UNIX_TIMESTAMP(CURRENT_TIMESTAMP())-UNIX_TIMESTAMP('$lastPlayed'))), playtime=playtime+1, lastPlayed=CURRENT_TIMESTAMP() WHERE musicURL=:musicURL");
    $query10->bindParam(":musicURL", $musicURL);
    $query10->execute();
}
?>