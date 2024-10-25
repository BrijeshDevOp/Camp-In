document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch data from the database
    const formData = new FormData();
    formData.append("group_id",5);
    function fetchData() {
        fetch('../getData/getGroupPosts.php',{
            method:'POST',
            body:formData
        })
            .then(response => response.json())
            .then(data => {
                data.forEach(post => {
                    addPostWithLike(post.post_id,post.username,post.profile_url,post.group_name,post.img_url,post.post_desc); // Pass additional fields
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }
  
    // Call the fetchData function to fetch and append data
    fetchData();
  });
  
  function showPostId(postId) {
    console.log('Liked Post ID:', postId);
  }
  
  function addPostWithLike(postId,username,profile_url, groupName, imageUrl,postDesc) {
    
    const container = document.getElementById('tab1-content'); // Replace 'container' with the ID of your container element
    
    const homePostCard = document.createElement('div');
    homePostCard.className = 'home-post-card';
  
    const homeCampName = document.createElement('div');
    homeCampName.className = 'home-camp-name';
    const homeCampAtBox = document.createElement('div');
    homeCampAtBox.className = 'home-camp-at-box';
    const atIcon = document.createElement('img');
    atIcon.src = '../ICONS/at.svg';
    atIcon.alt = '';
    const home_c_name = document.createElement('div');
    home_c_name.className="home_c_name";
    home_c_name.innerText = groupName;
  
    homeCampAtBox.appendChild(atIcon);
    homeCampName.appendChild(homeCampAtBox);
    homeCampName.appendChild(home_c_name);
  
    const homeImgCard = document.createElement('div');
    homeImgCard.className = 'home-img-card';
    const img1 = document.createElement('img');
    img1.src = imageUrl;
    img1.alt = '';
    homeImgCard.appendChild(img1);
  
    const homeFunctions = document.createElement('div');
    homeFunctions.className = 'home-functions';
    
    const likeBox = document.createElement('div');
    likeBox.className = 'like-box';
    likeBox.setAttribute('data-id', postId); // Set the data-id attribute
    const likeIconBox = document.createElement('div');
    likeIconBox.className = 'like-icon-box';
    const heartIcon = document.createElement('img');
    heartIcon.src = '../ICONS/heart-regular.svg';
    heartIcon.alt = '';
    likeIconBox.appendChild(heartIcon);
    const likeCountBox = document.createElement('div');
    likeCountBox.className = 'like-count-box';
    likeCountBox.innerText = '30';
    likeBox.appendChild(likeIconBox);
    likeBox.appendChild(likeCountBox);
  
    // Create the Like button and add event listener
   likeIconBox.addEventListener('click', function() {
      const postId = likeBox.getAttribute('data-id'); // Get the data-id attribute
      showPostId(postId);
    });
    // Append the Like button to the like icon box
    
    const commentBox = document.createElement('div');
    commentBox.className = 'comment-box';
    const commentIconBox = document.createElement('div');
    commentIconBox.className = 'comment-icon-box';
    const commentIcon = document.createElement('img');
    commentIcon.src = '../ICONS/comment-regular.svg';
    commentIcon.alt = '';
    commentIconBox.appendChild(commentIcon);
    const commentCountBox = document.createElement('div');
    commentCountBox.className = 'comment-count-box';
    commentCountBox.innerText = '20';
    commentBox.appendChild(commentIconBox);
    commentBox.appendChild(commentCountBox);
  
    const shareBox = document.createElement('div');
    shareBox.className = 'share-box';
  
    const reportBox = document.createElement('div');
    reportBox.className = 'report-box';
  
    homeFunctions.appendChild(likeBox);
    homeFunctions.appendChild(commentBox);
    homeFunctions.appendChild(shareBox);
    homeFunctions.appendChild(reportBox);
  
    const homeInfo = document.createElement('div');
    homeInfo.className = 'home-info';
    const userProfileBox = document.createElement('div');
    userProfileBox.className = 'user-profile-box';
    const img2 = document.createElement('img');
    img2.src =profile_url;
    img2.alt = '';
    userProfileBox.appendChild(img2);
    homeInfo.appendChild(userProfileBox);
    homeInfo.innerText = username;
  
    const homeDescription = document.createElement('div');
    homeDescription.className = 'home-description';
    homeDescription.innerText = postDesc;
  
    // Append elements to the post card
    homePostCard.appendChild(homeCampName);
    homePostCard.appendChild(homeImgCard);
    homePostCard.appendChild(homeFunctions);
    homePostCard.appendChild(homeInfo);
    homePostCard.appendChild(homeDescription);
  
    // Append the post card to the container
    container.appendChild(homePostCard);
  
  }
  
    
    