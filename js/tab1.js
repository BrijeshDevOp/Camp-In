      // Create the home-post-container div
       const container = document.getElementById("tab1-content");
       let currentPage = 1;
       const initialRowsPerPage = 5;
       const additionalRowsPerPage = 5;

      container.addEventListener("scroll", () => {
        if (container.scrollTop + container.clientHeight >= container.scrollHeight) {
          fetchMoreRows();
        }
      });
      
      function fetchInitialRows() {
        fetchData(initialRowsPerPage);
      }
      
      function fetchMoreRows() {
        fetchData(additionalRowsPerPage);
      }
      
      
      function fetchData(limit) {
        fetch(`../getData/homeTab.php?page=${currentPage}&limit=${limit}`)
          .then(response => response.json())
          .then(data => {
            if (data.message == "No data") {
              console.log('No data available.');
            } else {
              data.forEach(post => {
                addPostWithLike(post.post_id,post.user_id,post.username,post.profile_url,post.group_id,post.group_name,post.img_url,post.post_desc,post.like_icon,post.total_likes); // Pass additional fields
              });
              currentPage++;
            }
          })
          .catch(error => console.error('Error fetching data:', error));
      }
            
      // -----------------------------------------------------------------------------------------------------------------------
          // -----------------------------------------------------------------------------------------------------
          function addPostWithLike(postId,userId,username,profile_url,groupId,groupName, imageUrl,postDesc,likeIcon,totalLikes) {
            var homePostContainer = document.createElement('div');
            homePostContainer.classList.add('home-post-container');
            
            // Create the home-camp-name-box div
            var homeCampNameBox = document.createElement('div');
            homeCampNameBox.classList.add('home-camp-name-box');
            
      // Create the home-at-icon-box div
      var homeAtIconBox = document.createElement('div');
      homeAtIconBox.classList.add('home-at-icon-box');
      var atIcon = document.createElement('img');
      atIcon.src = '../ICONS/at.svg';
      atIcon.alt = '';
      homeAtIconBox.appendChild(atIcon);
      
      // Create the home-camp-name div
      var homeCampName = document.createElement('div');
      homeCampName.classList.add('home-camp-name');
      var campLink = document.createElement('a');
      campLink.classList.add('home-camp-link');
      campLink.textContent =groupName;
      campLink.href ='camp.php?g_id='+encodeURIComponent(groupId);
      homeCampName.appendChild(campLink);
      
      homeCampNameBox.appendChild(homeAtIconBox);
      homeCampNameBox.appendChild(homeCampName);
      
      // Create the home-post-img-box div
      var homePostImgBox = document.createElement('div');
      homePostImgBox.classList.add('home-post-img-box');
      var postImage = document.createElement('img');
      postImage.src =imageUrl;
      postImage.alt = '';
      homePostImgBox.appendChild(postImage);
      
      // Create the home-info-function-box div
      var homeInfoFunctionBox = document.createElement('div');
      homeInfoFunctionBox.classList.add('home-info-function-box');
      
      // Create the home-info-box div
      var homeInfoBox = document.createElement('div');
      homeInfoBox.classList.add('home-info-box');
      
      // Create the home-profile-box div
      var homeProfileBox = document.createElement('div');
      homeProfileBox.classList.add('home-profile-box');
      var profileImage = document.createElement('img');
      profileImage.src = profile_url;
      profileImage.alt = '';
      homeProfileBox.appendChild(profileImage);
      
      // Create the home-name-box div
      var homeNameBox = document.createElement('div');
      homeNameBox.classList.add('home-name-box');
      var userNameLink = document.createElement('a');
      var group_name = userId;
      userNameLink.classList.add('user-name');
      userNameLink.textContent=username;
      homeNameBox.appendChild(userNameLink);
      
      homeInfoBox.appendChild(homeProfileBox);
      homeInfoBox.appendChild(homeNameBox);
      
      // Create the home-function-box div
      var homeFunctionBox = document.createElement('div');
      homeFunctionBox.classList.add('home-function-box');
      
      // Create the like-box div
      var likeBox = document.createElement('div');
      likeBox.classList.add('like-box');
      likeBox.setAttribute('data-id',postId);

      var heartIcon = document.createElement('img');
      heartIcon.src = likeIcon;
      heartIcon.alt = '';
      likeBox.appendChild(heartIcon);
      
      likeBox.addEventListener('click', function() {
        const postId = likeBox.getAttribute('data-id'); // Get the data-id attribute
        toggleLike(postId,heartIcon,likeBox);
      });
      
      // Create the like-count-box div
      var likeCountBox = document.createElement('div');
      likeCountBox.classList.add('like-count-box');
      likeCountBox.textContent = totalLikes;
      
      homeFunctionBox.appendChild(likeBox);
      homeFunctionBox.appendChild(likeCountBox);
      
      homeInfoFunctionBox.appendChild(homeInfoBox);
      homeInfoFunctionBox.appendChild(homeFunctionBox);
      
      // Create the home-description-box div
      var homeDescriptionBox = document.createElement('div');
      homeDescriptionBox.classList.add('home-description-box');
      var homePostDescription = document.createElement('div');
      homePostDescription.classList.add('home-post-description');
      homePostDescription.textContent =postDesc;
      homeDescriptionBox.appendChild(homePostDescription);
      
      // Append all elements to the home-post-container
      homePostContainer.appendChild(homeCampNameBox);
      homePostContainer.appendChild(homePostImgBox);
      homePostContainer.appendChild(homeInfoFunctionBox);
      homePostContainer.appendChild(homeDescriptionBox);
      
      // Append the home-post-container to the parent container with ID 'tab1-content'
      var parentContainer = document.getElementById('tab1-content');
      parentContainer.appendChild(homePostContainer);
    }
    // -----------------------------------------------------------------------------------------------------------
    function fetchInitialRows() {
      fetchData(initialRowsPerPage);
    }
