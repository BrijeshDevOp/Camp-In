const container = document.getElementById("tab1-content");
let currentPage = 1;
const initialRowsPerPage = 2;
const additionalRowsPerPage = 5;
const groupid = g_id;
const userid = u_id;
console.log(g_id);
console.log(u_id);
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
  fetch(`../getData/getCampData.php?page=${currentPage}&limit=${limit}&groupId=${groupid}&userId=${userid}`)
  .then(response => response.json())
  .then(data => {
    if (data.length > 0) {
      data.forEach(post => {
        addPostWithLike(post.post_id, post.user_id, post.username, post.profile_url, post.img_url, post.post_desc, post.liked, post.total_likes);
      });
      currentPage++;
    } else {
      console.log('No data found.');
    }
  })
  .catch(error => console.error('Error fetching data:', error));
}

// -----------------------------------------------------------------------------------------------------------------------
function toggleLike(postId, heartIcon, likeBox) {
    console.log(postId);
    
    const isLiked = likeBox.getAttribute('data-liked') === 'true';
    fetch('../getData/getLikeData.php', {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ postId: postId })
    })
    .then(response => response.text()).then(responseText => {
      console.log("Response Text:", responseText); // Log the response for debugging
      return JSON.parse(responseText); // Attempt to parse the JSON
    })
    .then(data => {
      // Update the like count and icon based on the response
      const likeFunctionBox = likeBox.closest('.home-function-box');
      const likeCountBox = likeFunctionBox.querySelector('.like-count-box');
    
      const newLikeCount = data.likes; // Updated like count
      likeCountBox.innerText = newLikeCount;
      
      // Update the 'data-liked' attribute based on the new status
      likeBox.setAttribute('data-liked', !isLiked);
      
      // Toggle the like icon based on the new status
      heartIcon.src = !isLiked ? '../ICONS/heart-solid.svg' : '../ICONS/heart-regular.svg';
    })
    .catch(error => {
      console.error("Error sending like:", error);
    });
  }
// -----------------------------------------------------------------------------------------------------
function addPostWithLike(postId,userId,username,profile_url,imageUrl,postDesc,liked,totalLikes) {
var homePostContainer = document.createElement('div');
homePostContainer.classList.add('home-post-container');

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
if(liked == 0)
  {
    heartIcon.src = '../ICONS/heart-regular.svg'; // Use liked attribute
  }
  else
  {
    heartIcon.src = '../ICONS/heart-solid.svg';
  }
heartIcon.alt = '';
likeBox.appendChild(heartIcon);

likeBox.addEventListener('click', function() {
    const postId = likeBox.getAttribute('data-id'); // Get the data-id attribute
    toggleLike(postId, heartIcon,likeBox);
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
// homePostContainer.appendChild(homeCampNameBox);
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
  // Fetch and display initial set of rows
fetchInitialRows();
