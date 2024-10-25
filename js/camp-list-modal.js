const modalButton = document.querySelector('#c-list');
const modalContainer = document.querySelector('.Camp-Modal');
const closeModalButton = document.getElementById('close');

modalButton.addEventListener('click', () => {
    modalContainer.style.left = '40%';
    getCampList();
});

closeModalButton.addEventListener('click', () => {
    modalContainer.style.left = '100%';
});


const clistContainer = document.getElementById('clist-container');

function getCampList()
{
  console.log('list called');
  fetch('../getData/getJoinedGroups.php?')
    .then(response => response.json())
    .then(data => {
      if (data.length > 0) {
        console.log(data);
  
        data.forEach(group => {
          const anchor = document.createElement('a');
          anchor.classList.add('camp-box');
          anchor.href = 'camp.php?g_id=' + encodeURIComponent(group.group_id);
          
          const color = group.c_theme;
          anchor.style.backgroundColor = color;
  
          const campName = document.createElement('div');
          campName.classList.add('camp_name');
          campName.textContent = group.group_name;
  
          const campIcon = document.createElement('div');
          campIcon.classList.add('camp_icon');
  
          const img = document.createElement('img');
          img.src = group.icon_url;
          img.style.filter = group.icon_color;
  
          campIcon.appendChild(img);
  
          anchor.appendChild(campName);
          anchor.appendChild(campIcon);
  
          clistContainer.appendChild(anchor);
        });
      } else {
        console.log('No groups found for the user.');
      }
    })
    .catch(error => {
      console.error('Error fetching group data:', error);
    });
}
