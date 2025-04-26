    <!-- Confirmation Modal -->
    <div id="deleteConfirmationModal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p><?php echo isset($message) ? htmlspecialchars($message) : 'Default message'; ?></p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="location.href='<?php echo isset($url) ? htmlspecialchars($url) : 'Default url'; ?>'">Yes</button>
                <button class="updateno-btn" onclick="closeConfirmDeleteModal()">No</button>
            </div>
        </div>
    </div>
<script>
    // Get references to modal and buttons
    const triggerButton = document.getElementById("<?= $button ?>");
    const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    const yesButton = document.querySelector('.updateyes-btn');
    const noButton = document.querySelector('.updateno-btn');

    if (triggerButton) {
        triggerButton.addEventListener('click', () => {
            deleteConfirmationModal.style.display = 'flex';
        });
    }
    
    // Close confirmation modal when "No" button is clicked
    function closeConfirmDeleteModal() {
        deleteConfirmationModal.style.display = 'none'; // Hide modal
    }
</script>

