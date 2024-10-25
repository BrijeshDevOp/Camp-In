<?php
    session_start();
    $dbPath = __DIR__.'/../Assets/db/database.php';
    require $dbPath;

    $username = $_SESSION['username'];

    $sql = "SELECT `user_id` from `user` where `username` = '$username'";

    $result = mysqli_query($conn,$sql);

    if($result->num_rows>0)
    {
        $row = $result->fetch_assoc();
        $userID = $row["user_id"];
        $_SESSION['u_id'] = $userID;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMP-IN</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/tab1.css">
    <link rel="stylesheet" href="../css/tab2.css">
    <link rel="stylesheet" href="../css/tab3.css">
    <link rel="stylesheet" href="../css/camp-list-modal.css">
    <link rel="stylesheet" href="../css/create-modal.css">
    <link rel="stylesheet" href="../css/notification-modal.css">
    <link rel="stylesheet" href="../css/admin-notification.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>
    <div class="parent-container">
        <nav class="nav-bar">
            <div class="box1">
                <div class="title-box">
                    <div class="box">
                        <img src="../ICONS/campground-solid.svg" alt="none">
                    </div>

                    <div class="name-box">CAMP-iN</div>
                </div>
                <!-- search bar -->
                <div class="search-box">
                    <div class="search-bar">
                        <input type="text" id="search-field">
                        <div class="icon-box">
                            <img src="../ICONS/search.svg" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- ---------------NAV-BAR----------------- -->
    <div class="box2">
            <div class="btns home-box" onclick="openTab('tab1')">
                <div class="img-box">
                    <img src="../ICONS/home.svg" alt="">
                </div>
                <div class="name-box">HOME</div>
            </div> 

            <div class="btns gallery-box" onclick="openTab('tab2')">
                <div class="img-box">
                <img src="../ICONS/gallery-box.svg" alt="">
                </div>
                <div class="name-box">GALLERY</div>
            </div>

            <div class="btns post-box" id="open-create-modal">
                <div class="img-box">
                    <img src="../ICONS/plus-solid.svg" alt="" srcset="">
                </div>
                <div class="name-box">POST</div>
            </div>

            <div class="btns explore-box" onclick="openTab('tab3')">
                <div class="img-box">
                    <img src="../ICONS/compass-regular.svg" alt="" srcset="">
                </div>
                <div class="name-box">EXPLORE</div>
            </div>

            <div class="btns notification-box" id="open-notify-modal">
                <div class="img-box">
                    <img src="../ICONS/bell-solid.svg" alt="" srcset="">
                </div>
                <div class="name-box">NOTIFICATION</div>
            </div>

            <div class="btns camp-list-box" id="c-list">
                <div class="img-box">
                    <img src="../ICONS/bars-solid.svg" alt="" srcset="">
                </div>
                <div class="name-box">CAMPS</div>
            </div>
    </div>
    <!-- ----------------------.BOX3 PROFILE BUTTON------------------------------ -->
            <div class="box3">
                <a href="profile_page.php?user_id=<?php echo $userID;?>" class="profile-button">
                    <img src="../Assets/images/profile.png" alt="" srcset="">
                </a>
                <div class="name-box">PROFILE</div>
            </div>
        </nav>

        <!-- ----------------------NAVIGATION BAR------------------------------- -->

 <!-- ---------------------MAIN-SECTION------------------------------- -->

 <!-- ------------------------------------------------------------TAB1----------------------------------------------------------------------------------------- -->
        <div class="tab-content" id="tab1-content">
            <!-- <div class="home-post-container">
                    <div class="home-camp-name-box">
                        <div class="home-at-icon-box">
                            <img src="../ICONS/at.svg" alt="" srcset="">
                        </div>
                        <div class="home-camp-name">
                            <a class="home-camp-link" href="">brijesh</a>
                        </div>
                    </div>

                    <div class="home-post-img-box">
                        <img src="../POSTS/20230811_033943_64d5915f8d916.jpg" alt="">
                    </div>

                    <div class="home-info-function-box">
                        <div class="home-info-box">
                            <div class="home-profile-box">
                                <img src="../POSTS/20230811_033943_64d5915f8d916.jpg" alt="">
                            </div>
                            <div class="home-name-box">
                                <a href="gd.php" class="user-name">user1</a>
                            </div>
                        </div>
                        <div class="home-function-box">
                            <div class="like-box">
                                        <img src="../ICONS/heart-regular.svg" alt="" srcset="">
                            </div>
                                
                            <div class="like-count-box">100</div>
                        </div>
                    </div>
                    
                    <div class="home-description-box">
                        <div class="home-post-description">
                            quis odit iusto vitae.
                        </div>
                    </div>
             </div> -->
        </div>

<!-- --------------------------------------------------------------TAB2------------------------------------------------------------------------------------------------- -->
        <div class="tab-content" id="tab2-content" style="display:none;">
                <div id="gallery-post-grid">
                    <!-- enter contents -->
                </div>
        </div>

<!-- --------------------------------------------------------------TAB3---------------------------------------------------------------------------------------------- -->
        <div class="tab-content" id="tab3-content" style="display:none;">
                <div class="e_grid_container">

                    <!-- <div class="container-box">

                        <div class="c-box" id="c-box">

                            <div class="i-box" id="i-box">
                                <img src="../ICONS/flower.svg" alt="" srcset="" id="icon">
                            </div>

                            <div class="view" id="view">
                                <div class="i">
                                    <img src="../ICONS/user-plus-solid.svg" alt="" srcset="">
                                </div>
                                <div class="c">500</div>
                                <div class="i">
                                    <img src="../ICONS/comment-regular.svg" alt="" srcset="">
                                </div>
                                <div class="c">200</div>
                            </div>

                            <div class="description" id="description">
                                <div class="cname"></div>
                                <div class="about" id="about"></div>
                                <a class="join" id="join">join</a>
                            </div>

                        </div>

                    </div> -->
                 </div>
                <!-- -----------------------------------tab3 -->
        </div>

        <!-- ============================tab-2-Modal======================================= -->

        <div id="tab2-modal">
                <div class="gallery-post-container">
                            <div class="home-camp-name-box">
                                <div class="home-at-icon-box">
                                    <img src="../ICONS/at.svg" alt="" srcset="">
                                </div>
                                <div class="home-camp-name">
                                    <a class="home-camp-link" href="" id="t2-m-cname"></a>
                                </div>

                                <div class="t2-close-btn" onclick="closeModalt2()">&times;</div>
                            </div>

                            <div class="home-post-img-box">
                                <img src="" alt="" id="t2-m-post-img">
                            </div>

                            <div class="home-info-function-box">
                                <div class="home-info-box">
                                    <div class="home-profile-box">
                                        <img src="" alt="" id="t2-m-profile-img">
                                    </div>
                                    <div class="home-name-box">
                                        <a href="" class="user-name" id="t2-m-u-name"></a>
                                    </div>
                                </div>
                                <div class="home-function-box">
                                    <div class="like-box" id="like-box">
                                                <img src="" alt="" srcset="" id="t2-m-like-icon">
                                    </div>
                                        
                                    <div class="like-count-box" id="t2-m-like-count"></div>
                                </div>
                            </div>
                            
                            <div class="home-description-box">
                                <div class="home-post-description" id="t2-m-post-desc"></div>
                            </div>
                </div>
        </div>


        <!-- ============================C-LIST MODAL==================================== -->
        <div class="Camp-Modal">
            <div class="clist-container" id="clist-container">
                <!-- <a class="camp-box" href="">
                    <div class="camp_name">
                        camp name
                    </div>
                    <div class="camp_icon">
                        <img src="../ICONS/at.svg" alt="" srcset="">
                    </div>
                </a> -->
            </div>
            <button id="close">close</button>
        </div>
    
        <!-- =============================CREATE-MODAL=============================================== -->
        <div id="create-modal">
            <span class="close-create-modal">&times;</span>
            <div id="modal-content">
                <div class="tab-buttons">
                    <div class="btns tab1" id="post-tab-button" onclick="openCreateTab('post-tab-content')">POST</div>
                    <div class="btns tab2" id="create-tab-button" onclick="openCreateTab('create-tab-content')">CREATE</div>
                </div>

                 <div class="create-modal-tabs" id="post-tab-content">
                    <div class="post-card-box">
                    
                        <div class="post-camp-name" >
                            <div class="icon-box">
                                <img src="../ICONS/at.svg" alt="" srcset="">
                            </div>
                            <input type="text" name="" id="post-camp-name"  placeholder="Enter camp name">
                        </div>

                        <div class="select-img-box">
                            <label for="fileInput">
                                <div class="post-img-box">
                                    <img src="../ICONS/upload-icon-16.jpg" alt="Img1" class="picture1" id="img1" srcset="">
                                    <img src="" alt="Img" class="picture" id="img" srcset="">
                                </div>
                            </label>
                            <input type="file" name="file" id="fileInput" onchange="previewImage();"
                                style="visibility:hidden;">
                        </div>

                        <div class="description-box">
                            <textarea name="" id="post-description" placeholder="Enter about your post"></textarea>
                        </div>
                    </div>
                    <!-- post-card -->
                    <div class="post-button-box">
                        <div id="cancel" onclick="cancel();">CANCEL</div>
                        <div id="post">POST</div>
                    </div>
                 </div>

                 <!-- ==========================CREATE-CAMP=============================== -->
                 <div class="create-modal-tabs" id="create-tab-content" style="display:none">
                    <div class="create-box">
                        <div class="message">hello</div>
                        <div class="camp_name_box">
                           Enter Camp name: <input type="text" id="c_c_name">
                        </div>

                        <div class="camp_description_box">
                           Enter description: <textarea name="" id="c_c_desc" cols="30" rows="10" ></textarea>
                        </div>

                        <div class="access_box">
                            visibility:
                                 <label class="toggle-switch1">
                                      only_members:  <input type="checkbox" class="toggle-checkbox1" value="0" checked>
                                 </label>

                                <label class="toggle-switch1">
                                      All:  <input type="checkbox" class="toggle-checkbox1" value="1">
                                </label>
                        </div>

                        <div class="visibility_box">
                            Accessibility:
                                <label class="toggle-switch2">
                                     only members:   <input type="checkbox" class="toggle-checkbox2" value="0" checked>
                                </label>

                                <label class="toggle-switch2">
                                      All : <input type="checkbox" class="toggle-checkbox2" value="1">
                                </label>

                                <script>
                                     const toggleSwitches1 = document.querySelectorAll('.toggle-switch1');
                                    toggleSwitches1.forEach(switchElement => {
                                        switchElement.addEventListener('click', () => {
                                            toggleSwitches1.forEach(otherSwitch => {
                                                if (otherSwitch !== switchElement) {
                                                    otherSwitch.querySelector('.toggle-checkbox1').checked = false;
                                                }
                                            });
                                        });
                                    });

                                    const toggleSwitches2 = document.querySelectorAll('.toggle-switch2');
                                    toggleSwitches2.forEach(switchElement => {
                                        switchElement.addEventListener('click', () => {
                                            toggleSwitches2.forEach(otherSwitch => {
                                                if (otherSwitch !== switchElement) {
                                                    otherSwitch.querySelector('.toggle-checkbox2').checked = false;
                                                }
                                            });
                                        });
                                    });
                                </script>
                        </div>

                        <div class="camp_button">
                            <div class=" campb c_create_cancel" onclick="campCancel();">cancel</div>
                            <div class="campb c_create_next" onclick="campNext();">next</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- =============================  NOTIFICATIONS ========================================================= -->
        <div id="notify-modal">
                <span class="close-notify-modal">&times;</span>

                <div id="notify-modal-content">
                   <!-- <a class="notify-box" href="">
                        <div class="camp_name">
                            <img src="../ICONS/at.svg" alt="" srcset="">
                            <div class="name">Camp1</div>
                        </div>
                        <div class="info">
                            <div class="user_name"></div>
                            <div class="message">Uploaded an image</div>
                        </div>
                    </a> -->
                </div>
        </div>
        <!-- ================================ADMIN-NOTIFICATION====================================================== -->
       

        <!------------------------------- parent-container ------------------------>
    </div>


   <!-- ============================================================================= -->
    <script>
        const serchBox = document.getElementById("search-field");

        serchBox.addEventListener('click',function()
        {
            window.location.href = 'search.php';
        });
    </script>
    <script src="../js/tabs.js"></script>
    <script src="../js/like.js"></script>
    <script src="../js/tab1.js"></script>
    <script src="../js/tab2.js"></script>
    <script src="../js/tab3.js"></script>
    <script src="../js/camp-list-modal.js"></script>
    <script src="../js/create-modal.js"></script>
    <script src="../js/notification-modal.js"></script>
</body>

</html>