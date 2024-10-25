<?php
session_start();
$userId = $_SESSION['u_id'];

    if(isset($_GET['g_id']))
    {
        $encodedValue = $_GET['g_id'];
        $gid = base64_decode($encodedValue);
        $_SESSION['g_id'] =  $gid;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCamp</title>
    <link rel="stylesheet" href="../css/c_style.css">
    <link rel="stylesheet" href="../css/c_responsive.css">
    <style>
        .control-box .control-box-div{
            grid-template-columns: 1fr 1fr 1fr;
        }
    </style>
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

            <div class="join-box" id="join-box">
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
        </div>
        <!-- main-section -->

        <div class="control-box" id="control-box">
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

                <div class="btn-box gallery-box" onclick="openCTab('tab2')">
                    <div class="icon-box">
                        <img src="../ICONS/grid.svg" alt="" srcset="">
                    </div>
                    <div class="btn-name">GALLERY</div>
                </div>

            </div>

        </div>
        <!-- control-box -->


        <div class="modal" id="popupModal">
                <div class="modal-content">
                    <p>The posts in this group is restricted to group members</p>
                    <div class="join-group" id="jbtn-box">
                        <div class="join-as-member" onclick="sendRequest()" id="jbtn-m">JOIN</div>
                    </div>
                </div>
        </div>

    </div>

    
    <script>
        var g_id ='<?php echo $gid; ?>';
        var u_id = '<?php echo $userId ?>';
            console.log(g_id," ",u_id);
    </script>
    <script src="../js/checkCampAccess.js"></script>
    <script src="../js/getGroupProfile.js"></script>
    <script src="../js/c_tabs.js"></script>
    <script src="../js/getGroupPosts.js"></script>
    <script src="../js/sendJoinRequest.js"></script>
</body>
</html>