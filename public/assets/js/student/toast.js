// Toast model

// Error message
function errorToast(message) {
  const toastContainer = document.getElementById("toast-container");

  // Create a new toast element
  const toast = document.createElement("div");
  toast.className = "toast-message";

  // Set the message and add a close button
  toast.innerHTML = `${message}<span class="toast-close-btn" onclick="closeToast(this, 'toasterrorMessage')">✖</span>`;

  // Append the toast to the container
  toastContainer.appendChild(toast);

  // Automatically remove the toast after 10 seconds
  setTimeout(() => {
    toast.remove();
  }, 10000);
}

// Success message
function successToast(message) {
  const toastContainer = document.getElementById("toast-container");
  
  // Create a new toast element
  const toast = document.createElement("div");
  toast.className = "toast-message-success";

  // Set the message and add a close button
  toast.innerHTML = `${message}<span class="toast-close-btn" onclick="closeToast(this, 'toastsuccessMessage')">✖</span>`;

  // Append the toast to the container
  toastContainer.appendChild(toast);

  // Automatically remove the toast after 10 seconds
  setTimeout(() => {
    toast.remove();
  }, 10000);
}

// Close toast function
function closeToast(toastElement, messageType) {
  toastElement.parentElement.remove();
}

