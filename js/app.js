function showTab(tabId) {
    const tabContents = document.querySelectorAll('.tabs');
    for (const content of tabContents) {
        if (content.id === tabId) {
            content.classList.add('active');
        } else {
            content.classList.remove('active');
        }
    }
}

showTab('tab1Content');

document.getElementById('tab1Button').addEventListener('click', () => {
    showTab('tab1Content');
    // Individual function for Tab 1
    console.log("Function for Tab 1 is executed.");
});

document.getElementById('tab2Button').addEventListener('click', () => {
    showTab('tab2Content');
    // Individual function for Tab 2
    console.log("Function for Tab 2 is executed.");
});

document.getElementById('tab4Button').addEventListener('click', () => {
    showTab('tab4Content');
    // Individual function for Tab 4
    console.log("Function for Tab 4 is executed.");
});

const modalButton = document.querySelector('#clist_show_btn');
const modalContainer = document.querySelector('.side_bar');
const closeModalButton = document.getElementById('closeModalButton');

modalButton.addEventListener('click', () => {
    modalContainer.style.left = '48%';
});

closeModalButton.addEventListener('click', () => {
    modalContainer.style.left = '100%';
});

const modalOverlay = document.getElementById('modalOverlay');
const modalContent = document.getElementById('modalContent');
const openModalBtn = document.getElementById('tab3Button');
const closeModalBtn = document.getElementById('closeModalBtn');
const cancelBtn = document.getElementById('cancelBtn');
const modalForm = document.getElementById('modalForm');
const textInput = document.getElementById('textInput');

openModalBtn.addEventListener('click', () => {
    modalOverlay.classList.add('active');
    modalContent.classList.add('active');
    textInput.value = ''; // Clear the text input when the modal opens
});

closeModalBtn.addEventListener('click', () => {
    modalOverlay.classList.remove('active');
    modalContent.classList.remove('active');
});

cancelBtn.addEventListener('click', () => {
    modalOverlay.classList.remove('active');
    modalContent.classList.remove('active');
});

modalOverlay.addEventListener('click', (event) => {
    if (event.target === modalOverlay) {
        modalOverlay.classList.remove('active');
        modalContent.classList.remove('active');
    }
});

modalForm.addEventListener('submit', (event) => {
    event.preventDefault();
    // Handle form submission here
    console.log('Submitted Text:', textInput.value);
    textInput.value = ''; // Clear the text input after form submission
    modalOverlay.classList.remove('active');
    modalContent.classList.remove('active');
});