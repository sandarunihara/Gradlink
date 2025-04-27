// // Toast model
// // Error message
// function errorToast(message) {
//   localStorage.setItem("toasterrorMessage", message); // Save the error message in localStorage
//   const toastContainer = document.getElementById("toast-container");

//   // Create a new toast element
//   const toast = document.createElement("div");
//   toast.className = "toast-message";

//   // Set the message and add a close button
//   toast.innerHTML = `${message}<span class="toast-close-btn" onclick="closeToast(this, 'toasterrorMessage')">✖</span>`;

//   // Append the toast to the container
//   toastContainer.appendChild(toast);

//   // Automatically remove the toast after 5 seconds
//   setTimeout(() => {
//     toast.remove();
//     localStorage.removeItem("toasterrorMessage");
//   }, 5000);
// }

// // Success message
// function successToast(message) {
//   localStorage.setItem("toastsuccessMessage", message); // Save the success message in localStorage
//   const toastContainer = document.getElementById("toast-container");

//   // Create a new toast element
//   const toast = document.createElement("div");
//   toast.className = "toast-message-success";

//   // Set the message and add a close button
//   toast.innerHTML = `${message}<span class="toast-close-btn" onclick="closeToast(this, 'toastsuccessMessage')">✖</span>`;

//   // Append the toast to the container
//   toastContainer.appendChild(toast);

//   // Automatically remove the toast after 5 seconds
//   setTimeout(() => {
//     toast.remove();
//     localStorage.removeItem("toastsuccessMessage"); // Clear the message from localStorage after the timeout
//   }, 5000);
// }

// // Close toast function
// function closeToast(toastElement, messageType) {
//   toastElement.parentElement.remove();
//   localStorage.removeItem(messageType); // Clear the message type (error/success) from localStorage
// }

// // Display stored toasts on page load
// window.addEventListener("DOMContentLoaded", () => {
//   const errorMessage = localStorage.getItem("toasterrorMessage");
//   const successMessage = localStorage.getItem("toastsuccessMessage");

//   // Show the error toast if there's a stored error message
//   if (errorMessage) {
//     errorToast(errorMessage);
//   }

//   // Show the success toast if there's a stored success message
//   if (successMessage) {
//     successToast(successMessage);
//   }
// });






// // Toast System Controller
// const ToastSystem = (function() {
//   // Private variables
//   const activeToasts = new Set();
//   const toastContainer = document.getElementById('toast-container');

//   // Private methods
//   function createToastElement(message, type) {
//     const toastId = `toast-${Date.now()}`;
//     const toast = document.createElement('div');
//     toast.id = toastId;
//     toast.className = `toast-message toast-${type}`;
//     toast.innerHTML = `
//       ${message}
//       <span class="toast-close-btn" onclick="ToastSystem.closeToast('${toastId}', '${type}')">✖</span>
//     `;
//     return {id: toastId, element: toast};
//   }

//   function storeInLocalStorage(type, message) {
//     localStorage.setItem(`toast_${type}`, message);
//   }

//   // Public interface
//   return {
//     show: function(type, message) {
//       // Don't show duplicate toasts
//       if (activeToasts.has(type)) return;

//       // Create and show toast
//       const {id, element} = createToastElement(message, type);
//       toastContainer.appendChild(element);
//       activeToasts.add(type);
//       storeInLocalStorage(type, message);

//       // Auto-remove after 5 seconds
//       setTimeout(() => this.closeToast(id, type), 5000);
//     },

//     closeToast: function(toastId, type) {
//       const toast = document.getElementById(toastId);
//       if (toast) {
//         toast.remove();
//       }
//       localStorage.removeItem(`toast_${type}`);
//       activeToasts.delete(type);
//     },

//     init: function() {
//       // Clear existing toasts on init
//       document.querySelectorAll('.toast-message').forEach(toast => toast.remove());

//       // Load any pending toasts from localStorage
//       ['error', 'success'].forEach(type => {
//         const message = localStorage.getItem(`toast_${type}`);
//         if (message) {
//           this.show(type, message);
//         }
//       });
//     }
//   };
// })();

// // Public interface functions
// function errorToast(message) {
//   ToastSystem.show('error', message);
// }

// function successToast(message) {
//   ToastSystem.show('success', message);
// }

// // Initialize on page load
// document.addEventListener('DOMContentLoaded', function() {
//   ToastSystem.init();
// });


// Toast System
// class ToastSystem {
//   constructor() {
//     this.toastContainer = document.createElement('div');
//     this.toastContainer.className = 'toast-container';
//     document.body.appendChild(this.toastContainer);
//     this.activeToasts = new Set();
//   }

//   show(message, type, options = {}) {
//     const { autoClose = 5000, closeButton = true } = options;
//     const toastId = `toast-${Date.now()}`;

