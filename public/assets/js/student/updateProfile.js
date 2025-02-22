const githubInput = document.getElementById('github');
const linkedinInput = document.getElementById('linkedin');
const descriptionInput = document.getElementById('description');
const skillInput = document.getElementById('skill');
const formError = document.getElementById('formError');
const saveButton = document.querySelector('button[type="submit"]');
const updateForm = document.getElementById('updateForm');

// Word count utility
function countWords(text) {
    return text.trim().split(/\s+/).filter(word => word.length > 0).length;
}

// Validate GitHub and LinkedIn URLs
function validateURL(input, platform) {
    try {
        const url = new URL(input);
        if (platform === 'GitHub' && url.hostname.includes('github.com')) {
            return true;
        }
        if (platform === 'LinkedIn' && url.hostname.includes('linkedin.com')) {
            return true;
        } 
        return false;
    } catch {
        return false;
    }
}

// Validate description word count
function validateDescription() {
    const description = descriptionInput.value;
    const wordCount = countWords(description);
    let isValid = true;

    if (wordCount > 50) {
        formError.textContent = 'Description is too long. Maximum 50 words allowed.';
        isValid = false;
    } else {
        formError.textContent = ''; // Clear the error if the description is valid
    }

    return isValid;
}

// Validate the entire form
function validateForm() {
    const isGithubValid = validateURL(githubInput.value, 'GitHub');
    const isLinkedInValid = validateURL(linkedinInput.value, 'LinkedIn');
    const isDescriptionValid = validateDescription();
    const isSkillAdded = skillInput.value.trim().length > 0;

    if (!isGithubValid) {
        formError.textContent = 'Please enter a valid GitHub profile URL.';
    } else if (!isLinkedInValid) {
        formError.textContent = 'Please enter a valid LinkedIn profile URL.';
    } else if (!isDescriptionValid) {
        // Error message handled in validateDescription
    } else {
        formError.textContent = ''; // Clear any previous error messages
    }

    // Enable/disable the save button based on validation
    saveButton.disabled = !(isGithubValid && isLinkedInValid && isDescriptionValid) && !isSkillAdded;
    return isGithubValid && isLinkedInValid && isDescriptionValid;
}

// Event listeners for form inputs
githubInput.addEventListener('input', validateForm);
linkedinInput.addEventListener('input', validateForm);
descriptionInput.addEventListener('input', validateForm);
skillInput.addEventListener('input', validateForm);

// Prevent form submission if validation fails
updateForm.addEventListener('submit', (event) => {
    if (!validateForm()) {
        event.preventDefault();
    }
});
