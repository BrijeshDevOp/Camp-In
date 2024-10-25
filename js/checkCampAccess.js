    const formData = new FormData();
    formData.append('u_id', u_id);
    formData.append('g_id', g_id);

  
    fetch('../getData/checkCampAccess.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      // Handle the JSON response data
      console.log(data.message);
      console.log(data.visibility);

      if(data.message =="is not a member")
      {
        if(data.visibility == 1)
        {
            const joinBtn  = document.getElementById('join-box');
            joinBtn.style.display = 'block';
        }
        else
        {
          document.getElementById('tab1-content').style.display = 'none';
          document.getElementById('control-box').style.display = 'none';
          document.getElementById('popupModal').style.display = 'block';
        }
      } 
    })
    .catch(error => {
      console.error('Error:', error);
    });
  