//     if (this.activeToasts.has(toastId)) return;
//     this.activeToasts.add(toastId);

//     const toast = document.createElement('div');
//     toast.id = toastId;
//     toast.className = `toast-message toast-${type}`;

//     const messageElement = document.createElement('div');
//     messageElement.textContent = message;

//     toast.appendChild(messageElement);

//     if (closeButton) {
//       const closeBtn = document.createElement('span');
//       closeBtn.className = 'toast-close-btn';
//       closeBtn.innerHTML = '✖';
//       closeBtn.onclick = () => this.removeToast(toastId);
//       toast.appendChild(closeBtn);
//     }

//     this.toastContainer.appendChild(toast);

//     // Trigger animation
//     setTimeout(() => {
//       toast.style.animation = 'slideIn 0.5s forwards';
//     }, 10);

//     if (autoClose) {
//       setTimeout(() => {
//         this.removeToast(toastId);
//       }, autoClose);
//     }
//   }

//   removeToast(toastId) {
//     const toast = document.getElementById(toastId);
//     if (toast) {
//       toast.style.animation = 'fadeOut 0.5s forwards';
//       setTimeout(() => {
//         toast.remove();
//         this.activeToasts.delete(toastId);
//       }, 500);
//     }
//   }
// }

// // Initialize toast system
// const toast = new ToastSystem();

// // Public API
// function successToast(message, options) {
//   toast.show(message, 'success', options);
// }

// function errorToast(message, options) {
//   toast.show(message, 'error', options);
// }

// // Auto-initialize on DOM load
// document.addEventListener('DOMContentLoaded', () => {
//   // This ensures the container is created even if no toasts are shown immediately
//   if (!document.querySelector('.toast-container')) {
//     new ToastSystem();
//   }
// });




class ToastSystem {
  constructor() {
    this.initializeContainer();
    this.activeToasts = new Set();
    this.checkSessionFlash();
  }

  initializeContainer() {
    this.toastContainer = document.createElement('div');
    this.toastContainer.className = 'toast-container';
    document.body.appendChild(this.toastContainer);
  }

  checkSessionFlash() {
    const flashMessage = this.getFlashFromSession();
    if (flashMessage) {
      this.show(flashMessage.message, flashMessage.type);
      this.clearFlashSession();
    }
  }

  getFlashFromSession() {
    // Check for server-injected flash message
    if (window.__flashMessage) {
      return {
        type: window.__flashMessage.type,
        message: window.__flashMessage.message
      };
    }
    return null;
  }

  clearFlashSession() {
    // Clear server-side flash message
    if (window.__flashMessage) {
      this.clearViaAJAX('/clear-flash');
      delete window.__flashMessage;
    }
  }

  clearViaAJAX(url) {
    // Optional: Send request to clear server-side flash
    if (typeof fetch !== 'undefined') {
      fetch(url, { method: 'POST' })
        .catch(error => console.error('Error clearing flash:', error));
    }
  }

  show(message, type, options = {}) {
    const { autoClose = 3000, closeButton = true } = options;
    const toastId = `toast-${Date.now()}`;

    if (this.activeToasts.has(toastId)) return;
    this.activeToasts.add(toastId);

    const toast = document.createElement('div');
    toast.id = toastId;
    toast.className = `toast-message toast-${type}`;

    const messageElement = document.createElement('div');
    messageElement.className = 'toast-content';
    messageElement.innerHTML = message;

    toast.appendChild(messageElement);

    if (closeButton) {
      const closeBtn = document.createElement('button');
      closeBtn.className = 'toast-close-btn';
      closeBtn.innerHTML = '✖';
      closeBtn.onclick = () => this.removeToast(toastId);
      toast.appendChild(closeBtn);
    }

    this.toastContainer.appendChild(toast);

    // Trigger animation
    setTimeout(() => {
      toast.style.opacity = '1';
      toast.style.transform = 'translateX(0)';
    }, 10);

    if (autoClose) {
      setTimeout(() => {
        this.removeToast(toastId);
      }, autoClose);
    }
  }

  removeToast(toastId) {
    const toast = document.getElementById(toastId);
    if (toast) {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(100%)';

      setTimeout(() => {
        toast.remove();
        this.activeToasts.delete(toastId);
      }, 500); // Match this with CSS transition duration
    }
  }
}

// Public API
const toast = new ToastSystem();

function successToast(message, options) {
  toast.show(message, 'success', options);
}

function errorToast(message, options) {
  toast.show(message, 'error', options);
}

function infoToast(message, options) {
  toast.show(message, 'info', options);
}

// Auto-initialize
if (document.readyState !== 'loading') {
  new ToastSystem();
} else {
  document.addEventListener('DOMContentLoaded', () => new ToastSystem());
}