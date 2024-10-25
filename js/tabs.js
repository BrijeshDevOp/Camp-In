function openTab(tabName) {
    const notify =  document.getElementById('notify-modal');
    const create = document.getElementById('create-modal');
    if(notify.style.display === "block" || create.style.display === "block")
    {
       notify.style.display = 'none';
       create.style.display = 'none';

       console.log("modal-closed");
    }
    
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach((content) => {
      content.style.display = 'none';
    });
  
    // Show the selected tab content
    const selectedTab = document.getElementById(`${tabName}-content`);
    selectedTab.style.display = 'block';
  
    // Call a function corresponding to the opened tab (replace these functions with your actual functions)
    switch (tabName) {
      case 'tab1':
        fetchInitialRows();
        break;
      case 'tab2':
        fetchInitialRows2();
        break;
      case 'tab3':
        functionForTab3();
        break;
      default:
        break;
    }
  }
  
  // Functions to be called when each tab is open (replace these with your actual functions)
  function functionForTab2() {
    console.log('Tab 2 is open');
  }
  function functionForTab3() {
    console.log('Tab 3 is open ');
  }