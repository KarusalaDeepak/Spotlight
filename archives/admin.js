function signOut()
{
    sessionStorage.clear();
    window.location="http://localhost/Workspace6/index.php";
}
$("#albumPageButton").click(function()
{
    $("#bannerPage").css("display", "none");
    $("#albumPage").css("display", "block");
    $(".side-menu-link").removeClass("is-active");
    $(this).addClass("is-active");
});
$("#bannerPageButton").click(function()
{
    $("#albumPage").css("display", "none");
    $("#bannerPage").css("display", "block");
    $(".side-menu-link").removeClass("is-active");
    $(this).addClass("is-active");
});
var albumBucketName = "BUCKET_NAME";
var bucketRegion = "REGION";
var IdentityPoolId = "IDENTITY_POOL_ID";
AWS.config.update({
    region: bucketRegion,
    credentials: new AWS.CognitoIdentityCredentials({
        IdentityPoolId: IdentityPoolId
    });
});
var s3 = new AWS.S3({
  apiVersion: "2006-03-01",
  params: { Bucket: albumBucketName }
});
var uploadAlbumButton = document.getElementById("uploadAlbum");
uploadAlbumButton.addEventListener("submit", function(e){
    e.preventDefault();
    coverFileSelectHandler();
    audiosFileSelectHandler();
});
function coverFileSelectHandler()
{
    var coverFileSelect = document.getElementById('cover-upload');
    console.log(coverFileSelect.files[0]);
    var file = coverFileSelect.files[0];
    document.getElementById('coverStart').classList.add("hidden");
    document.getElementById('coverResponse').classList.remove("hidden");
    document.getElementById('file-image').classList.remove("hidden");
    document.getElementById('file-image').src = URL.createObjectURL(f);
    uploadFile(file);
}
function setProgressMaxValue(e)
{
    var pBar = document.getElementById('cover-file-progress');
    if (e.lengthComputable)
    {
        pBar.max = e.total;
    }
}
function updateFileProgress(e)
{
    var pBar = document.getElementById('cover-file-progress');
    if (e.lengthComputable)
    {
        pBar.value = e.loaded;
    }
}
function uploadFile(file)
{
    var xhr = new XMLHttpRequest();
    var pBar = document.getElementById('cover-file-progress');
    var fileSizeLimit = 1024;
    if(xhr.upload)
    {
        if(file.size <= fileSizeLimit * 1024 * 1024)
        {
            pBar.style.display = 'inline';
            xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
            xhr.upload.addEventListener('progress', updateFileProgress, false);
            xhr.open('POST', document.getElementById('file-upload-form').action, true);
            xhr.setRequestHeader('X-File-Name', file.name);
            xhr.setRequestHeader('X-File-Size', file.size);
            xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            xhr.send(file);
        }
        else
        {
            var m = document.getElementById('coverMessages');
            m.innerHTML = 'Please upload a smaller file (< ' + fileSizeLimit + ' MB).';
        }
    }
    xhr.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var response = this.responseText;
            alert(response + " File uploaded.");
        }
    };
}

function audiosFileSelectHandler()
{
    var audiosFileSelect = document.getElementById('audios-upload');
    var files = audiosFileSelect.files;
    for (var i=0,f;f=files[i];i++)
    {
        document.getElementById('audiosStart').classList.add("hidden");
        document.getElementById('audiosResponse').classList.remove("hidden");
        uploadAudiosFile(f);
    }
}
function setAudiosProgressMaxValue(e)
{
    var pBar = document.getElementById('audios-file-progress');
    if (e.lengthComputable)
    {
        pBar.max = e.total;
    }
}
function updateAudiosFileProgress(e)
{
    var pBar = document.getElementById('audios-file-progress');
    if (e.lengthComputable)
    {
        pBar.value = e.loaded;
    }
}
function uploadAudiosFile(file)
{
    var xhr = new XMLHttpRequest();
    var pBar = document.getElementById('audios-file-progress');
    var fileSizeLimit = 1024; // In MB
    if(xhr.upload)
    {
        if(file.size <= fileSizeLimit * 1024 * 1024)
        {
            pBar.style.display = 'inline';
            xhr.upload.addEventListener('loadstart', setAudiosProgressMaxValue, false);
            xhr.upload.addEventListener('progress', updateAudiosFileProgress, false);
            xhr.open('POST', document.getElementById('file-upload-form').action, true);
            xhr.setRequestHeader('X-File-Name', file.name);
            xhr.setRequestHeader('X-File-Size', file.size);
            xhr.setRequestHeader('Content-Type', 'multipart/form-data');
            xhr.send(file);
        }
        else
        {
            var m = document.getElementById('audiosMessages');
            m.innerHTML = 'Please upload a smaller file (< ' + fileSizeLimit + ' MB).';
        }
    }
    xhr.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var response = this.responseText;
            alert(response + " File uploaded.");
        }
    };
}
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
});