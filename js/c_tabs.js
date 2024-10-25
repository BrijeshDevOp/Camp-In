function openCTab(tabName) {
    // Hide all tab contents

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
        functionForTab1();
        break;
      case 'tab2':
        functionForTab2();
        break;
      case 'tab3':
        functionForTab3();
        break;
      case 'tab4':
        functionForTab4();
        break;
      default:
        break;
    }
  }
  
  // Functions to be called when each tab is open (replace these with your actual functions)
  function functionForTab1() {
    console.log('Tab 1 is open ');
  }
  
  function functionForTab2() {
   
    console.log('Tab 2 is open');
  }
  
  function functionForTab3() {
    console.log('Tab 3 is open ');
  }

  function functionForTab4() {
    console.log('Tab 4 is open ');
  }
  
  // Open the default tab (Tab 1 in this case)
  document.addEventListener('DOMContentLoaded', () => {
    openCTab('tab1');
  });

 