<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] === "GET")
    {
         if(isset($_GET["c_name"]) && isset($_GET["c_desc"]) && isset($_GET["c_access"]) && isset($_GET["c_visible"]))
        {
            $c_name = $_GET["c_name"];
            $c_desc = $_GET["c_desc"];
            $c_access = $_GET["c_access"];
            $c_visible = $_GET["c_visible"];
        }
        else
        {
            echo "<h1>ERROR</h1>";
             // echo json_encode($response);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design</title>
    <link rel="stylesheet" href="../css/build.css">
</head>

<body>
    <div class="container">
        <div class="camp-box">
            <div class="container-box">
                <div class="c-box" id="c-box">
                    <div class="i-box" id="i-box">
                        <img src="../ICONS/flower.svg" alt="" srcset="" id="icon" style = "filter:invert(31%) sepia(78%) saturate(1211%) hue-rotate(190deg) brightness(107%)">
                    </div>
                    <div class="view" id="view">
                        <div class="i">
                            <img src="../ICONS/members.svg" alt="" srcset="">
                        </div>
                        <div class="c">0</div>
                        <div class="i">
                            <img src="../ICONS/uploads.svg" alt="" srcset="">
                        </div>
                        <div class="c">0</div>
                    </div>
                    <div class="description" id="description">
                        <div class="cname"><?php echo htmlspecialchars($c_name);?></div>
                        <div class="about" id="about"><?php echo htmlspecialchars($c_desc);?></div>
                        <a class="join" id="join">join</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="tab-buttons">
                <div class="f theme" onclick="openTab(event,'tab1')">Icon</div>
                <div class="f icon" onclick="openTab(event,'tab2')">Theme</div>
            </div>
            
            <div class="tab-content" id="tab1">
                <div class="icon-box">
                    <div class="icons" onclick="changeIcon('../ICONS/flag-thin.svg')">
                        <img src="../ICONS/flag-thin.svg" alt="">
                    </div>
                    
                    <div class="icons" onclick="changeIcon('../ICONS/flower.svg')">
                        <img src="../ICONS/flower.svg" alt="">
                    </div>
                    
                    <div class="icons" onclick="changeIcon('../ICONS/ellipsis-vertical-solid.svg')">
                        <img src="../ICONS/ellipsis-vertical-solid.svg" alt="">
                    </div>
                    
                    <div class="icons" onclick="changeIcon('../ICONS/heart-regular.svg')">
                        <img src="../ICONS/heart-regular.svg" alt="">
                    </div>

                    <div class="icons" onclick="changeIcon('../ICONS/note.svg')">
                        <img src="../ICONS/note.svg" alt="">
                    </div>

                    <div class="icons" onclick="changeIcon('../ICONS/vBall.svg')">
                        <img src="../ICONS/vBall.svg" alt="">
                    </div>

                    <div class="icons" onclick="changeIcon('../ICONS/wink.svg')">
                        <img src="../ICONS/wink.svg" alt="">
                    </div>

                    <div class="icons" onclick="changeIcon('../ICONS/game-pad.svg')">
                        <img src="../ICONS/game-pad.svg" alt="">
                    </div>
                    
                    <div class="icons" onclick="changeIcon('../ICONS/sceince.svg')">
                        <img src="../ICONS/sceince.svg" alt="">
                    </div>
                      
                    <div class="icons" onclick="changeIcon('../ICONS/computer.svg')">
                        <img src="../ICONS/computer.svg" alt="">
                    </div>
                    <div class="icons" onclick="changeIcon('../ICONS/football.svg')">
                        <img src="../ICONS/football.svg" alt="">
                    </div>
                    <div class="icons" onclick="changeIcon('../ICONS/film.svg')">
                        <img src="../ICONS/film.svg" alt="">
                    </div>
                    <div class="icons" onclick="changeIcon('../ICONS/farm.svg')">
                        <img src="../ICONS/farm.svg" alt="">
                    </div>
                    <div class="icons" onclick="changeIcon('../ICONS/hand.svg')">
                        <img src="../ICONS/hand.svg" alt="">
                    </div>
                    <div class="icons" onclick="changeIcon('../ICONS/wwe.svg')">
                        <img src="../ICONS/wwe.svg" alt="">
                    </div>
                    <div class="icons" onclick="changeIcon('../ICONS/rocket.svg')">
                        <img src="../ICONS/rocket.svg" alt="">
                    </div>
                    <div class="icons" onclick="changeIcon('../ICONS/photo.svg')">
                        <img src="../ICONS/photo.svg" alt="">
                    </div>
                    <div class="icons" onclick="changeIcon('../ICONS/doctor.svg')">
                        <img src="../ICONS/doctor.svg" alt="">
                    </div>
                </div>
                
                <div class="icon-colors">
                    <div class="icon-color" style="background: blue;"
                    onclick="changeIconColor('invert(31%) sepia(78%) saturate(1211%) hue-rotate(190deg) brightness(107%)')">
                </div>

                <div class="icon-color" style="background:#4B9971;" onclick="changeIconColor('invert(55%) sepia(11%) saturate(1697%) hue-rotate(97deg) brightness(94%) contrast(81%)')">
                </div>

                <div class="icon-color" style="background:#8427B3" onclick="changeIconColor('invert(19%) sepia(74%) saturate(3041%) hue-rotate(270deg) brightness(89%) contrast(95%)')">
                </div>
                
                
                <div class="icon-color" style="background:#EEEB3E" onclick="changeIconColor('invert(81%) sepia(54%) saturate(563%) hue-rotate(8deg) brightness(107%) contrast(91%)')">
                </div>
                <div class="icon-color" style="background:#31D738" onclick="changeIconColor('invert(63%) sepia(95%) saturate(562%) hue-rotate(68deg) brightness(96%) contrast(85%)')">
                </div>
                <div class="icon-color" style="background:#DF3F70" onclick="changeIconColor('invert(31%) sepia(65%) saturate(2062%) hue-rotate(317deg) brightness(94%) contrast(85%)')">
                </div>
                <div class="icon-color" style="background:#DF3FD0" onclick="changeIconColor('invert(40%) sepia(27%) saturate(4500%) hue-rotate(278deg) brightness(89%) contrast(96%)')">
                </div>
                <div class="icon-color" style="background:#DB7136" onclick="changeIconColor('invert(46%) sepia(69%) saturate(554%) hue-rotate(337deg) brightness(98%) contrast(85%)')">
                </div>
                <div class="icon-color" style="background:#7FD937" onclick="changeIconColor('invert(68%) sepia(62%) saturate(519%) hue-rotate(47deg) brightness(101%) contrast(87%)')">
                </div>
                <div class="icon-color" style="background:#38C9D7" onclick="changeIconColor('invert(92%) sepia(15%) saturate(5272%) hue-rotate(150deg) brightness(84%) contrast(100%)')">
                </div>
                <div class="icon-color" style="background:#387AD7" onclick="changeIconColor('invert(44%) sepia(74%) saturate(570%) hue-rotate(176deg) brightness(87%) contrast(93%)')">
                </div>
            </div>
        </div>
        <div class="tab-content" id="tab2">
            <div class="color-box">
                <div class="themes" style="background:#E6FC47" onclick="changeTheme('hsl(57,71%,62%)')"></div>
                <div class="themes" style="background:#8B34E2" onclick="changeTheme('hsl(258,76%,55%)')"></div>
                <div class="themes" style="background: #7DFC47" onclick="changeTheme('hsl(102,97%,63%)')"></div>
                <div class="themes" style="background: #F37D7D" onclick="changeTheme('hsl(0,83%,72%)')"></div>
                <div class="themes" style="background: #e6aad0" onclick="changeTheme('hsl(322,54%,78%)')"></div>
                <div class="themes" style="background: #60DB40" onclick="changeTheme('hsl(108, 68%, 55%)')"></div>
                <div class="themes" style="background: #38D16E" onclick="changeTheme('hsl(141, 62%, 52%)')"></div>
                <div class="themes" style="background: #6438D1" onclick="changeTheme('hsl(257, 62%, 52%)')"></div>
                <div class="themes" style="background: #D138C8" onclick="changeTheme('hsl(304, 62%, 52%)')"></div>
                <div class="themes" style="background: #D1385D" onclick="changeTheme('hsl(345, 62%, 52%)')"></div>
                <div class="themes" style="background: #384CD1" onclick="changeTheme('hsl(232, 62%, 52%)')"></div>
                <div class="themes" style="background: #38D19F" onclick="changeTheme('hsl(160, 62%, 52%)')"></div>
                <div class="themes" style="background: #DD8D3E" onclick="changeTheme('hsl(30, 70%, 55%)')"></div>
            </div>
        </div>
        <div class="tab-content" id="tab3">
            <div class="font-box" id="font-box"></div>
        </div>
    </div>
</div>
<!-- ===================================================================================================================== -->
<div class="control_box">
    <div class="btn create" onclick="createCamp();">post</div>
    <div class="btn cancel">cancel</div>
</div>
<script>
    // Get all tab content elements
    // .c-box , border -.i-box , .c-box , .view ,.description , .about . ,.join
    
    function changeIcon(icon) {
        const changeIcon = document.getElementById("icon");
        changeIcon.src = icon;
    }
    
    function changeIconColor(colors) {
        const changeIconColor = document.getElementById("icon");
            changeIconColor.style.filter = colors;
        }
        
        function changeTheme(theme) {
            const changeTheme = document.getElementById("c-box");
            changeTheme.style.backgroundColor = theme;
            
            adjustLightness();
        }
        
        
        function adjustLightness() {
            // Get the div elements
            const divA = document.getElementById('c-box');
            const divB = document.getElementById('i-box');
            const divC = document.getElementById('view');
            const divD = document.getElementById('description');
            const divE = document.getElementById('about');
            const divF = document.getElementById('join');
            const divG = document.getElementById('i-box');
            
            // Get the computed style of div A and its background color
            const computedStyle = window.getComputedStyle(divA);
            const bgColor = computedStyle.backgroundColor; // e.g., "rgb(63, 127, 191)"
            
            // Convert the RGB value of div A to HSL
            const rgbValues = bgColor.match(/\d+/g);
            const hslValues = rgbToHsl(rgbValues[0], rgbValues[1], rgbValues[2]);
            
            // Decrease or increase the lightness component (L) of the HSL value
            const lightnessChangeB = 3;
            const lightnessChangeC = 10;
            const lightnessChangeD = 3;
            const lightnessChangeE = 9;
            const lightnessChangeF = 1;
            const lightnessChangeG = 16;
            // Adjust this value to increase or decrease the lightness
            // const modifiedLightness = Math.min(100, Math.max(0, hslValues[2] + lightnessChange));

            // Apply the modified HSL value to div B using CSS
            divB.style.borderColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeB}%)`;
            divC.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeC}%)`;
            divD.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeD}%)`;
            divE.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeE}%)`;
            divF.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeF}%)`;
            divG.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeG}%)`;


        }

        // Function to convert RGB to HSL
        function rgbToHsl(r, g, b) {
            r /= 255;
            g /= 255;
            b /= 255;

            const max = Math.max(r, g, b);
            const min = Math.min(r, g, b);
            let h, s, l = (max + min) / 2;

            if (max === min) {
                h = s = 0;
            } else {
                const d = max - min;
                s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

                switch (max) {
                    case r:
                        h = (g - b) / d + (g < b ? 6 : 0);
                        break;
                    case g:
                        h = (b - r) / d + 2;
                        break;
                    case b:
                        h = (r - g) / d + 4;
                        break;
                }

                h /= 6;
            }

            return [Math.round(h * 360), Math.round(s * 100), Math.round(l * 100)];
        }

        function openTab(evt, tabName) {
            var i, tabContent, tabLinks;
            tabContent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
            }
            tabLinks = document.getElementsByClassName("tab");
            for (i = 0; i < tabLinks.length; i++) {
                tabLinks[i].classList.remove("active");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.classList.add("active");
        }
        
        var i_img = document.getElementById("icon");
        var c_theme = document.getElementById("c-box");

        function createCamp()
        {
            const icon_img =i_img.src;
            const icon_path = icon_img.replace(/.*CAMPIN?\//,'');
            const icon_url ='../'+icon_path;
            const i_color = window.getComputedStyle(i_img);
            const icon_color = i_color.getPropertyValue('filter');
            const camp_theme = window.getComputedStyle(c_theme).backgroundColor;
            const camp_name = '<?php echo $c_name?>';
            const camp_description = '<?php echo $c_desc ?>';
            const camp_access = '<?php echo  $c_access ?>';
            const camp_visible = '<?php echo  $c_visible ?>';

            const campData = new FormData();
            campData.append('c_name',camp_name);
            campData.append('c_desc',camp_description);
            campData.append('c_access',camp_access);
            campData.append('c_visible',camp_visible);
            campData.append('c_i_url',icon_url);
            campData.append('c_i_color',icon_color);
            campData.append('c_theme',camp_theme);

            fetch("../PostData/camp_data.php", {
                method: "POST",
                body:campData
            })
            .then(response => response.json())
            .then(data => {
                if(data.response == "failed")
                {
                    console.log(data.message);
                }
                else
                {
                    console.log(data.message);
                    console.log(data.c_name);
                    console.log(data.c_id);
                    console.log(data.c_desc);
                    console.log(data.c_access);
                    console.log(data.c_visible);
                    console.log(data.c_i_url);
                    console.log(data.c_i_color);
                    console.log(data.c_theme);
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }

    </script>
</body>

</html>
