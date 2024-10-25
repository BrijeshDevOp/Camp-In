<?php
session_start();
$userId = $_SESSION['u_id'];

    if(isset($_GET['g_id']))
    {
        $encodedValue = $_GET['g_id'];
        $gid = base64_decode($encodedValue);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACamp</title>
    <link rel="stylesheet" href="../css/c_style.css">
    <link rel="stylesheet" href="../css/c_responsive.css">
</head>
<body>
    <div class="parent-container">
        <nav class="nav-bar">
            <div class="camp-profile">
                <div class="profile-box">
                    <img src="../ICONS/at.svg" alt="" srcset="" id="group-icon">
                </div>

                <div class="profile-name">
                        <a href="" class="profile-link" id="profile-link"></a>
                </div>
            </div>

            <div class="gap"></div>

            <div class="join-box">
                <div class="join-btn" id="join-btn" onclick="sendRequest()">JOIN</div>
            </div>
        </nav>
        <!-- nav_bar -->
        <div class="main-section">
             <!-- ----------------------------------------tab1 content------------------------------------------------ -->
            <div class="tab-content" id="tab1-content">

                     <div class="home-post-container">
                        
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
                                                <img src="../ICONS/heart-solid.svg" alt="" srcset="">
                                    </div>
                                        
                                    <div class="like-count-box">1</div>
                                </div>
                            </div>
                            
                            <div class="home-description-box">
                                <div class="home-post-description">
                                    Working on my project 😃
                                </div>
                            </div>

                    </div>
        <!-- -----------------------------------------home-post-container------------------------------------------------------- -->
        </div>
            <!-- ----------------------------------------tab2 content------------------------------------------------ -->
            <div class="tab-content" id="tab2-content">t2</div>

             <!-- ----------------------------------------tab3 content------------------------------------------------ -->
            <div class="tab-content" id="tab3-content">
                <div class="tab_btn_box">
                    <div class="tab_icon_box" onclick="openAdminTab('join_requests')">
                        <img src="../ICONS/user-plus-solid.svg" alt="" srcset="">
                    </div>
                    <div class="tab_icon_box" onclick="openAdminTab('add_requests')">
                        <img src="../ICONS/thumbtack-solid.svg" alt="" srcset="">
                    </div>
                </div>

                <div class="tab_inbox_container" id="join_requests">
                    
                    <div class="join-message-container">
                        <div class=" box profile_box">
                            <div class="user_profile_box">
                                <img src="../Assets/images/profile.png" alt="">
                            </div>
                        </div>

                        <div class=" box name_box">Brijesh</div>

                        <div class=" box message_box">Wants to join your group</div>

                        <div class=" box control_box">
                            <div class="cb box1">
                                <img src="../Assets/icons/add_member.svg" alt="">
                            </div>
                            <div class="cb box2">
                                <img src="../Assets/icons/remove_member.svg" alt="">
                            </div>
                        </div>
                        
                    </div>

                </div>
            <!-- ----------------------------------------join_requests-------------------------------------------------------------------------- -->
                <div class="tab_inbox_container" id="add_requests">
                        <div class="request_post_box">

                            <div class="request_post_info">
                                <div class="b box1">
                                    <div class="user_profile_box">
                                        <img src="../Assets/images/profile.png" alt="">
                                    </div>
                                </div>
                                <div class="b box2">User Name</div>
                            </div>

                            <div class="request_post_card">
                                <img src="../Assets/images/profile.png" alt="" srcset="">
                            </div>

                            <div class="request_post_desc">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, atque!
                            </div>

                            <div class="request_post_btns">
                                <div class="btns">
                                        <div class="inner_box" id="remove_btn">
                                            <img src="../Assets/icons/remove_image.svg" alt="">
                                        </div>
                                </div>

                                <div class="btns">
                                        <div class="inner_box" id="add_btn">
                                            <img src="../Assets/icons/add_image.svg" alt="" srcset="">
                                        </div>
                                </div>
                            </div>
                            
                        </div>
                </div>

            </div>
        </div>
        <!-- main-section -->
        <div class="control-box">
            <div class="control-box-div">

                <div class="btn-box home-box">
                    <a class="icon-box" href="mainpage.php">
                        <img src="../ICONS/house-solid.svg" alt="" srcset="">
                    </a>
                    <div class="btn-name">HOME</div>
                </div>

                <div class="btn-box posts-box" onclick="openCTab('tab1')">
                    <div class="icon-box">
                        <img src="../ICONS/post_img.svg" alt="" srcset="">
                    </div>
                    <div class="btn-name">POSTS</div>
                </div>

                <div class="btn-box note-box" onclick="openCTab('tab3')">
                    <div class="icon-box">
                        <img src="../ICONS/note.svg" alt="" srcset="">
                    </div>
                    <div class="btn-name">ADMIN-PANEL</div>
                </div>
            </div>
        </div>
        <!-- control-box -->
    </div>
    <script>
        var g_id = '<?php echo $gid; ?>';
            console.log(g_id);

        var u_id = '<?php echo $userId; ?>';
            console.log(u_id);
    </script>
    <script src="../js/getGroupProfile.js"></script>
    <script src="../js/getJoinRequests.js"></script>
    <script src="../js/getPostRequests.js"></script>
    <script src="../js/c_tabs.js"></script>
    <script src="../js/adminTab.js"></script>
    <script src="../js/getGroupPosts.js"></script>
    <script src="../js/sendJoinRequest.js"></script>
</body>
</html>