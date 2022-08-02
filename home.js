$(".search-bar input").focus(function()
{
    $(".header").addClass("wide");
});
$(".search-bar input").blur(function()
{
    $(".header").removeClass("wide");
});
document.getElementById("searchForm").addEventListener("submit", function(e){
    e.preventDefault();
    $.ajax({
        type:"POST",
        url:"utilities/search.php",
        data: {keyword: $("#searchForm input").val()},
        dataType:"html",
        success: function(data)
        {
            $("#homePage").css("display", "none");
            $("#recordingsPage").css("display", "none");
            $("#arrangerPage").css("display", "none");
            $("#developerPage").css("display", "none");
            $("#searchPage").css("display", "flex");
            $("#searchPage .content-wrapper").html(data);
            var activeAlbum = $(".activeAlbumResult").attr("id");
            $("."+activeAlbum).css("display", "block");
            $(".app-card").click(function(){
                $("#musiclist").find("li").css("display", "none");
                $(".app-card").removeClass("activeAlbumResult");
                $(this).addClass("activeAlbumResult");
                activeAlbum = $(".activeAlbumResult").attr("id");
                $("."+activeAlbum).css("display", "block");
            });
            $(".music").css("width", $("#searchPage").css("width"));
        }
    });
});
function signOut()
{
    sessionStorage.clear();
    window.location = "index.php";
}
$("#homePageButton").click(function()
{
    if(document.getElementById("music"))
    {
        music.src="";
    }
    $("#searchForm input").val("");
    $("#searchPage .content-wrapper").html("");
    $("#searchPage").css("display", "none");
    $("#recordingsPage").css("display", "none");
    $("#arrangerPage").css("display", "none");
    $("#developerPage").css("display", "none");
    $("#homePage").css("display", "flex");
    $(".side-menu-link").removeClass("is-active");
    $(this).addClass("is-active");
    $.ajax({
        type:"POST",
        url:"utilities/getRecentlyPlayed.php",
        data: {userMail:sessionStorage.getItem('userMail')},
        dataType:"html",
        success: function(data)
        {
            $("#coverflow").html(data);
            init();
        }
    });
});
$("#recordingsPageButton").click(function()
{
    if(document.getElementById("music"))
    {
        music.src="";
    }
    $("#searchForm input").val("");
    $("#searchPage .content-wrapper").html("");
    $("#searchPage").css("display", "none");
    $("#homePage").css("display", "none");
    $("#arrangerPage").css("display", "none");
    $("#developerPage").css("display", "none");
    $("#recordingsPage").css("display", "flex");
    $(".side-menu-link").removeClass("is-active");
    $(this).addClass("is-active");
});
$("#arrangerPageButton").click(function()
{
    if(document.getElementById("music"))
    {
        music.src="";
    }
    $("#searchForm input").val("");
    $("#searchPage .content-wrapper").html("");
    $("#searchPage").css("display", "none");
    $("#homePage").css("display", "none");
    $("#recordingsPage").css("display", "none");
    $("#developerPage").css("display", "none");
    $("#arrangerPage").css("display", "flex");
    $(".side-menu-link").removeClass("is-active");
    $(this).addClass("is-active");
});
$("#developerPageButton").click(function()
{
    if(document.getElementById("music"))
    {
        music.src="";
    }
    $("#searchForm input").val("");
    $("#searchPage .content-wrapper").html("");
    $("#searchPage").css("display", "none");
    $("#homePage").css("display", "none");
    $("#recordingsPage").css("display", "none");
    $("#arrangerPage").css("display", "none");
    $("#developerPage").css("display", "flex");
    $(".side-menu-link").removeClass("is-active");
    $(this).addClass("is-active");
});
function componentToHex(c)
{
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}
var Color = function Color(hexVal)
{
    this.hex = hexVal;
};
constructColor = function(colorObj)
{
    var hex = colorObj.hex.substring(1);
    var r = parseInt(hex.substring(0, 2), 16) / 255;
    var g = parseInt(hex.substring(2, 4), 16) / 255;
    var b = parseInt(hex.substring(4, 6), 16) / 255;
    var max = Math.max.apply(Math, [r, g, b]);
    var min = Math.min.apply(Math, [r, g, b]);
    var chr = max - min;
    var hue = 0;
    var val = max;
    var sat = 0;
    if(val > 0)
    {
        sat = chr / val;
        if (sat > 0)
        {
            if (r == max)
            {
                hue = 60 * (((g - min) - (b - min)) / chr);
                if (hue < 0)
                {
                    hue += 360;
                }
            }
            else if (g == max)
            {
                hue = 120 + 60 * (((b - min) - (r - min)) / chr);
            }
            else if (b == max)
            {
                hue = 240 + 60 * (((r - min) - (g - min)) / chr);
            }
        }
    }
    colorObj.chroma = chr;
    colorObj.hue = hue;
    colorObj.sat = sat;
    colorObj.val = val;
    colorObj.luma = 0.3 * r + 0.59 * g + 0.11 * b;
    colorObj.red = parseInt(hex.substring(0, 2), 16);
    colorObj.green = parseInt(hex.substring(2, 4), 16);
    colorObj.blue = parseInt(hex.substring(4, 6), 16);
    return colorObj;
};
sortColorsByLuma = function (colors)
{
    return colors.sort(function (a, b){
        return a.luma - b.luma;
    });
};
mapHex = function(color)
{
    return color.hex;
}
outputColors = function(hexArray)
{
    var colors = [];
    $.each(hexArray, function (i, v)
    {
        var color = new Color(v);
        constructColor(color);
        colors.push(color);
    });
    sortColorsByLuma(colors);
    return colors.map(mapHex);
};
const colorThief = new ColorThief();
const banner = document.getElementsByClassName('content-wrapper-img')[0];
colorPalette = colorThief.getPalette(banner);
colorPaletteArray = [];
colorPalette.forEach(element => {
    colorPaletteArray.push("#"+componentToHex(element[0])+componentToHex(element[1])+componentToHex(element[2]));
});
colorPaletteArray = outputColors(colorPaletteArray);
var gradientStyle="linear-gradient(to right top,";
colorPaletteArray.forEach(element => {
    gradientStyle = gradientStyle+element;
    gradientStyle = gradientStyle + ","
});
gradientStyle = gradientStyle.slice(0, gradientStyle.length - 1);
gradientStyle = gradientStyle + ")";
var header = $(".content-wrapper-header");
header.css("background-image", gradientStyle);
function singSong(songID)
{
    $("#searchForm input").val("");
    $.ajax({
        type:"POST",
        url:"utilities/singSong.php",
        data: {songID: songID},
        dataType:"html",
        success: function(data)
        {
            $("#homePage").css("display", "none");
            $("#recordingsPage").css("display", "none");
            $("#arrangerPage").css("display", "none");
            $("#developerPage").css("display", "none");
            $("#searchPage").css("display", "flex");
            $("#searchPage .content-wrapper").html(data);
            var activeAlbum = $(".activeAlbumResult").attr("id");
            $("."+activeAlbum).css("display", "block");
            $(".app-card").click(function(){
                $("#musiclist").find("li").css("display", "none");
                $(".app-card").removeClass("activeAlbumResult");
                $(this).addClass("activeAlbumResult");
                activeAlbum = $(".activeAlbumResult").attr("id");
                $("."+activeAlbum).css("display", "block");
            });
            $(".music").css("width", $("#searchPage").css("width"));
        }
    });
}
function openAlbum(albumID)
{
    if(albumID!='album0')
    {
        $("#searchForm input").val("");
        $.ajax({
            type:"POST",
            url:"utilities/openAlbum.php",
            data: {albumID: albumID},
            dataType:"html",
            success: function(data)
            {
                $("#homePage").css("display", "none");
                $("#recordingsPage").css("display", "none");
                $("#arrangerPage").css("display", "none");
                $("#developerPage").css("display", "none");
                $("#searchPage").css("display", "flex");
                $("#searchPage .content-wrapper").html(data);
                var activeAlbum = $(".activeAlbumResult").attr("id");
                $("."+activeAlbum).css("display", "block");
                $(".app-card").click(function(){
                    $("#musiclist").find("li").css("display", "none");
                    $(".app-card").removeClass("activeAlbumResult");
                    $(this).addClass("activeAlbumResult");
                    activeAlbum = $(".activeAlbumResult").attr("id");
                    $("."+activeAlbum).css("display", "block");
                });
                $(".music").css("width", $("#searchPage").css("width"));
            }
        });
    }
}
$.ajax({
    type:"POST",
    url:"utilities/getRecentlyPlayed.php",
    data: {userMail:sessionStorage.getItem('userMail')},
    dataType:"html",
    success: function(data)
    {
        $("#coverflow").html(data);
        init();
    }
});
/*
const dropdowns = document.querySelectorAll(".dropdown");
dropdowns.forEach((dropdown) => {
    dropdown.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdowns.forEach((c) => c.classList.remove("is-active"));
        dropdown.classList.add("is-active");
    });
});
$(document).click(function(e)
{
    var container = $(".status-button");
    var dd = $(".dropdown");
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
        dd.removeClass("is-active");
    }
});
$(".dropdown").on("click", function(e)
{
    $(".content-wrapper").addClass("overlay");
    e.stopPropagation();
});
$(document).on("click", function(e)
{
    if ($(e.target).is(".dropdown") === false)
    {
        $(".content-wrapper").removeClass("overlay");
    }
});
$(".status-button:not(.open)").on("click", function(e)
{
    $(".overlay-app").addClass("is-active");
});
$(".pop-up .close").click(function ()
{
    $(".overlay-app").removeClass("is-active");
});
$(".status-button:not(.open)").click(function()
{
    $(".pop-up").addClass("visible");
});
$(".pop-up .close").click(function()
{
    $(".pop-up").removeClass("visible");
});*/
var _index = 0;
var _coverflow = null;
var _prevLink = null;
var _nextLink = null;
var _albums = [];
var _transformName = Modernizr.prefixed('transform');
const OFFSET = 70;
const ROTATION = 45;
const BASE_ZINDEX = 10;
const MAX_ZINDEX = 42;
function get(selector)
{
    return document.querySelector( selector );
};
function render()
{
    for( var i = 0; i < _albums.length; i++ )
    {
        if( i < _index )
        {
            _albums[i].style[_transformName] = "translateX( -"+ ( OFFSET * ( _index - i  ) ) +"% ) rotateY( "+ ROTATION +"deg )";
            _albums[i].style.zIndex = BASE_ZINDEX + i;  
        } 
        if( i === _index )
        {
            _albums[i].style[_transformName] = "rotateY( 0deg ) translateZ( 140px )";
            _albums[i].style.zIndex = MAX_ZINDEX;
        }
        if( i > _index )
        {
            _albums[i].style[_transformName] = "translateX( "+ ( OFFSET * ( i - _index  ) ) +"% ) rotateY( -"+ ROTATION +"deg )";
            _albums[i].style.zIndex = BASE_ZINDEX + ( _albums.length - i  ); 
        }
    }
}
function flowRight()
{
    if( _index )
    {
        _index--;
        render();
    }  
}
function flowLeft()
{
    if( _albums.length >( _index + 1))
    {
        _index++;
        render();
    }
}
function keyDown(event)
{
    switch( event.keyCode )
    {
        case 37: flowRight(); break;
        case 39: flowLeft(); break;
    }
}
function registerEvents()
{
    _prevLink.addEventListener('click', flowRight, false);
    _nextLink.addEventListener('click', flowLeft, false);
    document.addEventListener('keydown', keyDown, false);
};
function init()
{
    _albums = Array.prototype.slice.call( document.querySelectorAll( 'section' ));
    _index = Math.floor( _albums.length / 2 );
    _coverflow = get('#coverflow');
    _prevLink = get('#prev');
    _nextLink = get('#next');
    for( var i = 0; i < _albums.length; i++ )
    {
        var url = _albums[i].getAttribute("data-cover");
        _albums[i].style.backgroundImage = "url("+ url  +")";
    }
    registerEvents();
    render();
}
$(window).resize(function()
{
    if(document.getElementById("music"))
    {
        $(".music").css("width", $("#searchPage").css("width"));
    }
});