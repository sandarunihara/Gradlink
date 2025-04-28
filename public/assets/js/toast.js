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