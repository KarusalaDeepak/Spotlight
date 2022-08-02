<?php
require_once("config.php");
$userMail = $_POST["userMail"];
$query = $con->prepare("SELECT * FROM users WHERE mail=:userMail");
$query->bindParam(":userMail", $userMail);
$query->execute();
$sqldata = $query->fetch(PDO::FETCH_ASSOC);
$recent1 = $sqldata["recent1"];
if($recent1==0)
{
    $coverPicURL1 = 'assets/notSeen.jpg';
}
else
{
    $query1 = $con->prepare("SELECT * FROM albums WHERE id=:albumID");
    $query1->bindParam(":albumID", $recent1);
    $query1->execute();
    $sqldata1 = $query1->fetch(PDO::FETCH_ASSOC);
    $coverPicURL1 = $sqldata1["cover"];
}
$recent2 = $sqldata["recent2"];
if($recent2==0)
{
    $coverPicURL2 = 'assets/notSeen.jpg';
}
else
{
    $query2 = $con->prepare("SELECT * FROM albums WHERE id=:albumID");
    $query2->bindParam(":albumID", $recent2);
    $query2->execute();
    $sqldata2 = $query2->fetch(PDO::FETCH_ASSOC);
    $coverPicURL2 = $sqldata2["cover"];
}
$recent3 = $sqldata["recent3"];
if($recent3==0)
{
    $coverPicURL3 = 'assets/notSeen.jpg';
}
else
{
    $query3 = $con->prepare("SELECT * FROM albums WHERE id=:albumID");
    $query3->bindParam(":albumID", $recent3);
    $query3->execute();
    $sqldata3 = $query3->fetch(PDO::FETCH_ASSOC);
    $coverPicURL3 = $sqldata3["cover"];
}
$recent4 = $sqldata["recent4"];
if($recent4==0)
{
    $coverPicURL4 = 'assets/notSeen.jpg';
}
else
{
    $query4 = $con->prepare("SELECT * FROM albums WHERE id=:albumID");
    $query4->bindParam(":albumID", $recent4);
    $query4->execute();
    $sqldata4 = $query4->fetch(PDO::FETCH_ASSOC);
    $coverPicURL4 = $sqldata4["cover"];
}
$recent5 = $sqldata["recent5"];
if($recent5==0)
{
    $coverPicURL5 = 'assets/notSeen.jpg';
}
else
{
    $query5 = $con->prepare("SELECT * FROM albums WHERE id=:albumID");
    $query5->bindParam(":albumID", $recent5);
    $query5->execute();
    $sqldata5 = $query5->fetch(PDO::FETCH_ASSOC);
    $coverPicURL5 = $sqldata5["cover"];
}
$recent6 = $sqldata["recent6"];
if($recent6==0)
{
    $coverPicURL6 = 'assets/notSeen.jpg';
}
else
{
    $query6 = $con->prepare("SELECT * FROM albums WHERE id=:albumID");
    $query6->bindParam(":albumID", $recent6);
    $query6->execute();
    $sqldata6 = $query6->fetch(PDO::FETCH_ASSOC);
    $coverPicURL6 = $sqldata6["cover"];
}
$recent7 = $sqldata["recent7"];
if($recent7==0)
{
    $coverPicURL7 = 'assets/notSeen.jpg';
}
else
{
    $query7 = $con->prepare("SELECT * FROM albums WHERE id=:albumID");
    $query7->bindParam(":albumID", $recent7);
    $query7->execute();
    $sqldata7 = $query7->fetch(PDO::FETCH_ASSOC);
    $coverPicURL7 = $sqldata7["cover"];
}
$recentlyPlayed = "<section data-cover='$coverPicURL1' onclick='openAlbum(\"album$recent1\")'></section>
                    <section data-cover='$coverPicURL2' onclick='openAlbum(\"album$recent2\")'></section>
                    <section data-cover='$coverPicURL3' onclick='openAlbum(\"album$recent3\")'></section>
                    <section data-cover='$coverPicURL4' onclick='openAlbum(\"album$recent4\")'></section>
                    <section data-cover='$coverPicURL5' onclick='openAlbum(\"album$recent5\")'></section>
                    <section data-cover='$coverPicURL6' onclick='openAlbum(\"album$recent6\")'></section>
                    <section data-cover='$coverPicURL7' onclick='openAlbum(\"album$recent7\")'></section>";
echo $recentlyPlayed;
?>