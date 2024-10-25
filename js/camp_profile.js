document.addEventListener("DOMContentLoaded",function(){
    console.log(g_id);

        const campData = new FormData();
        campData.append('group_id',g_id);

        fetch('../getData/getCampProfile.php', {
            method: "POST",
            body: campData
        })
        .then(response => response.json())
        .then(data => {
            console.log("Response from server:", data.message);
            console.log("Response from server:", data.group_name);
            console.log("Response from server:", data.group_icon);
            console.log("Response from server:", data.group_icon_color);

            const c_icon = document.getElementById('c_icon');
            c_icon.src = data.group_icon;
            c_icon.style.filter = data.group_icon_color;

            const c_name = document.getElementById('c_name');
            c_name.innerText=data.group_name;
        })
        .catch(error => {
            console.error("Error:", error);
        });
});