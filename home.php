<?php
require_once("utilities/config.php");
$query1 = $con->prepare("SELECT * FROM music ORDER BY trendingScore DESC LIMIT 3");
$query1->execute();
$sqldata1 = $query1->fetchAll(PDO::FETCH_ASSOC);
$trendingList = "";
foreach($sqldata1 as $row1)
{
    $query2 = $con->prepare("SELECT * FROM albums WHERE id=:albumID");
    $query2->bindParam(":albumID", $row1["album"]);
    $query2->execute();
    $sqldata2 = $query2->fetch(PDO::FETCH_ASSOC);
    $coverPicURL = $sqldata2["cover"];
    $musicName = $row1["name"];
    $singNow = "sing".$row1["id"];
    $trendingList .= "
    <li class='adobe-product'>
        <div class='products'>
            <img src = '$coverPicURL' style='width:52px;height:52px;border:1px solid #3291b8;margin-right:10px;'/>
            $musicName
        </div>
        <span class='status'>
            <span class='status-circle'></span>
            Not recorded
        </span>
        <div class='button-wrapper'>
            <button class='content-button status-button' id='$singNow' onclick='singSong(this.id);'>Sing now</button>
        </div>
    </li>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Spotlight</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"><!--Here-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel='stylesheet' type='text/css' href='home.css'>
    <link rel='icon' type='image/icon type' href='assets/tabIcon.png'>
</head>
<body>
    <div class="app">
        <script>
            if(sessionStorage.getItem('userMail')===null)
            {
                document.getElementsByClassName('app')[0].innerHTML="<div style='font-size:30px;color:#fff;font-weight:900;'>Please Login...</div>";
                window.stop();
            }
        </script>
        <div class="header">
            <div class="logo">
                <img src='assets/tabIcon.png'/>
                <div class='logo-text'>
                    <b>S<span>po</span>t<span>l</span>ight</b>
                </div>
            </div>
            <div class="search-bar">
                <form action="utilities/search.php" method="POST" style='width:100%;' id='searchForm'>
                    <input type="text" placeholder="Search Albums" spellcheck="false">
                </form>
            </div>
            <div class="header-profile">
                <img style='display:none;' class="profile-img" src="assets/KrishnaPaanchajanya.jpg" alt="DP" title='Krishna Paanchajanya'>
                <div class="logout" onclick='signOut()'>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 471.2 471.2" style="enable-background:new 0 0 471.2 471.2;" xml:space="preserve">
                        <g>
                            <path d="M227.619,444.2h-122.9c-33.4,0-60.5-27.2-60.5-60.5V87.5c0-33.4,27.2-60.5,60.5-60.5h124.9c7.5,0,13.5-6,13.5-13.5    s-6-13.5-13.5-13.5h-124.9c-48.3,0-87.5,39.3-87.5,87.5v296.2c0,48.3,39.3,87.5,87.5,87.5h122.9c7.5,0,13.5-6,13.5-13.5    S235.019,444.2,227.619,444.2z"/>
                            <path d="M450.019,226.1l-85.8-85.8c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1l62.8,62.8h-273.9c-7.5,0-13.5,6-13.5,13.5    s6,13.5,13.5,13.5h273.9l-62.8,62.8c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4l85.8-85.8    C455.319,239.9,455.319,231.3,450.019,226.1z"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="left-side">
                <div class="side-wrapper">
                    <div class="side-title">Menu</div>
                    <div class="side-menu">
                        <a href="#" class='side-menu-link is-active' id='homePageButton'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 172 172" style=" fill:#000000;">
                                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                    <path d="M0,172v-172h172v172z" fill="none"></path>
                                    <g fill="#ffffff">
                                        <path d="M86,14.33333c-1.91435,0.00025 -3.74903,0.76638 -5.09506,2.1276l-72.28255,63.07226c-0.9155,0.67554 -1.45577,1.74571 -1.45573,2.88347c0,1.97902 1.60431,3.58333 3.58333,3.58333h17.91667v57.33333c0,3.956 3.21067,7.16667 7.16667,7.16667h28.66667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-43h28.66667v43c0,3.956 3.21067,7.16667 7.16667,7.16667h28.66667c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-57.33333h17.91667c1.97902,0 3.58333,-1.60431 3.58333,-3.58333c0.00004,-1.13776 -0.54023,-2.20792 -1.45573,-2.88347l-72.24056,-63.03027c-0.01394,-0.01406 -0.02794,-0.02805 -0.04199,-0.04199c-1.34603,-1.36123 -3.18071,-2.12736 -5.09506,-2.1276z"></path>
                                    </g>
                                </g>
                            </svg>
                            Home
                        </a>
                        <a href="#" class='side-menu-link' id='recordingsPageButton'>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 369.958 369.958" style="enable-background:new 0 0 369.958 369.958;" xml:space="preserve">
                                <g fill='#ffffff'>
                                    <path d="M305.258,25.467C288.283,8.482,266.018,0,243.754,0c-17.52,0-35.027,5.276-49.969,15.79l-6.599-6.599l-21.213,21.213    l6.6,6.6c-13.008,18.488-17.991,40.908-14.903,62.406L56.562,228.673l13.298,13.298l-15.1,15.1    c-10.005,10.005-15.516,23.348-15.516,37.57c0,14.222,5.51,27.564,15.516,37.569c20.716,20.717,54.424,20.717,75.14,0l80.06-80.06    c9.021-9.019,23.695-9.018,32.713,0c9.019,9.019,9.019,23.694,0,32.713l-63.882,63.882l21.213,21.213l63.882-63.882    c20.716-20.716,20.716-54.423,0-75.139c-20.716-20.717-54.424-20.718-75.139,0l-80.06,80.06c-9.02,9.019-23.694,9.019-32.714,0    c-4.339-4.339-6.729-10.148-6.729-16.356c0-6.209,2.39-12.018,6.729-16.357l15.1-15.1l12.158,12.158l130.416-102.008    c3.357,0.39,6.731,0.61,10.107,0.61c17.522,0,35.008-5.283,49.961-15.798l6.608,6.608l21.213-21.213l-6.601-6.601    C338.808,103.008,335.598,55.833,305.258,25.467z M122.311,237.877c-7.81,7.81-20.474,7.81-28.284,0    c-7.81-7.811-7.81-20.474,0-28.284s20.474-7.811,28.284,0C130.121,217.404,130.122,230.066,122.311,237.877z"/>
                                </g>
                            </svg>
                            My Recordings
                        </a>
                    </div>
                </div>
                <div class="side-wrapper">
                    <div class="side-title">Team</div>
                    <div class="side-menu">
                        <a href="#" class='side-menu-link' id='arrangerPageButton'>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 294 294" style="enable-background:new 0 0 294 294;" xml:space="preserve">
                                <g fill='#ffffff'>
                                    <path d="M279.333,16h-48h-33h-99h-33h-51C7.049,16,0,22.716,0,31v232c0,8.284,7.049,15,15.333,15h264  c8.284,0,14.667-6.716,14.667-15V31C294,22.716,287.618,16,279.333,16z M97,178h2.333c8.284,0,14.667-6.716,14.667-15V46h20v202H97  V178z M164,46h19v117c0,8.284,7.049,15,15.333,15H200v70h-36V46z M30,46h21v117c0,8.284,7.049,15,15.333,15H67v70H30V46z M264,248  h-34v-70h1.333c8.284,0,14.667-6.716,14.667-15V46h18V248z"/>
                                </g>
                            </svg>
                            Music Arranger
                        </a>
                        <a href="#" class='side-menu-link' id='developerPageButton'>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 419.931 419.931" style="enable-background:new 0 0 419.931 419.931;" xml:space="preserve">
                                <g fill='#ffffff'>
                                    <path d="M282.895,352.367c-2.176-1.324-4.072-3.099-5.579-5.25c-0.696-0.992-1.284-2.041-1.771-3.125H28.282V100.276h335.624     v159.138c7.165,0.647,13.177,5.353,15.701,11.797c2.235-1.225,4.726-1.982,7.344-2.213c1.771-0.154,3.53-0.044,5.236,0.293     V39.561c0-12.996-10.571-23.569-23.566-23.569H23.568C10.573,15.992,0,26.565,0,39.561v309.146     c0,12.996,10.573,23.568,23.568,23.568h257.179c-2.007-4.064-2.483-8.652-1.302-13.066     C280.126,356.67,281.304,354.354,282.895,352.367z M338.025,55.569c0-4.806,3.896-8.703,8.702-8.703h8.702     c4.807,0,8.702,3.896,8.702,8.703v9.863c0,4.806-3.896,8.702-8.702,8.702h-8.702c-4.807,0-8.702-3.896-8.702-8.702V55.569z      M297.56,55.569c0-4.806,3.896-8.703,8.702-8.703h8.703c4.807,0,8.702,3.896,8.702,8.703v9.863c0,4.806-3.896,8.702-8.702,8.702     h-8.703c-4.806,0-8.702-3.896-8.702-8.702V55.569z M257.094,55.569c0-4.806,3.897-8.703,8.702-8.703h8.702     c4.807,0,8.703,3.896,8.703,8.703v9.863c0,4.806-3.896,8.702-8.703,8.702h-8.702c-4.805,0-8.702-3.896-8.702-8.702V55.569z"/>
                                    <path d="M419.875,335.77l-2.615-14.83c-0.353-1.997-2.256-3.331-4.255-2.979l-13.188,2.324c-1.583-3.715-3.605-7.195-6.005-10.38     l8.614-10.268c0.626-0.744,0.931-1.709,0.847-2.68c-0.086-0.971-0.554-1.867-1.3-2.494l-11.534-9.68     c-0.746-0.626-1.713-0.93-2.683-0.845c-0.971,0.085-1.867,0.552-2.493,1.298l-8.606,10.26c-3.533-1.8-7.312-3.188-11.271-4.104     v-13.392c0-2.028-1.645-3.674-3.673-3.674h-15.06c-2.027,0-3.673,1.646-3.673,3.674v13.392     c-3.961,0.915-7.736,2.304-11.271,4.104l-8.608-10.259c-1.304-1.554-3.62-1.756-5.175-0.453l-11.535,9.679     c-0.746,0.627-1.213,1.523-1.299,2.494c-0.084,0.971,0.22,1.937,0.846,2.683l8.615,10.266c-2.396,3.184-4.422,6.666-6.005,10.38     l-13.188-2.325c-1.994-0.351-3.901,0.982-4.255,2.979l-2.614,14.83c-0.169,0.959,0.05,1.945,0.607,2.744     c0.561,0.799,1.41,1.342,2.37,1.511l13.198,2.326c0.215,4.089,0.927,8.045,2.073,11.812l-11.6,6.695     c-0.844,0.485-1.459,1.289-1.712,2.229c-0.252,0.941-0.119,1.943,0.367,2.787l7.529,13.041c0.485,0.844,1.289,1.459,2.229,1.711     c0.313,0.084,0.632,0.125,0.951,0.125c0.639,0,1.272-0.166,1.836-0.492l11.609-6.703c2.73,2.925,5.812,5.517,9.18,7.709     l-4.584,12.593c-0.332,0.916-0.289,1.926,0.123,2.809s1.157,1.566,2.072,1.898l14.148,5.149c0.406,0.148,0.832,0.224,1.257,0.224     c0.53,0,1.063-0.115,1.554-0.345c0.883-0.411,1.564-1.157,1.897-2.073l4.583-12.593c1.965,0.238,3.965,0.361,5.994,0.361     s4.029-0.125,5.994-0.361l4.584,12.593c0.332,0.916,1.016,1.662,1.897,2.073c0.49,0.229,1.021,0.345,1.554,0.345     c0.424,0,0.85-0.074,1.256-0.224l14.15-5.149c0.913-0.332,1.659-1.017,2.07-1.898c0.412-0.883,0.456-1.893,0.123-2.809     l-4.584-12.591c3.365-2.192,6.447-4.786,9.18-7.709l11.609,6.703c0.563,0.324,1.197,0.492,1.836,0.492     c0.318,0,0.64-0.043,0.951-0.125c0.941-0.252,1.743-0.869,2.229-1.711l7.529-13.043c0.486-0.842,0.619-1.846,0.367-2.787     c-0.253-0.938-0.868-1.742-1.712-2.229l-11.598-6.693c1.146-3.768,1.856-7.724,2.071-11.812l13.198-2.327     c0.96-0.169,1.812-0.712,2.37-1.511C419.825,337.715,420.044,336.729,419.875,335.77z M354.184,359.336     c-11.155,0-20.2-9.045-20.2-20.201s9.046-20.2,20.2-20.2c11.156,0,20.201,9.044,20.201,20.2S365.34,359.336,354.184,359.336z"/>
                                    <g>
                                        <path d="M164.695,235.373c0-4.752-2.785-9.117-7.096-11.119l-39.455-18.332l39.456-18.334c4.31-2.004,7.095-6.368,7.095-11.118      v-0.319c0-4.21-2.119-8.075-5.665-10.334c-1.962-1.253-4.247-1.916-6.606-1.916c-1.778,0-3.563,0.391-5.16,1.133l-63.078,29.333      c-4.309,2.004-7.092,6.368-7.092,11.117v0.877c0,4.743,2.782,9.104,7.093,11.118l63.084,29.336      c1.631,0.755,3.368,1.138,5.162,1.138c2.338,0,4.616-0.664,6.597-1.924c3.548-2.268,5.666-6.13,5.666-10.335L164.695,235.373      L164.695,235.373z"/>
                                        <path d="M226.932,134.012c-2.301-3.15-6.002-5.03-9.901-5.03h-0.314c-5.354,0-10.048,3.425-11.679,8.516L163.478,266.27      c-1.183,3.718-0.517,7.813,1.781,10.962c2.301,3.148,6.002,5.029,9.901,5.029h0.315c5.352,0,10.043-3.426,11.672-8.516      l41.555-128.762C229.896,141.268,229.234,137.167,226.932,134.012z"/>
                                        <path d="M308.001,194.366l-63.079-29.333c-1.592-0.74-3.374-1.131-5.152-1.131c-2.358,0-4.644,0.661-6.605,1.912      c-3.552,2.263-5.671,6.127-5.671,10.337v0.319c0,4.746,2.783,9.111,7.097,11.123l39.454,18.33l-39.455,18.331      c-4.311,2.002-7.096,6.367-7.096,11.119v0.321c0,4.205,2.119,8.066,5.669,10.336c1.974,1.258,4.254,1.923,6.595,1.923      c1.792,0,3.527-0.383,5.169-1.141l63.082-29.336c4.307-2.009,7.088-6.371,7.088-11.114v-0.877      C315.094,200.735,312.311,196.371,308.001,194.366z"/>
                                    </g>
                                </g>
                            </svg>
                            Web Developers
                        </a>
                    </div>
                </div>
            </div>
            <div class="main-container" id='homePage'>
                <div class="content-wrapper">
                    <div class="content-wrapper-header">
                        <div class="content-wrapper-context">
                            <div class="content-text">The Album Cover of the romantic period drama Radhe Shyam is here. Enjoy the instrumentals and sing along to the fullest of your hearts.</div>
                            <button class="content-button" onclick="openAlbum('album8')">Sing Karaoke</button>
                        </div>
                        <div style='width:150px;height:150px;'>
                            <img class="content-wrapper-img" src="assets/RadheShyamAlbumCover.jpg" alt="">
                        </div>
                    </div><!--Admin-->
                    <div class="content-section">
                        <div class="content-section-title">Trending</div>
                        <ul>
                            <?php echo $trendingList; ?>
                        </ul>
                    </div>
                    <div class="content-section">
                        <div class="content-section-title">Recently Played</div>
                        <div style='position: relative;overflow:hidden;height:300px;width:100%;text-align:center;'>
                            <div id="coverflow">
                            </div>
                            <nav id="controls">
                                <a id="prev"><img src="assets/moveLeft.png"/></a>  <a id="next"><img src="assets/moveRight.png"/></a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-container" id='recordingsPage' style='display:none;'>
                <div class="content-wrapper">
                    <div class="content-section">
                        <div class="content-section-title">My Recordings</div>
                        <!--<ul>
                            <li class="adobe-product">
                                <div class="products">
                                    <svg viewBox="0 0 52 52" style="border:1px solid #3291b8">
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z" fill="#061e26" data-original="#393687"/>
                                            <path d="M12.16 39H9.28V11h9.64c2.613 0 4.553.813 5.82 2.44 1.266 1.626 1.9 3.76 1.9 6.399 0 .934-.027 1.74-.08 2.42-.054.681-.22 1.534-.5 2.561-.28 1.026-.66 1.866-1.14 2.52-.48.654-1.213 1.227-2.2 1.72-.987.494-2.16.74-3.52.74h-7.04V39zm0-12h6.68c.96 0 1.773-.187 2.44-.56.666-.374 1.153-.773 1.46-1.2.306-.427.546-1.04.72-1.84.173-.801.267-1.4.28-1.801.013-.399.02-.973.02-1.72 0-4.053-1.694-6.08-5.08-6.08h-6.52V27zM29.48 33.92l2.8-.12c.106.987.6 1.754 1.48 2.3.88.547 1.893.82 3.04.82s2.14-.26 2.98-.78c.84-.52 1.26-1.266 1.26-2.239s-.36-1.747-1.08-2.32c-.72-.573-1.6-1.026-2.64-1.36-1.04-.333-2.086-.686-3.14-1.06a7.36 7.36 0 01-2.78-1.76c-.987-.934-1.48-2.073-1.48-3.42s.54-2.601 1.62-3.761 2.833-1.739 5.26-1.739c.854 0 1.653.1 2.4.3.746.2 1.28.394 1.6.58l.48.279-.92 2.521c-.854-.666-1.974-1-3.36-1-1.387 0-2.42.26-3.1.78-.68.52-1.02 1.18-1.02 1.979 0 .88.426 1.574 1.28 2.08.853.507 1.813.934 2.88 1.28 1.066.347 2.126.733 3.18 1.16 1.053.427 1.946 1.094 2.68 2s1.1 2.106 1.1 3.6c0 1.494-.6 2.794-1.8 3.9-1.2 1.106-2.954 1.66-5.26 1.66-2.307 0-4.114-.547-5.42-1.64-1.307-1.093-1.987-2.44-2.04-4.04z" fill="#c1dbe6" data-original="#89d3ff"/>
                                        </g>
                                    </svg>
                                    Photoshop
                                </div>
                                <span class="status">
                                    <span class="status-circle green"></span>
                                    Updated
                                </span>
                                <div class="button-wrapper">
                                    <button class="content-button status-button open">Open</button>
                                    <div class="menu">
                                        <button class="dropdown">
                                            <ul>
                                                <li><a href="#">Go to Discover</a></li>
                                                <li><a href="#">Learn more</a></li>
                                                <li><a href="#">Uninstall</a></li>
                                            </ul>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="adobe-product">
                                <div class="products">
                                    <svg viewBox="0 0 52 52" style="border:1px solid #b65a0b">
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z" fill="#261400" data-original="#6d4c13"/>
                                            <path d="M30.68 39h-3.24l-2.76-9.04h-8.32L13.72 39H10.6l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L17.12 27h6.84zM37.479 12.24c0 .453-.16.84-.48 1.16-.32.319-.7.479-1.14.479-.44 0-.827-.166-1.16-.5-.334-.333-.5-.713-.5-1.14s.166-.807.5-1.141c.333-.333.72-.5 1.16-.5.44 0 .82.16 1.14.48.321.322.48.709.48 1.162zM37.24 39h-2.88V18.96h2.88V39z" fill="#e6d2c0" data-original="#ffbd2e"/>
                                        </g>
                                    </svg>
                                    Illustrator
                                </div>
                                <span class="status">
                                    <span class="status-circle"></span>
                                    Update Available
                                </span>
                                <div class="button-wrapper">
                                    <button class="content-button status-button">Update this app</button>
                                    <div class="pop-up">
                                        <div class="pop-up__title">
                                            Update This App
                                            <svg class="close" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
                                                <circle cx="12" cy="12" r="10"/>
                                                <path d="M15 9l-6 6M9 9l6 6"/>
                                            </svg>
                                        </div>
                                        <div class="pop-up__subtitle">
                                            Adjust your selections for advanced options as desired before continuing.
                                            <a href="#">Learn more</a>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input type="checkbox" id="check1" class="checkbox">
                                            <label for="check1">Import previous settings and preferences</label>
                                        </div>
                                        <div class="checkbox-wrapper">
                                            <input type="checkbox" id="check2" class="checkbox">
                                            <label for="check2">Remove old versions</label>
                                        </div>
                                        <div class="content-button-wrapper">
                                            <button class="content-button status-button open close">Cancel</button>
                                            <button class="content-button status-button">Continue</button>
                                        </div>
                                    </div>
                                    <div class="menu">
                                        <button class="dropdown">
                                            <ul>
                                                <li><a href="#">Go to Discover</a></li>
                                                <li><a href="#">Learn more</a></li>
                                                <li><a href="#">Uninstall</a></li>
                                            </ul>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="adobe-product">
                                <div class="products">
                                    <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z" fill="#3a3375" data-original="#3a3375"/>
                                            <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z" fill="#e4d1eb" data-original="#e7adfb"/>
                                        </g>
                                    </svg>
                                    After Effects
                                </div>
                                <span class="status">
                                    <span class="status-circle green"></span>
                                    Updated
                                </span>
                                <div class="button-wrapper">
                                    <button class="content-button status-button open">Open</button>
                                    <div class="menu">
                                        <button class="dropdown">
                                            <ul>
                                                <li><a href="#">Go to Discover</a></li>
                                                <li><a href="#">Learn more</a></li>
                                                <li><a href="#">Uninstall</a></li>
                                            </ul>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>-->
                        <div style='font-size:30px;color:#fff;font-weight:900;'>Coming Soon...</div>
                    </div>
                </div>
            </div>
            <div class="main-container" id='arrangerPage' style='display:none;'>
                <div class="wrapper">
                    <div class="profile-card js-profile-card">
                        <div class="profile-card__img">
                            <img src="assets/RishiKumar.jpg" alt="DP">
                        </div>
                        <div class="profile-card__cnt js-profile-cnt">
                            <div class="profile-card__name">Rishi Kumar</div>
                            <div class="profile-card__txt">Rishi is a 15-year-old pianist (Trinity College London Grade 7), keyboard player, music producer, arranger, and composer based in Chennai, India. In between composing his own songs he creates piano instrumentals and karaoke instrumentals for songs across many languages and has grown from 500 subs to 16000 subscribers on Youtube in a single year. His instrumental covers on Spotify are a raving hit and he has grown from 0 - 30,000+ listeners on Spotify within 4 months of starting to post his instrumentals.</div>
                            <div class="profile-card-social">
                                <a href="https://www.youtube.com/c/RishiKumarTheMusician" class="profile-card-social__item youtube" target="_blank">
                                    <span class="icon-font">
                                        <svg xmlns="http://www.w3.org/2000/svg" class='icon' viewBox="0 0 172 172" style=" fill:#000000;">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                                <g fill="#ffffff">
                                                    <path d="M154.45063,49.88c-1.37063,-7.56531 -7.90125,-13.07469 -15.48,-14.79469c-11.34125,-2.40531 -32.33063,-4.12531 -55.04,-4.12531c-22.69594,0 -44.02125,1.72 -55.37594,4.12531c-7.56531,1.72 -14.10937,6.88 -15.48,14.79469c-1.38406,8.6 -2.75469,20.64 -2.75469,36.12c0,15.48 1.37063,27.52 3.09063,36.12c1.38406,7.56531 7.91469,13.07469 15.48,14.79469c12.04,2.40531 32.68,4.12531 55.38937,4.12531c22.70938,0 43.34938,-1.72 55.38938,-4.12531c7.56531,-1.72 14.09594,-6.88 15.48,-14.79469c1.37062,-8.6 3.09062,-20.98937 3.44,-36.12c-0.69875,-15.48 -2.41875,-27.52 -4.13875,-36.12zM65.36,110.08v-48.16l41.96531,24.08z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-container" id='developerPage' style='display:none;'>
                <div class="wrapper">
                    <div class="profile-card js-profile-card">
                        <div class="profile-card__img">
                            <img src="assets/KrishnaPaanchajanya.jpg" alt="DP">
                        </div>
                        <div class="profile-card__cnt js-profile-cnt">
                            <div class="profile-card__name">K V Krishna Paanchajanya</div>
                            <div class="profile-card__txt">Krishna Paanchajanya is a B. Tech student at Indian Institute of Information Technology, Dharwad. He is an Application Developer upgrading skill set in software programming hand-in-hand reaching the pinnacle in academics to ideate and design a tool that has socio-economic relevance</div>
                            <div class="profile-card-social">
                                <a href="https://www.linkedin.com/in/krishna-paanchajanya-5454b71a0/" class="profile-card-social__item linkedin" target="_blank">
                                    <span class="icon-font">
                                        <svg class='icon' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 172 172" style=" fill:#000000;">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                                <g fill="#ffffff">
                                                    <path d="M51.6,143.33333h-28.66667v-86h28.66667zM37.2724,45.86667c-7.9292,0 -14.33907,-6.42707 -14.33907,-14.33907c0,-7.912 6.42133,-14.3276 14.33907,-14.3276c7.90053,0 14.3276,6.42707 14.3276,14.3276c0,7.912 -6.42707,14.33907 -14.3276,14.33907zM154.8,143.33333h-27.56013v-41.85333c0,-9.98173 -0.1892,-22.81867 -14.3276,-22.81867c-14.35053,0 -16.55787,10.8704 -16.55787,22.09627v42.57573h-27.5544v-86.06307h26.4536v11.75907h0.37267c3.6808,-6.76533 12.6764,-13.8976 26.0924,-13.8976c27.92133,0 33.08133,17.82493 33.08133,40.99907z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-card js-profile-card">
                        <div class="profile-card__img">
                            <img src="assets/KarthikSajjan.jpg" alt="DP">
                        </div>
                        <div class="profile-card__cnt js-profile-cnt">
                            <div class="profile-card__name">Karthik Sajjan</div>
                            <div class="profile-card__txt">Karthik Sajjan is a B. Tech student at Indian Institute of Information Technology, Dharwad.</div>
                            <div class="profile-card-social">
                                <a href="https://www.linkedin.com/in/karthik-sajjan-3949691a6/" class="profile-card-social__item linkedin" target="_blank">
                                    <span class="icon-font">
                                        <svg class='icon' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 172 172" style=" fill:#000000;">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                                <g fill="#ffffff">
                                                    <path d="M51.6,143.33333h-28.66667v-86h28.66667zM37.2724,45.86667c-7.9292,0 -14.33907,-6.42707 -14.33907,-14.33907c0,-7.912 6.42133,-14.3276 14.33907,-14.3276c7.90053,0 14.3276,6.42707 14.3276,14.3276c0,7.912 -6.42707,14.33907 -14.3276,14.33907zM154.8,143.33333h-27.56013v-41.85333c0,-9.98173 -0.1892,-22.81867 -14.3276,-22.81867c-14.35053,0 -16.55787,10.8704 -16.55787,22.09627v42.57573h-27.5544v-86.06307h26.4536v11.75907h0.37267c3.6808,-6.76533 12.6764,-13.8976 26.0924,-13.8976c27.92133,0 33.08133,17.82493 33.08133,40.99907z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-card js-profile-card">
                        <div class="profile-card__img">
                            <img src="assets/DeepakChowdary.jpg" alt="DP">
                        </div>
                        <div class="profile-card__cnt js-profile-cnt">
                            <div class="profile-card__name">K Deepak Chowdary</div>
                            <div class="profile-card__txt">Deepak Chowdary is a B. Tech student at Indian Institute of Information Technology, Dharwad.</div>
                            <div class="profile-card-social">
                                <a href="https://www.linkedin.com/in/karusala-deepak-chowdary-3701111a5/" class="profile-card-social__item linkedin" target="_blank">
                                    <span class="icon-font">
                                        <svg class='icon' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 172 172" style=" fill:#000000;">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                                <g fill="#ffffff">
                                                    <path d="M51.6,143.33333h-28.66667v-86h28.66667zM37.2724,45.86667c-7.9292,0 -14.33907,-6.42707 -14.33907,-14.33907c0,-7.912 6.42133,-14.3276 14.33907,-14.3276c7.90053,0 14.3276,6.42707 14.3276,14.3276c0,7.912 -6.42707,14.33907 -14.3276,14.33907zM154.8,143.33333h-27.56013v-41.85333c0,-9.98173 -0.1892,-22.81867 -14.3276,-22.81867c-14.35053,0 -16.55787,10.8704 -16.55787,22.09627v42.57573h-27.5544v-86.06307h26.4536v11.75907h0.37267c3.6808,-6.76533 12.6764,-13.8976 26.0924,-13.8976c27.92133,0 33.08133,17.82493 33.08133,40.99907z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-card js-profile-card">
                        <div class="profile-card__img">
                            <img src="assets/ManojSahithReddy.jpg" alt="DP">
                        </div>
                        <div class="profile-card__cnt js-profile-cnt">
                            <div class="profile-card__name">V Manoj Sahit Reddy</div>
                            <div class="profile-card__txt">Manoj Sahit Reddy is a B. Tech student at Indian Institute of Information Technology, Dharwad.</div>
                            <div class="profile-card-social">
                                <a href="https://www.linkedin.com/in/manojsahith/" class="profile-card-social__item linkedin" target="_blank">
                                    <span class="icon-font">
                                        <svg class='icon' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 172 172" style=" fill:#000000;">
                                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                                <g fill="#ffffff">
                                                    <path d="M51.6,143.33333h-28.66667v-86h28.66667zM37.2724,45.86667c-7.9292,0 -14.33907,-6.42707 -14.33907,-14.33907c0,-7.912 6.42133,-14.3276 14.33907,-14.3276c7.90053,0 14.3276,6.42707 14.3276,14.3276c0,7.912 -6.42707,14.33907 -14.3276,14.33907zM154.8,143.33333h-27.56013v-41.85333c0,-9.98173 -0.1892,-22.81867 -14.3276,-22.81867c-14.35053,0 -16.55787,10.8704 -16.55787,22.09627v42.57573h-27.5544v-86.06307h26.4536v11.75907h0.37267c3.6808,-6.76533 12.6764,-13.8976 26.0924,-13.8976c27.92133,0 33.08133,17.82493 33.08133,40.99907z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-container" id='searchPage' style='display:none;'>
                <div class="content-wrapper">
                </div>
            </div>
        </div>
        <div class="overlay-app"></div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
    <script src="MediaStreamRecorder.js"></script>
    <script type='text/javascript' src='home.js'></script>
</body>
</html>