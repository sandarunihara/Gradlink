<!-- Tabs Section -->
<div class="tab-container">
    <div class="tab-nav">
        <a href="/Gradlink/public/PDC_coordinator/dashboardAdvertisement/active" 
           class="tab-item <?= basename($_SERVER['REQUEST_URI']) == 'active' ? 'active' : '' ?>">
            <!-- <span class="tab-icon">📊</span> -->
            <span class="tab-label">Active Advertisements</span>
        </a>
        
        <a href="/Gradlink/public/PDC_coordinator/dashboardAdvertisement/deactive" 
           class="tab-item <?= basename($_SERVER['REQUEST_URI']) == 'deactive' ? 'active' : '' ?>">
            <!-- <span class="tab-icon">🏢</span> -->
            <span class="tab-label">Deactive Advertisements</span>
        </a>

        <a href="/Gradlink/public/PDC_coordinator/dashboardAdvertisement/pending" 
           class="tab-item <?= basename($_SERVER['REQUEST_URI']) == 'pending' ? 'active' : '' ?>">
            <!-- <span class="tab-icon">⛔</span> -->
            <span class="tab-label">Pending Advertisements</span>
        </a>

        <a href="/Gradlink/public/PDC_coordinator/dashboardAdvertisement/rejected" 
           class="tab-item <?= basename($_SERVER['REQUEST_URI']) == 'rejected' ? 'active' : '' ?>">
            <!-- <span class="tab-icon">⛔</span> -->
            <span class="tab-label">Rejected Advertisements</span>
        </a>
        
        <div class="tab-indicator"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-button");
    
    // Add ripple effect to buttons
    tabs.forEach(tab => {
        tab.addEventListener("click", function(e) {
            // Remove active class from all buttons
            tabs.forEach(t => t.classList.remove("active"));
            
            // Add active class to clicked button
            this.classList.add("active");
            
            // Create ripple effect
            const ripple = document.createElement("span");
            ripple.classList.add("ripple-effect");
            this.appendChild(ripple);
            
            // Position ripple
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${e.clientX - rect.left - size/2}px`;
            ripple.style.top = `${e.clientY - rect.top - size/2}px`;
            
            // Remove ripple after animation
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});
</script>