<div class="tab-container">
    <div class="tab-nav">
        <a href="/Gradlink/public/PDC_coordinator/companyStatistics" 
           class="tab-item <?= basename($_SERVER['REQUEST_URI']) == 'companyStatistics' ? 'active' : '' ?>">
            <!-- <span class="tab-icon">📊</span> -->
            <span class="tab-label">Analysis</span>
        </a>
        
        <a href="/Gradlink/public/PDC_coordinator/dashboardCompany" 
           class="tab-item <?= basename($_SERVER['REQUEST_URI']) == 'dashboardCompany' ? 'active' : '' ?>">
            <!-- <span class="tab-icon">🏢</span> -->
            <span class="tab-label">Company List</span>
        </a>
        
        <a href="/Gradlink/public/PDC_coordinator/blockedCompanies" 
           class="tab-item <?= basename($_SERVER['REQUEST_URI']) == 'blockedCompanies' ? 'active' : '' ?>">
            <!-- <span class="tab-icon">⛔</span> -->
            <span class="tab-label">Blocked</span>
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