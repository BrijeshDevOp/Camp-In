function getGroupInfo()
{
   
    const formData = new FormData();
    formData.append("g_id",g_id); 
    fetch("../getData/getGroupInfo.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response from server:", data.group_name);
        const group_icon = document.getElementById('group-icon');
        group_icon.src = data.icon_url;
        group_icon.style.filter = data.icon_color;
        const group_name = document.getElementById('profile-link');
        group_name.textContent = data.group_name;
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

getGroupInfo();