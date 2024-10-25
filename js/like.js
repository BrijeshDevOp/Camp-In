function toggleLike(postId, heartIcon, likeBox) {
    console.log('like called');
    fetch('../getData/getLikeData.php', {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ postId: postId })
        })
        .then(response => response.text()).then(responseText => {
          // console.log("Response Text:", responseText); // Log the response for debugging
          return JSON.parse(responseText); // Attempt to parse the JSON
        })
        .then(data => {
          // Update the like count and icon based on the response
          const likeFunctionBox = likeBox.closest('.home-function-box');
          const likeCountBox = likeFunctionBox.querySelector('.like-count-box');
          
          const newLikeCount = data.likes; // Updated like count
          likeCountBox.innerText = newLikeCount;
          heartIcon.src = data.likeIcon;
        })
        .catch(error => {
          console.error("Error sending like:", error);
        });
}