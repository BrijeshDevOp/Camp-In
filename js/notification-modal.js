const notifyContainer = document.getElementById('notify-modal-content');
 // Function to open the modal
 function openNotifyModal() {
    const create =  document.getElementById('create-modal');
    if(create.style.display === "block")
    {
       create.style.display = 'none';
    }
    else
    {
        document.getElementById('notify-modal').style.display = 'block';
    }
    }

    // Function to close the modal
    function closeNotifyModal() {
    document.getElementById('notify-modal').style.display = 'none';
    }

    // Attach click event listeners to open and close buttons
    document.getElementById('open-notify-modal').addEventListener('click', openNotifyModal);
    document.getElementsByClassName('close-notify-modal')[0].addEventListener('click', closeNotifyModal);

    // Close the modal when clicking on the overlay
    window.onclick = function (event) {
    const modal = document.getElementById('notify-modal');
    if (event.target === modal) {
        closeModal();
    }
};

            

const apiUrl = '../getData/notifications.php'; // Replace with the actual URL of your PHP script

// Fetch an unread notification using the Fetch API
fetch(apiUrl)
  .then(response => response.json())
  .then(data => {
    if ('message' in data && data.message === 'No notifications') {
      console.log('No notifications available');

      const message = document.createElement('div');
      message.style.textAlign="center";
      message.textContent = data.message;

      notifyContainer.appendChild(message);
    } else if ('error' in data) {
      console.error('Error:', data.error);
    } else {
        // Handle the notification data including additional data
        console.log('Notification:', data);
        
        // Extract additional data
        const username = data.username;
        const groupName = data.group_name;
        
        // Update your UI or perform actions with the notification data and additional data
        console.log('Notification:', data);
      
        const notifyBox = document.createElement('a');
        notifyBox.className = 'notify-box';
        notifyBox.href ='camp.php?g_id='+encodeURIComponent(data.group_id);
      
        const campNameDiv = document.createElement('div');
        campNameDiv.className = 'camp_name';
      
        const campImage = document.createElement('img');
        campImage.src = '../ICONS/at.svg';
        campImage.alt = 'Camp Icon';
      
        const campNameText = document.createElement('div');
        campNameText.className = 'name';
        campNameText.textContent =data.group_name;
      
        campNameDiv.appendChild(campImage);
        campNameDiv.appendChild(campNameText);
      
        const infoDiv = document.createElement('div');
        infoDiv.className = 'info';
      
        const userNameDiv = document.createElement('div');
        userNameDiv.className = 'user_name';
        userNameDiv.textContent = data.username;
      
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message';
        messageDiv.textContent = data.message;
      
        infoDiv.appendChild(userNameDiv);
        infoDiv.appendChild(messageDiv);
        notifyBox.appendChild(campNameDiv);
      
        notifyBox.appendChild(infoDiv);
      
        console.log('status '+data.is_read+' n id '+data.notification_id)
        notifyContainer.appendChild(notifyBox);
    }
  })
  .catch(error => {
    console.error('Error fetching notification:', error);
  });
