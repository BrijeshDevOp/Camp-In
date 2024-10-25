
console.log('hello0000000');


document.getElementById("confirm").onclick = function(event) {
    event.preventDefault(); // Prevent form submission

    // Get the selected image file
    var selectedFile = document.getElementById("fileImg").files[0];

    if (selectedFile) {
        var formData = new FormData();
        formData.append("file", selectedFile);

        // Read the selected image file and convert it to base64
        var reader = new FileReader();
        reader.onload = function() {
            document.getElementById("imageData").value = reader.result;
            
            // Send the form data to the server using Fetch API
            fetch("../PostData/user_profile_picture.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server if needed
                console.log(data);
            })
            .catch(error => {
                console.error("Error:", error);
            });
        };
        reader.readAsDataURL(selectedFile);
    }
};



// ---------------------------------------------------------------------------------------------------------------------------------
document.getElementById("fileImg").onchange = function(){
    document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image
    
    document.getElementById("cancel").style.display = "block";
    document.getElementById("confirm").style.display = "block";
    
    document.getElementById("upload").style.display = "none";
}

var userImage = document.getElementById('image').src;
document.getElementById("cancel").onclick = function(){
    document.getElementById("image").src = userImage; // Back to previous image
    
    document.getElementById("cancel").style.display = "none";
document.getElementById("confirm").style.display = "none";

document.getElementById("upload").style.display = "block";
}

// ----------------------------------------------------------------------------------------------------------------------------------
    userId = uId;
    
    fetch(`../getData/profile_data.php?user_id=${userId}`)
      .then(response => response.json())
      .then(data => {
        console.log(`Username: ${data.username}`);
        const profile_img  = document.getElementById('image');
        profile_img.src =data.profile_url;
        console.log(profile_img);

        const profile_name = document.getElementById('user_name');
        profile_name.textContent = data.username;
        console.log(profile_name);
        const posts = document.getElementById('posts');
        console.log(posts);
        posts.textContent = data.post_count;
        const likes = document.getElementById('likes');
        likes.textContent = data.group_count;
        console.log(likes);
        const postContainer = document.getElementById('user_post_container');
        console.log(postContainer);
        console.log(`Profile URL: ${data.profile_url}`);
        console.log(`Total Posts: ${data.post_count}`);
        console.log(`Total Groups: ${data.group_count}`);
      })
      .catch(error => {
        console.error('Error fetching user data:', error);
      });
