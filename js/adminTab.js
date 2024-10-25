function openAdminTab(tabName) {
    // Hide all tab contents
    switch (tabName) {
      case 'join_requests':
        const joinRequestsParentDiv = document.getElementById("join_requests");
        while (joinRequestsParentDiv.firstChild) {
          joinRequestsParentDiv.removeChild(joinRequestsParentDiv.firstChild);
        }
        getRequests();
        break;
    
      case 'add_requests':
        console.log('posts');
        const addRequestsParentDiv = document.getElementById("add_requests");
        while (addRequestsParentDiv.firstChild) {
          addRequestsParentDiv.removeChild(addRequestsParentDiv.firstChild);
        }
        getCampPostRequests();
        break;
    
      default:
        break;
    }
    

    const tabContents = document.querySelectorAll('.tab_inbox_container');
    tabContents.forEach((content) => {
      content.style.display = 'none';
    });
  
    // Show the selected tab content
    const selectedTab = document.getElementById(tabName);
    selectedTab.style.display = 'block';
  }

  document.addEventListener('DOMContentLoaded', () => {
    openAdminTab('join_requests');
  });