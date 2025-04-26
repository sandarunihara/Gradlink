<div class="header-container">
    <div class="header-left">
        <h1 class="header-title"><?php echo isset($title) ? htmlspecialchars($title) : 'Default Title'; ?></h1>
        <div class="round-badge">
            <span class="round-label">Current Round</span>
            <span class="round-number"><?php echo isset($_SESSION['ROUNDID']) ? htmlspecialchars($_SESSION['ROUNDID']) : 'N/A'; ?></span>
        </div>
    </div>
</div>