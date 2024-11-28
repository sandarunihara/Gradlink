const descriptionInput = document.getElementById('description');
const topicInput = document.getElementById('topic');
const descriptionError = document.getElementById('descriptionError');
const descriptionValidMessage = document.getElementById('descriptionValidMessage');
const topicError = document.getElementById('topicError');
const submitButton = document.getElementById('submitButton');
const form = document.getElementById('descriptionForm');

// Function to count words
function countWords(text) {
    return text.trim().split(/\s+/).filter(word => word.length > 0).length;
}

//validate description
function validateDescription() {
    const description = descriptionInput.value;
    const wordCount = countWords(description);
    let isValid = true;

    // Only show errors if the user is typing in the description field
    if (wordCount < 50) {
        descriptionError.textContent = `Description is too short. Minimum 50 words required.`;
        descriptionValidMessage.textContent = '';
        descriptionError.style.display = 'block';
        descriptionError.style.color = 'red';
        isValid = false;
    } else {
        descriptionError.textContent = '';
        descriptionValidMessage.textContent = `Description is valid.`;
        descriptionValidMessage.style.display = 'block';
        descriptionValidMessage.style.color = 'green';
    }
    return isValid;
}
//validate topic
function validateTopic() {
    const topic = topicInput.value;
    const topicRegex = /^[A-Za-z\s]+$/; // Regular expression to match letters and spaces only
    let isValid = true;

    // Only show errors if the user is typing in the topic field
    if (topic.trim() === '') {
        topicError.textContent = 'Topic is required.';
        topicError.style.display = 'block';
        topicError.style.color = 'red';
        isValid = false;
    } else if (!topicRegex.test(topic)) {
        topicError.textContent = 'Topic must only contain alphabetical characters and spaces.';
        topicError.style.display = 'block';
        topicError.style.color = 'red';
        isValid = false;
    } else {
        topicError.textContent = '';
    }

    return isValid;
}
//validate form
function validateForm() {
    const isDescriptionValid = validateDescription();
    const isTopicValid = validateTopic();
    if(isTopicValid && isDescriptionValid){
        submitButton.disabled = false;
    }
    return isDescriptionValid && isTopicValid;
}
//clear form js
function clearForm() {
    // Reset form fields
    topicInput.value = '';
    descriptionInput.value = '';
    descriptionError.textContent = '';
    descriptionValidMessage.textContent = '';
    topicError.textContent = '';
    submitButton.disabled = true; // Disable the submit button after clearing
}
descriptionInput.addEventListener('input', () => {
    validateDescription();
    validateForm();
});
topicInput.addEventListener('input', () => {
    validateTopic();
    validateForm();
});
// Prevent form submission if validation fails
form.addEventListener('submit', (event) => {
    if (!validateForm()) {
        event.preventDefault();
    }
});
