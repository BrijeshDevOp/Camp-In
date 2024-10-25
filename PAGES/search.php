<!DOCTYPE html>
<html>
<head>
    <title>Search Camps</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
    <input type="text" id="searchInput" placeholder="Search...">
    <ul id="searchResults"></ul>

    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        let allData = []; // To store all the data fetched from the server

        // Function to fetch all the data from the server on page load
        function fetchAllData() {
            // Fetch data from the PHP script
            fetch('../getData/searchResults.php')
                .then(response => response.json())
                .then(data => {
                    allData = data;
                    displayResults(allData); // Display all data initially
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        fetchAllData(); // Call the function to fetch all data on page load

        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.trim().toLowerCase();

            // Filter the data based on the user's input
            const filteredResults = allData.filter(result => result.group_name.toLowerCase().includes(searchTerm));
            displayResults(filteredResults);
        });

        function displayResults(results) {
            // Clear previous search results
            searchResults.innerHTML = '';

            // Render the filtered results
            results.forEach(result => {
                const li = document.createElement('li');
                
                // Create a container for the group info
                const groupInfo = document.createElement('div');
                groupInfo.classList.add('group-info');
                
                // Create an image element
                const img = document.createElement('img');
                img.src = result.icon_url;
                img.style.filter = result.icon_color;
                // img.style.backgroundColor = result.img_color;
                
                // Create a span for the group name
                const groupName = document.createElement('span');
                groupName.textContent = result.group_name;
                
                // Append elements to the container
                groupInfo.appendChild(img);
                groupInfo.appendChild(groupName);
                
                // Append the container to the list item
                li.appendChild(groupInfo);

                li.addEventListener('click', () => {
                     navigateToGroupPage(result.group_id); // Call function to navigate to the group page
                });
                
                searchResults.appendChild(li);
            });
        }

        function navigateToGroupPage(groupId) {
                window.location.href = `camp.php?g_id=${encodeURIComponent(groupId)}`;
        }
    </script>
</body>
</html>
