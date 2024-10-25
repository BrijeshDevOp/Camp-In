const e_grid_container = document.querySelector('.e_grid_container');

fetch('../getData/campGroups.php')
.then(response => response.json())
.then(groups => {
    groups.forEach(group => {
                        const rgbValues = group.rgb.match(/\d+/g); // Extract RGB values from the string
                        const rgb = group.rgb;
                        const gid = group.g_id;
                        const gname = group.gname;
                        const gdesc = group.desc;
                        const iconImg = group.icon_img;
                        const iconColor = group.icon_color;
                        const posts = group.post_count;
                        const members = group.member_count;
                        const bgColor = {
                            r: parseInt(rgbValues[0]),
                            g: parseInt(rgbValues[1]),
                            b: parseInt(rgbValues[2])
                        };

                        // Create and adjust div elements based on the fetched color
                        createAndAdjustDivElements(e_grid_container,gid,gname,gdesc,iconImg,iconColor,bgColor,rgb,posts,members);
                });
        })
        .catch(error => {
                console.error('Error fetching group data:', error);
        });



function createAndAdjustDivElements(e_grid_container,gid,gname,gdesc,iconImg,iconColor,bgColor,rgb,posts,members) {
            
            const containerBox = document.createElement('div');
            containerBox.classList.add('container-box');
        
            const cBox = document.createElement('div');
            cBox.classList.add('c-box');
        
            const icon = document.createElement('div');
           
            icon.classList.add('i-box');

            const icon_Img = document.createElement('img');
            icon_Img.src = iconImg;
            icon_Img.style.filter =iconColor;
            icon_Img.alt = '';

            
            const view = document.createElement('div');
            view.classList.add('view');
            
            const membersIcon = document.createElement('div');
            membersIcon.classList.add('i');
            const membersIconImage = document.createElement('img');
            membersIconImage.src = '../ICONS/members.svg';
            membersIconImage.alt = '';
            const membersCount = document.createElement('div');
            membersCount.classList.add('c');
            membersCount.textContent = members;
            
            const commentsIcon = document.createElement('div');
            commentsIcon.classList.add('i');
            const commentsIconImage = document.createElement('img');
            commentsIconImage.src = '../ICONS/uploads.svg';
            commentsIconImage.alt = '';
            const commentsCount = document.createElement('div');
            commentsCount.classList.add('c');
            commentsCount.textContent = posts;
            
            const description = document.createElement('div');
            description.classList.add('description');
            
            const cname = document.createElement('div');
            cname.classList.add('cname');
            cname.textContent =gname;
            
            const about = document.createElement('div');
            about.classList.add('about');
            about.textContent =gdesc;
            
            const joinLink = document.createElement('a');
            joinLink.classList.add('join');
            joinLink.textContent = 'join';
            // Set the href attribute with group ID and HSL color value
            joinLink.href = `camp.php?g_id=${gid}`;
            
            // Adjust the color of the elements
            // Create div elements
            // const divA = document.querySelector('.c-box');
            // const divB = document.querySelector('.i-box');
            // const divC = document.querySelector('.view');
            // const divD = document.querySelector('.description');
            // const divE = document.querySelector('.about');
            // const divF = document.querySelector('.join');
            // const divG = document.querySelector('.i-box');
            
            // Convert background color to HSL
            const hslValues = rgbToHsl(bgColor.r, bgColor.g, bgColor.b);
            
            // Calculate adjusted lightness values
            const lightnessChangeB = 3;
            const lightnessChangeC = 10;
            const lightnessChangeD = 3;
            const lightnessChangeE = 9;
            const lightnessChangeF = 1;
            const lightnessChangeG = 16;
            
            // Apply the adjusted HSL values to div elements
            cBox.style.backgroundColor = rgb;
            icon.style.borderColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeB}%)`;
            view.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeC}%)`;
            about.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeD}%)`;
            description.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeE}%)`;
            joinLink.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeF}%)`;
            icon.style.backgroundColor = `hsl(${hslValues[0]}, ${hslValues[1]}%, ${hslValues[2] + lightnessChangeG}%)`;
            
            icon.appendChild(icon_Img);
            cBox.appendChild(icon);
            membersIcon.appendChild(membersIconImage);
            view.appendChild(membersIcon);
            view.appendChild(membersCount);
            commentsIcon.appendChild(commentsIconImage);
            view.appendChild(commentsIcon);
            view.appendChild(commentsCount);
            cBox.appendChild(view);
            description.appendChild(cname);
            description.appendChild(about);
            description.appendChild(joinLink);
            cBox.appendChild(description);
            containerBox.appendChild(cBox);
            e_grid_container.appendChild(containerBox);
            
        }
        
        
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
