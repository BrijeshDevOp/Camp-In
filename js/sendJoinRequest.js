 
      function sendRequest()
      {
          console.log(g_id);
          console.log("sennt request");
          const joinData = new FormData();
          joinData.append('group_id',g_id);
      
          fetch('../postData/sendJoinRequest.php', {
              method: "POST",
              body: joinData
          })
          .then(response => response.json())
          .then(data => {
              console.log("Response from server:", data.message);
              if(data.status == 'success')
              {
                  const jbtn = document.getElementById('jbtn-m');
                  const jbtnMain = document.getElementById('join-btn');
                  const jbtnComputed = window.getComputedStyle(jbtn); 
                  const jbtnBox = document.getElementById('jbtn-box');
                  const sendSx = document.createElement('p');
                if(jbtnComputed.display === 'block')
                {
                    jbtn.style.display = 'none';
                    console.log(data.status)
                    console.log('function called');
                    sendSx.classList.add('sendSxMessg');
                    sendSx.textContent =data.message;
                    jbtnBox.appendChild(sendSx);
                }
                else
                {
                    jbtnMain.textContent = data.message;
                }
              }
              console.log("Response from server:", data.message);
          })
          .catch(error => {
              console.error("Error:", error);
          });
    }

    