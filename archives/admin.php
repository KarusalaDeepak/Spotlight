<!DOCTYPE html>
<html lang="en">
<head>
    <title>Spotlight - Admin</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='admin.css'>
    <link rel='icon' type='image/icon type' href='assets/tabIcon.png'>
</head>
<body>
    <div class="app">
        <div class="header">
            <div class="logo">
                <img src='assets/tabIcon.png'/>
                <div class='logo-text'>
                    <b>S<span>po</span>t<span>l</span>ight</b>
                </div>
            </div>
            <div class="header-profile">
                <img class="profile-img" src="assets/KrishnaPaanchajanya.jpg" alt="DP" title='Krishna Paanchajanya'>
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
                        <a href="#" class='side-menu-link is-active' id='albumPageButton'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20" fill="#ffffff">
                                <path d="M0 0h20v20H0V0zm10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-5a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                            Albums
                        </a>
                        <a href="#" class='side-menu-link' id='bannerPageButton'>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" viewBox="0 0 297 297" style="enable-background:new 0 0 297 297;" xml:space="preserve">
                                <g>
	                                <polygon points="79.801,180.101 106.091,211.171 106.091,180.101"/>
	                                <polygon points="190.909,180.101 190.909,211.171 217.199,180.101 "/>
	                                <path d="M202.577,220.604h86.907c2.864,0,5.478-1.754,6.743-4.322c1.265-2.569,0.96-5.76-0.787-8.03l-17.721-22.996l17.539-20.981   c1.867-2.241,2.268-5.214,1.031-7.855c-1.237-2.641-3.89-4.039-6.806-4.039h-40.796v5.348c0,4.912-1.31,9.527-4.014,13.055   C234.754,183.726,202.577,220.604,202.577,220.604z"/>
	                                <path d="M52.329,170.782c-2.987-3.755-4.599-8.576-4.599-13.63v-4.77H7.516c-2.916,0-5.569,1.398-6.806,4.039   c-1.237,2.641-0.835,5.614,1.031,7.855l17.539,20.981L1.56,208.252c-1.746,2.27-2.051,5.461-0.787,8.03   c1.265,2.569,3.88,4.322,6.743,4.322h86.906C94.423,220.604,62.481,183.542,52.329,170.782z"/>
	                                <path d="M64.64,162.185c1.403,1.678,3.682,2.916,5.895,2.916h156.241c1.79,0,3.922-1.039,5.12-2.368   c1.148-1.275,1.792-3.403,1.792-5.003V84.346c0-4.151-3.654-7.95-7.805-7.95H70.535c-4.151,0-7.805,3.22-7.805,7.371v73.384   C62.73,158.918,63.52,160.845,64.64,162.185z"/>
                                </g>
                            </svg>
                            Change Banner
                        </a>
                    </div>
                </div>
            </div>
            <div class="main-container" id='albumPage'>
                <div class="content-wrapper">
                    <div class="content-section">
                        <div class="content-section-title">Add an Album</div>
                        <div id='addAlbumForm'>
                            <form id="file-upload-form" class="uploader">
                                <input id="cover-upload" type="file" name="cover" accept=".png,.jpg,.jpeg,.gif" required/>
                                <label for="cover-upload">
                                    <img id="file-image" src="#" alt="Preview" class="hidden">
                                    <div id="coverStart">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 485 485" style="enable-background:new 0 0 485 485;" xml:space="preserve">
                                            <g>
                                                <polygon points="163.07,268.626 321.93,268.626 321.93,153.056 380.926,153.056 242.5,1.374 104.074,153.056 163.07,153.056"/>
                                                <path d="M0,308.626v175h485v-175H0z M330,411.126c-8.284,0-15-6.716-15-15s6.716-15,15-15c8.284,0,15,6.716,15,15   S338.284,411.126,330,411.126z M400,411.126c-8.284,0-15-6.716-15-15s6.716-15,15-15c8.284,0,15,6.716,15,15   S408.284,411.126,400,411.126z"/>
                                            </g>
                                        </svg>
                                        <div>Select a file or drag here</div>
                                        <span class="file-upload-btn">Select the Album Cover Picture</span>
                                    </div>
                                    <div id="coverResponse" class="hidden">
                                        <div id="coverMessages"></div>
                                        <progress class="progress" id="cover-file-progress" value="0">
                                            <span>0</span>%
                                        </progress>
                                    </div>
                                </label>
                                <div id='partition'></div>
                                <input id="audios-upload" type="file" name="audios" multiple accept=".mp3" required/>
                                <label for="audios-upload">
                                    <div id="audiosStart">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 485 485" style="enable-background:new 0 0 485 485;" xml:space="preserve">
                                            <g>
                                                <polygon points="163.07,268.626 321.93,268.626 321.93,153.056 380.926,153.056 242.5,1.374 104.074,153.056 163.07,153.056"/>
                                                <path d="M0,308.626v175h485v-175H0z M330,411.126c-8.284,0-15-6.716-15-15s6.716-15,15-15c8.284,0,15,6.716,15,15   S338.284,411.126,330,411.126z M400,411.126c-8.284,0-15-6.716-15-15s6.716-15,15-15c8.284,0,15,6.716,15,15   S408.284,411.126,400,411.126z"/>
                                            </g>
                                        </svg>
                                        <span class="file-upload-btn">Select the music files</span>
                                    </div>
                                    <div id="audiosResponse" class="hidden">
                                        <div id="audiosMessages"></div>
                                        <progress class="progress" id="audios-file-progress" value="0">
                                            <span>0</span>%
                                        </progress>
                                    </div>
                                </label>
                                <input type="submit" value="Upload Album" id="uploadAlbum">
                            </form>
                        </div>
                    </div>
                    <div class="content-section">
                        <div class="content-section-title">Trending</div>
                        <ul>
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
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-container" id='bannerPage' style='display:none;'>
                <div class="content-wrapper">
                    <div class="content-section">
                        <div class="content-section-title">My Playlists</div>
                        <div class="apps-card">
                            <div class="app-card">
                                <span>
                                    <svg viewBox="0 0 512 512" style="border: 1px solid #a059a9">
                                        <path xmlns="http://www.w3.org/2000/svg" d="M480 0H32C14.368 0 0 14.368 0 32v448c0 17.664 14.368 32 32 32h448c17.664 0 32-14.336 32-32V32c0-17.632-14.336-32-32-32z" fill="#210027" data-original="#7b1fa2"/>
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path d="M192 64h-80c-8.832 0-16 7.168-16 16v352c0 8.832 7.168 16 16 16s16-7.168 16-16V256h64c52.928 0 96-43.072 96-96s-43.072-96-96-96zm0 160h-64V96h64c35.296 0 64 28.704 64 64s-28.704 64-64 64zM400 256h-32c-18.08 0-34.592 6.24-48 16.384V272c0-8.864-7.168-16-16-16s-16 7.136-16 16v160c0 8.832 7.168 16 16 16s16-7.168 16-16v-96c0-26.464 21.536-48 48-48h32c8.832 0 16-7.168 16-16s-7.168-16-16-16z" fill="#f6e7fa" data-original="#e1bee7"/>
                                        </g>
                                    </svg>
                                    Premiere Pro
                                </span>
                                <div class="app-card__subtext">Edit, master and create fully proffesional videos</div>
                                <div class="app-card-buttons">
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
                            </div>
                            <div class="app-card">
                                <span>
                                    <svg viewBox="0 0 52 52" style="border: 1px solid #c1316d">
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z" fill="#2f0015" data-original="#6f2b41"/>
                                            <path d="M18.08 39H15.2V13.72l-2.64-.08V11h5.52v28zM27.68 19.4c1.173-.507 2.593-.761 4.26-.761s3.073.374 4.22 1.12V11h2.88v28c-2.293.32-4.414.48-6.36.48-1.947 0-3.707-.4-5.28-1.2-2.08-1.066-3.12-2.92-3.12-5.561v-7.56c0-2.799 1.133-4.719 3.4-5.759zm8.48 3.12c-1.387-.746-2.907-1.119-4.56-1.119-1.574 0-2.714.406-3.42 1.22-.707.813-1.06 1.847-1.06 3.1v7.12c0 1.227.44 2.188 1.32 2.88.96.719 2.146 1.079 3.56 1.079 1.413 0 2.8-.106 4.16-.319V22.52z" fill="#e1c1cf" data-original="#ff70bd"/>
                                        </g>
                                    </svg>
                                    InDesign
                                </span>
                                <div class="app-card__subtext">Design and publish great projects & mockups</div>
                                <div class="app-card-buttons">
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
                            </div>
                            <div class="app-card">
                                <span>
                                    <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                                        <g xmlns="http://www.w3.org/2000/svg">
                                            <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z" fill="#3a3375" data-original="#3a3375" />
                                            <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z" fill="#e4d1eb" data-original="#e7adfb" />
                                        </g>
                                    </svg>
                                    After Effects
                                </span>
                                <div class="app-card__subtext">Industry Standart motion graphics & visual effects</div>
                                <div class="app-card-buttons">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay-app"></div>
    </div>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.1116.0.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
    <script type='text/javascript' src='admin.js'></script>
</body>
</html>