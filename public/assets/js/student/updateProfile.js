const contactInput = document.getElementById('contact');
const descriptionInput = document.getElementById('description');

const submitButton = document.getElementById('submitButton');

const updateForm = document.getElementById('updateForm');

const contactError = document.getElementById('contactError');
const descriptionError = document.getElementById('descriptionError');

// Validate contact number (10 digits)
function validateContact(contactInput) {
    const contact = contactInput.value;
    const isValid = /^\d{10}$/.test(contact);
    if (!isValid) {
        contactError.innerHTML = 'Please enter a valid 10-digit contact number.';
        contactError.style.display = 'block';
        contactInput.classList.add('invalid');
        return false;
    } else {
        contactError.innerHTML = '';
        contactError.style.display = 'none';
        contactInput.classList.remove('invalid');
        return true;
    }
}
// Word count utility
function countWords(text) {
    return text.trim().split(/\s+/).filter(word => word.length > 0).length;
}
// Validate description word count
function validateShortDescription(descriptionInput) {
    const description = descriptionInput.value;
    const wordCount = countWords(description);

    if (wordCount > 50) {
        descriptionError.textContent = 'Description should not exceed 50 words.';
        descriptionError.style.display = 'block';
        descriptionInput.classList.add('invalid');
        return false;
    } else {
        descriptionError.textContent = '';
        descriptionError.style.display = 'none';
        descriptionInput.classList.remove('invalid');
        return true;
    }
}

submitButton.addEventListener('click', function (event) {
    event.preventDefault(); // Prevent form submission

    const isContactValid = validateContact(contactInput);
    const isDescriptionValid = validateShortDescription(descriptionInput);

    if (isContactValid && isDescriptionValid) {
        updateForm.submit(); // Submit the form if all validations pass
    }
});

