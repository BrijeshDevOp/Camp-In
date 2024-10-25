 // Function to open the modal
 function openModal() {
    const notify =  document.getElementById('notify-modal');
     if(notify.style.display === "block")
     {
        notify.style.display = 'none';
     }
     else
     {
         document.getElementById('create-modal').style.display = 'block';
     }
    }

    // Function to close the modal
    function closeModal() {
    document.getElementById('create-modal').style.display = 'none';
    }

    // Attach click event listeners to open and close buttons
    document.getElementById('open-create-modal').addEventListener('click', openModal);
    document.getElementsByClassName('close-create-modal')[0].addEventListener('click', closeModal);

    // Close the modal when clicking on the overlay
    window.onclick = function (event) {
    var modal = document.getElementById('create-modal');
    if (event.target === modal) {
        closeModal();
    }
};


    function openCreateTab(tabName) {
        const tabContents = document.querySelectorAll('.create-modal-tabs');
        tabContents.forEach((content) => {
          content.style.display = 'none';
        });
      
        // Show the selected tab content
        const selectedTab = document.getElementById(tabName);
        selectedTab.style.display = 'block';
      
        // Call a function corresponding to the opened tab (replace these functions with your actual functions)
        switch (tabName) {
          case 'post-tab-content':
            functionForTab1();
            break;
          case 'create-tab-content':
            functionForTab2();
            break;
          default:
            break;
        }
      }
      
      // Functions to be called when each tab is open (replace these with your actual functions)
      function functionForTab1() {
        console.log('Tab post is open ');
      }
      
      function functionForTab2() {
       
        console.log('Tab create is open');
      }
     
      // Open the default tab (Tab 1 in this case)
      document.addEventListener('DOMContentLoaded', () => {
        openTab('tab1');
      });

      
      
      const previewImage = () => {
        console.log('function called');
        let dflt = document.getElementById("img1");
        dflt.style.display="none";
        let file = document.querySelector("#fileInput");
        let picture = document.querySelector(".picture");
        picture.style.display="block";
        picture.src = window.URL.createObjectURL(file.files[0]);
           
        //To avoid unwanted file type - validation
        
        let regex = new RegExp("[^.]+$");
        let fileExtension = file.value.match(regex);
        if (fileExtension == "jpeg" || fileExtension == "jpg" || fileExtension == "png") {
            picture.style.display="block";
        }
        else {
            picture.style.display="block";
            picture.src = "../ICONS/invalid.webp";
            console.log( picture.src);
        }
    };

    const submitBtn = document.getElementById('post');

    submitBtn.addEventListener('click', async () => {
        console.log("post clicked");
        const post_camp_name = document.getElementById("post-camp-name").value;
        const img_url = document.getElementById("fileInput");
        const img_path = img_url.files[0];
        const post_description = document.getElementById("post-description").value;
    
        const postData = new FormData();
        postData.append('c_name', post_camp_name);
        postData.append('imageFile', img_path);
        postData.append('post_desc', post_description);
    
        try {
            const response = await fetch('../PostData/upload_post.php', {
                method: 'POST',
                body: postData
            });
    
            if (response.ok) {
              const result = await response.text();
              console.log(result);
            }
            else{
              console.error('Error', response.statusText);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
    

    const cancel = () =>{
      const post_camp_name = document.getElementById("post-camp-name");
      post_camp_name.value = "";
      
      const img_url = document.getElementById("fileInput");
      img_url.value="";
      
      const image = document.getElementById("img");
      image.style.display = "none";

      const default_img = document.getElementById("img1");
      default_img.style.display = "block";

      const post_description = document.getElementById("post-description");
      post_description.value="";

    }
    
    
    // ------------------------------------------------------Create Camp-------------------------------------------------------------------------
    
    const campNext = () => {
      console.log("next");
      const checkedValues1 = Array.from(document.querySelectorAll('.toggle-checkbox1:checked'))
          .map(checkbox => checkbox.value);
      // resultDiv.textContent = 'Checked values: ' + checkedValues.join(', ');
      let c_access; // Declare c_access outside the loop
      checkedValues1.forEach(value => {
          c_access = value;
          console.log('Checked value:', c_access);
      });
  
      let c_visible; // Declare c_visible outside the loop
      const checkedValues2 = Array.from(document.querySelectorAll('.toggle-checkbox2:checked'))
          .map(checkbox => checkbox.value);
      // resultDiv.textContent = 'Checked values: ' + checkedValues.join(', ');
      checkedValues2.forEach(value => {
          c_visible = value;
          console.log('Checked value:', c_visible);
      });
  
      console.log(c_visible);
  
      const c_camp_name = document.getElementById('c_c_name').value;
      console.log(c_camp_name);
      const c_camp_description = document.getElementById('c_c_desc').value;
      console.log(c_camp_description);
  
      var url = '../PAGES/build.php?c_name='+encodeURIComponent(c_camp_name)+'&c_desc='+encodeURIComponent(c_camp_description)+'&c_access='+encodeURIComponent(c_access)+'&c_visible='+encodeURIComponent(c_visible);
  
      window.location.href = url;
    }
  
    
    const campCancel = () => {
      console.log("cancel");
    }