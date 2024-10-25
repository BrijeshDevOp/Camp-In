     const tab2Grid = document.getElementById('gallery-post-grid');
      // Create the home-post-container div
      const container2 = document.getElementById("tab2-content");
      let currentPage2 = 1;
      const initialRowsPerPage2 = 5;
      const additionalRowsPerPage2 = 5;
      
      container2.addEventListener("scroll", () => {
          if (container2.scrollTop + container2.clientHeight >= container2.scrollHeight) {
              fetchMoreRows2();
            }
        });
        
        function fetchInitialRows2() {
            fetchData2(initialRowsPerPage2);
        }
     
     function fetchMoreRows2() {
         fetchData2(additionalRowsPerPage2);
        }
        
        
        function fetchData2(limit) {
            fetch(`../getData/galleryTab.php?page=${currentPage2}&limit=${limit}`)
            .then(response => response.json())
            .then(data => {
                if(data.message == "No data")
                {
                    console.log("No data available");
                }
                else
                {
                    data.forEach(post => {
                        const t2PostCard = document.createElement('div');
                        t2PostCard.classList.add('tab2-post-card');
                        const img = document.createElement('img');
                        img.src=post.img_url;
    
                        t2PostCard.appendChild(img);
    
                        t2PostCard.addEventListener("click", () => showModalt2(post.post_id,post.user_id,post.username,post.profile_url,post.group_id,post.group_name,post.img_url,post.post_desc,post.like_icon,post.total_likes)); // Pass additional fields
                        tab2Grid.appendChild(t2PostCard);
                    });
                }
                currentPage2++;
            })
            .catch(error => console.error('Error fetching data:', error));
        }
        // -----------------------------------------------------------------------------------------------------------
        const t2card = document.getElementsByClassName('tab2-post-card');
        
        function showModalt2(pId,uId,uname,uProfile,gId,gName,pUrl,pDesc,pLIcon,pLCount)
        {
            const McName = document.getElementById('t2-m-cname');
            McName.textContent=gName;
            McName.href ='camp.php?g_id='+encodeURIComponent(gId);
            const Mpost = document.getElementById('t2-m-post-img');
            Mpost.src=pUrl;
            const Muprofile = document.getElementById('t2-m-profile-img');
            Muprofile.src=uProfile;
            const Muname = document.getElementById('t2-m-u-name');
            Muname.textContent=uname
            const MlikeIcon = document.getElementById('t2-m-like-icon');
            MlikeIcon.src=pLIcon;
            const MlikeCount = document.getElementById('t2-m-like-count');
            MlikeCount.textContent=pLCount;
            const MpDesc = document.getElementById('t2-m-post-desc');
            MpDesc.textContent=pDesc;

            const likeBox = document.getElementById('like-box');
            likeBox.setAttribute('data-id',pId);

            document.getElementById("tab2-modal").style.display = "block";
        }

            const MlikeBox = document.getElementById('like-box');

            MlikeBox.addEventListener('click', function () {
            const postId = MlikeBox.getAttribute('data-id');
            const MlikeIcon = document.getElementById('t2-m-like-icon');
                toggleLike(postId, MlikeIcon, MlikeBox);
            });
        
        function closeModalt2() {
            document.getElementById("tab2-modal").style.display = "none";
        }
        
        function fetchInitialRows2() {
                fetchData2(initialRowsPerPage2);
        }
    