<div id="<?= $modalId ?>" class="updatemodal">
    <div class="updatemodal-content">
        <h2>Are you sure?</h2>
        <p><?= isset($message) ? htmlspecialchars($message) : 'Default message'; ?></p>
        <?php if (isset($warning)): ?>
            <p class="warning"><?= htmlspecialchars($warning) ?></p>
        <?php endif; ?>
        <div class="updatemodal-buttons">
            <button class="updateyes-btn_<?= $id?>" onclick="location.href='<?= htmlspecialchars($url) ?>'">Yes</button>
            <button class="updateno-btn_<?= $id?>" onclick="closeConfirmDeleteModal('<?= $modalId ?>')">No</button>
        </div>
    </div>
</div>

<script>
    const triggerButton_<?= $button ?> = document.getElementById('<?= $button ?>');
    const modal_<?= $modalId ?> = document.getElementById('<?= $modalId ?>');

    if (triggerButton_<?= $button ?>) {
        triggerButton_<?= $button ?>.addEventListener('click', () => {
            modal_<?= $modalId ?>.style.display = 'flex';
        });
    }

    function closeConfirmDeleteModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
</script>
