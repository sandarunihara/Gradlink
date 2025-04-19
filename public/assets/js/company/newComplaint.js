// Select elements
const topicInput = document.getElementById('topic');
const descriptionInput = document.getElementById('description');
const errorMessage = document.getElementById('errorMessage');
const form = document.getElementById('form');

// Validate form function
function validateForm() {
    const topic = topicInput.value.trim();
    const description = descriptionInput.value.trim();
    let isValid = true;

    // Clear previous error messages
    errorMessage.textContent = '';

    // Validate topic
    if (topic === '') {
        errorMessage.textContent = 'Topic is required.';
        errorMessage.style.color = 'red';
        isValid = false;
    }

    // Validate description
    if (description === '') {
        errorMessage.textContent = errorMessage.textContent 
            ? `${errorMessage.textContent} Description is required.` 
            : 'Description is required.';
        errorMessage.style.color = 'red';
        isValid = false;
    }

    return isValid;
}

// Clear form fields
function clearForm() {
    topicInput.value = '';
    descriptionInput.value = '';
    errorMessage.textContent = '';
}


// Prevent form submission if validation fails

function openRecruitConfirmModal(event) {
    event.preventDefault();
    if (!validateForm()) {
        event.preventDefault();
        
    }else{
        document.getElementById('Recruit-modal').style.display = 'flex';
    }
}
// Submits the form after confirmation
function confirmAction() {
    // Submit the form
    document.getElementById('Recruit-modal').style.display = 'none';
    document.getElementById('loading-overlay').style.display = 'flex'; // Show loader
    setTimeout(() => {
        document.getElementById('form').submit();
    }, 300); // slight delay to show animation before form submit
}

function closeRecruitConfirmModal() {
    document.getElementById('Recruit-modal').style.display = 'none';
}
