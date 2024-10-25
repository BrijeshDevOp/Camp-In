// Define the group ID you want to fetch posts for
// Construct the URL for the PHP script with the group ID as a query parameter
const groupId = g_id;
const url2 = `../getData/getPostRequests.php?group_id=${groupId}`;

function getCampPostRequests()
{
  console.log('POST requests called');

  fetch(url2)
    .then(response => response.json())
    .then(data => {
      if (data && data.length > 0) {
          console.log('Pending posts:');
          data.forEach(post => {
           
            setRequestPosts(post.post_id,post.username,post.img_url,post.post_desc,post.profile_url);
  
          });
      } else {
        console.log('No pending posts found.');
      }
    })
    .catch(error => {
      console.error('Fetch API error:', error);
    });
}

  function setRequestPosts(pId,uName,pUrl,pDesc,uUrl)
  {

const requestPostBox = document.createElement('div');
requestPostBox.className = 'request_post_box';

// Create the inner div element with class "request_post_info"
const requestPostInfo = document.createElement('div');
requestPostInfo.className = 'request_post_info';

// Create the first inner div element with classes "b" and "box1"
const bBox1 = document.createElement('div');
bBox1.className = 'b box1';

// Create the user profile image element
const userProfileBox = document.createElement('div');
userProfileBox.className = 'user_profile_box';
const userProfileImage = document.createElement('img');
userProfileImage.src =uUrl;
userProfileImage.alt = '';
userProfileBox.appendChild(userProfileImage);
bBox1.appendChild(userProfileBox);

// Create the second inner div element with classes "b" and "box2"
const bBox2 = document.createElement('div');
bBox2.className = 'b box2';
bBox2.textContent = uName;

// Append bBox1 and bBox2 to requestPostInfo
requestPostInfo.appendChild(bBox1);
requestPostInfo.appendChild(bBox2);

// Create the inner div element with class "request_post_card"
const requestPostCard = document.createElement('div');
requestPostCard.className = 'request_post_card';

// Create the post image element
const postImage = document.createElement('img');
postImage.src = pUrl;
postImage.alt = '';

// Append postImage to requestPostCard
requestPostCard.appendChild(postImage);

// Create the div element with class "request_post_desc"
const requestPostDesc = document.createElement('div');
requestPostDesc.className = 'request_post_desc';
requestPostDesc.textContent =pDesc;

// Create the div element with class "request_post_btns"
const requestPostBtns = document.createElement('div');
requestPostBtns.className = 'request_post_btns';

// Create the div element with class "btns"
const btns1 = document.createElement('div');
btns1.className = 'btns';

// Create the inner div element with classes "inner_box" and "remove_btn"
const innerBox1 = document.createElement('div');
innerBox1.className = 'inner_box';
innerBox1.id = 'remove_btn';

innerBox1.addEventListener('click',function()
{
    removeImage(pId);
});

// Create the remove icon image element
const removeIconImage = document.createElement('img');
removeIconImage.src = '../Assets/icons/remove_image.svg';
removeIconImage.alt = '';

// Append removeIconImage to innerBox1
innerBox1.appendChild(removeIconImage);
btns1.appendChild(innerBox1);

// Create the div element with class "btns"
const btns2 = document.createElement('div');
btns2.className = 'btns';

// Create the inner div element with classes "inner_box" and "add_btn"
const innerBox2 = document.createElement('div');
innerBox2.className = 'inner_box';
innerBox2.id = 'add_btn';

innerBox2.addEventListener('click',function()
{
        addImage(pId);
});

// Create the add icon image element
const addIconImage = document.createElement('img');
addIconImage.src = '../Assets/icons/add_image.svg';
addIconImage.alt = '';

// Append addIconImage to innerBox2
innerBox2.appendChild(addIconImage);
btns2.appendChild(innerBox2);

// Append btns1 and btns2 to requestPostBtns
requestPostBtns.appendChild(btns1);
requestPostBtns.appendChild(btns2);

// Append all elements to the main requestPostBox
requestPostBox.appendChild(requestPostInfo);
requestPostBox.appendChild(requestPostCard);
requestPostBox.appendChild(requestPostDesc);
requestPostBox.appendChild(requestPostBtns);

// Append requestPostBox to the desired parent element
const parentElement = document.getElementById('add_requests'); // Replace with the actual parent element
parentElement.appendChild(requestPostBox);
}


function addImage(pId)
{
    console.log('PID A',pId);
    const updateUrl = `../PostData/addImage.php`;

// Create a FormData object to send data to the PHP endpoint
const formData = new FormData();
formData.append('post_id', pId);

// Make a POST request using Fetch API
fetch(updateUrl, {
  method: 'POST',
  body: formData
})
  .then(response => response.json())
  .then(data => {
    if ('message' in data) {
      console.log(data.message);
      if(data.message === 'is_pending updated successfully.')
      {
        const parentDiv = document.getElementById("add_requests");
            while(parentDiv.firstChild)
           {
               parentDiv.removeChild(parentDiv.firstChild);
           }
           getCampPostRequests();
      }

    } else {
      console.log('Failed to update is_pending.');
    }
  })
  .catch(error => {
    console.error('Fetch API error:', error);
  });

}


function removeImage(pId)
{
  console.log('PID R',pId);
  const postId = pId; // Replace with the actual post ID
  const url = `../PostData/removeImage.php`;
  
  const formData = new FormData();
formData.append('post_id', postId);

fetch(url, {
  method: 'POST',
  body: formData
})
  .then(response => response.json())
  .then(data => {
    console.log(data.message);
    if(data.message === 'Post successfully marked as removed.')
    {
      const parentDiv = document.getElementById("add_requests");
      while(parentDiv.firstChild)
      {
       parentDiv.removeChild(parentDiv.firstChild);
      }
      getCampPostRequests();
    }
  })
  .catch(error => {
    console.error('Fetch API error:', error);
  });
}