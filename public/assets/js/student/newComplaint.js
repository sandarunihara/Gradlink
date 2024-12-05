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
form.addEventListener('submit', (event) => {
    if (!validateForm()) {
        event.preventDefault();
    }
});
