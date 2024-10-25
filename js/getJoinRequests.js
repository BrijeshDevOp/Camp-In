const group_id = g_id; // Replace with the actual group ID
const user_ID  = u_id;
console.log(g_id);
console.log(user_ID);
const url = `../getData/get_group_requests.php?group_id=${group_id}`;

function getRequests()
{
  console.log('JOIN requests called');
  fetch(url)
  .then(response => response.json())
  .then(data => {
    if ('error' in data) {
      console.error('Error fetching group requests:', data.error);
    } else {
      if (data.length === 0) {
        console.log("No pending group requests found for the specified group.");
        const joinMessageContainer = document.createElement("div");
        joinMessageContainer.className = "join-message-container";
        joinMessageContainer.style.gridTemplateColumns="1fr";
        joinMessageContainer.textContent = "No pending group requests found for the specified group.";
        const targetElement = document.getElementById("join_requests"); // Replace with your target element's ID
        targetElement.appendChild(joinMessageContainer);
      } else {
        // Display fetched data for each request
        data.forEach(request => {
          console.log("Request ID:", request.request_id);
          console.log("User ID:", request.user_id);
          console.log("Username:", request.username);
          console.log("Profile URL:", request.profile_url);
          // Display other fields as needed
          console.log("----------------------");

          setPendingRequests(request.user_id,request.username,request.profile_url);
        });
      }
    }
  })
  .catch(error => {
    console.error('Fetch API error:', error);
  });

}


function setPendingRequests(uId,uName,uProfile)
{
  const joinMessageContainer = document.createElement("div");
  joinMessageContainer.className = "join-message-container";
  
  // Create profile box
  const profileBox = document.createElement("div");
  profileBox.className = "box profile_box";

  const userProfileBox = document.createElement("div");
  userProfileBox.className = "user_profile_box";

  const profileImage = document.createElement("img");
  profileImage.src =uProfile;
  profileImage.alt = "";
  userProfileBox.appendChild(profileImage);
  profileBox.appendChild(userProfileBox);
  
  // Create name box
  const nameBox = document.createElement("div");
  nameBox.className = "box name_box";
  nameBox.textContent =uName;
  
  // Create message box
  const messageBox = document.createElement("div");
  messageBox.className = "box message_box";
  messageBox.textContent = "Wants to join your group";
  
  // Create control box
  const controlBox = document.createElement("div");
  controlBox.className = "box control_box";
  
  const cbBox1 = document.createElement("div");
  cbBox1.className = "cb box1";

  cbBox1.addEventListener('click',function ()
  {
      addMember(group_id,uId);
  });

  const addMemberIcon = document.createElement("img");
  addMemberIcon.src = "../Assets/icons/add_member.svg";
  addMemberIcon.alt = "";
  cbBox1.appendChild(addMemberIcon);
  
  const cbBox2 = document.createElement("div");
  cbBox2.className = "cb box2";

  cbBox2.addEventListener('click',function ()
  {
      removeMember(group_id,uId);
  });

  const removeMemberIcon = document.createElement("img");
  removeMemberIcon.src = "../Assets/icons/remove_member.svg";
  removeMemberIcon.alt = "";
  cbBox2.appendChild(removeMemberIcon);
  
  controlBox.appendChild(cbBox1);
  controlBox.appendChild(cbBox2);
  
  // Append all created elements to the container
  joinMessageContainer.appendChild(profileBox);
  joinMessageContainer.appendChild(nameBox);
  joinMessageContainer.appendChild(messageBox);
  joinMessageContainer.appendChild(controlBox);
  
  // Append the container to a target element on the page
  const targetElement = document.getElementById("join_requests"); // Replace with your target element's ID
  targetElement.appendChild(joinMessageContainer);
}


function addMember(gId,uId)
{
        console.log('group Id',gId,'  uId ',uId);
        
        const url = '../PostData/addMember.php';

        const formData = new FormData();
        formData.append('group_id', gId);
        formData.append('user_id',uId);

        fetch(url, {
          method: 'POST',
          body: formData
        })
          .then(response => response.json())
          .then(data => {
            // Check if the response contains a "message" field
            if ('message' in data) {
              // Display messages based on different conditions
              if (data.message === "User added as a member") {
                console.log("Membership request approved. User added as a member.");

                const parentDiv = document.getElementById("join_requests");
                while(parentDiv.firstChild)
               {
                   parentDiv.removeChild(parentDiv.firstChild);
               }
               getRequests();

              } else if (data.message === "Failed to add user as a member") {
                console.error("Failed to add user as a member.");
              } else if (data.message === "Failed to approve the membership request") {
                console.error("Failed to approve the membership request.");
              } else if (data.message === "No membership request found for the user and group") {
                console.log("No membership request found for the user and group.");
              } else {
                console.error("Unknown response message:", data.message);
              }
            } else {
              console.error('Unknown response:', data);
            }
          })
          .catch(error => {
            console.error('Fetch API error:', error);
          });
}

function removeMember(gId,uId)
{
  console.log('group Id',gId,'  uId ',uId);

  const url = '../PostData/deleteMember.php';
  
  const formData = new FormData();
  formData.append('u_id', uId);
  formData.append('g_id', gId);
  
  fetch(url, {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if ('message' in data) {
        if (data.message === "Pending group requests deleted successfully.") {
          console.log("Pending group requests deleted successfully.");

          const parentDiv = document.getElementById("join_requests");
          while(parentDiv.firstChild)
         {
             parentDiv.removeChild(parentDiv.firstChild);
         }
         getRequests();


        } else if (data.message === "Failed to delete pending group requests.") {
          console.error("Failed to delete pending group requests.");
        } else {
          console.error("Unknown response:", data.message);
        }
      } else {
        console.error('Unknown response:', data);
      }
    })
    .catch(error => {
      console.error('Fetch API error:', error);
    });  
  
}







  
