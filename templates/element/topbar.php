<?php
// File: templates/element/topbar.php

$user = $this->getRequest()->getAttribute('identity');
$displayName = null;
if ($user) {
    if ($user->role === 'admin') {
        $displayName = $user->username;
    } elseif (property_exists($user, 'patient_id') && $user->patient_id && property_exists($user, 'patient') && !empty($user->patient->name)) {
        $displayName = $user->patient->name;
    } elseif (property_exists($user, 'doctor_id') && $user->doctor_id && property_exists($user, 'doctor') && !empty($user->doctor->name)) {
        $displayName = $user->doctor->name;
    } elseif (property_exists($user, 'name') && !empty($user->name)) {
        $displayName = $user->name;
    } else {
        $displayName = $user->username;
    }
}
?>

<style>
.modern-topbar {
    height: 64px;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1050;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.topbar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 24px;
    height: 100%;
    max-width: 1680px;
    margin: 0 auto;
}

.topbar-left {
    display: flex;
    align-items: center;
    gap: 20px;
}

.topbar-logo {
    display: flex;
    align-items: center;
    gap: 12px;
}

.topbar-logo a {
    text-decoration: none;
    color: #0066cc;
    font-weight: 600;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, sans-serif;
}

.topbar-logo i {
    font-size: 20px;
}

.topbar-logo a:hover {
    color: #0052a3;
    transform: scale(1.02);
}

.topbar-center {
    flex: 1;
    max-width: 500px;
    margin: 0 32px;
}

.topbar-search {
    position: relative;
    width: 100%;
}

.search-input-container {
    position: relative;
    display: flex;
    align-items: center;
}

.search-input {
    width: 100%;
    padding: 10px 16px 10px 40px;
    font-size: 14px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    transition: all 0.2s ease;
    outline: none;
    font-family: inherit;
}

.search-input:focus {
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    background: rgba(255, 255, 255, 0.95);
}

.search-icon {
    position: absolute;
    left: 12px;
    color: #666;
    font-size: 14px;
    pointer-events: none;
}

.search-submit {
    position: absolute;
    right: 4px;
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    border: none;
    border-radius: 16px;
    padding: 6px 12px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: inherit;
}

.search-submit:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    transform: scale(1.05);
}

.search-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    margin-top: 8px;
    max-height: 400px;
    overflow-y: auto;
    z-index: 1000;
    display: none;
}

.search-dropdown.show {
    display: block;
}

.search-dropdown-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s ease;
    border-bottom: 1px solid rgba(0, 0, 0, 0.03);
}

.search-dropdown-item:hover {
    background: rgba(0, 102, 204, 0.05);
    color: inherit;
    text-decoration: none;
}

.search-dropdown-item:last-child {
    border-bottom: none;
}

.search-result-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: linear-gradient(135deg, #0066cc, #004499);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;
    flex-shrink: 0;
}

.search-result-icon.success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.search-result-icon.warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.search-result-icon.danger {
    background: linear-gradient(135deg, #e11d48, #be185d);
}

.search-result-icon.info {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
}

.search-result-content {
    flex: 1;
}

.search-result-title {
    font-size: 13px;
    font-weight: 600;
    color: #1f1f1f;
    margin-bottom: 2px;
}

.search-result-subtitle {
    font-size: 11px;
    color: #666;
}

.search-result-badge {
    font-size: 10px;
    font-weight: 500;
    padding: 2px 6px;
    border-radius: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.search-result-badge.primary {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.search-result-badge.success {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.search-result-badge.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.search-result-badge.danger {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

.search-result-badge.info {
    background: rgba(6, 182, 212, 0.1);
    color: #06b6d4;
}

.search-dropdown-footer {
    padding: 12px 16px;
    text-align: center;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    background: rgba(248, 249, 250, 0.8);
}

.search-dropdown-footer a {
    color: #0066cc;
    text-decoration: none;
    font-size: 12px;
    font-weight: 500;
}

.search-dropdown-footer a:hover {
    text-decoration: underline;
}

.search-loading {
    text-align: center;
    padding: 20px;
    color: #666;
    font-size: 12px;
}

.search-no-results {
    text-align: center;
    padding: 20px;
    color: #666;
    font-size: 12px;
}

.topbar-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #666;
    font-size: 14px;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 16px;
    background: linear-gradient(135deg, #0066cc, #004499);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 14px;
    font-weight: 600;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.role-badge.admin {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

.role-badge.doctor {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.role-badge.patient {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.role-badge.staff {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.topbar-btn {
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease;
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, sans-serif;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
    cursor: pointer;
}

.topbar-btn:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.2);
}

.topbar-btn-outline {
    background: transparent;
    color: #e11d48;
    border: 1px solid #e11d48;
}

.topbar-btn-outline:hover {
    background: #e11d48;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(225, 29, 72, 0.2);
}

.topbar-btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    border: 1px solid transparent;
    box-shadow: 0 1px 3px rgba(0, 102, 204, 0.2);
}

.topbar-btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.3);
}

.menu-toggle {
    display: none;
    background: none;
    border: none;
    color: #666;
    font-size: 20px;
    cursor: pointer;
    padding: 8px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.menu-toggle:hover {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .topbar-container {
        padding: 0 16px;
    }
    
    .topbar-left {
        gap: 12px;
    }
    
    .topbar-logo a {
        font-size: 16px;
    }
    
    .topbar-center {
        display: none;
    }
    
    .user-info span {
        display: none;
    }
    
    .menu-toggle {
        display: block;
    }
    
    .topbar-btn {
        padding: 6px 12px;
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .topbar-right {
        gap: 8px;
    }
    
    .role-badge {
        display: none;
    }
}
</style>

<div class="modern-topbar">
    <div class="topbar-container">
        <div class="topbar-left">
            <button class="menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="topbar-logo">
                <?php if (!$user): ?>
                    <?= $this->Html->link(
                        '<i class="fas fa-hospital"></i><span>OmniCare</span>',
                        ['controller' => 'Pages', 'action' => 'home'],
                        ['escape' => false]
                    ) ?>
                <?php else: ?>
                    <a href="#">
                        <i class="fas fa-hospital"></i>
                        <span>OmniCare</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Search Bar (only for authenticated users) -->
        <?php if ($user): ?>
        <div class="topbar-center">
            <div class="topbar-search">
                <form class="search-input-container" action="<?= $this->Url->build(['controller' => 'Search', 'action' => 'index']) ?>" method="get">
                    <i class="fas fa-search search-icon"></i>
                    <input 
                        type="text" 
                        name="q" 
                        class="search-input" 
                        placeholder="Search patients, appointments, doctors..." 
                        autocomplete="off"
                        id="topbar-search-input"
                    >
                    <button type="submit" class="search-submit">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
                
                <div class="search-dropdown" id="search-dropdown">
                    <!-- Dynamic search results will be loaded here -->
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="topbar-right">
            <?php if ($user): ?>
                <div class="user-info">
                    <div class="user-avatar">
                        <?= strtoupper(substr($displayName, 0, 1)) ?>
                    </div>
                    <div>
                        <span style="font-weight: 600; color: #1f1f1f;">
                            <?= h($displayName) ?>
                        </span>
                        <div class="role-badge <?= $user->role ?>">
                            <?= ucfirst($user->role) ?>
                        </div>
                    </div>
                </div>
                
                <?= $this->Html->link(
                    '<i class="fas fa-sign-out-alt"></i> Logout',
                    ['controller' => 'Users', 'action' => 'logout'],
                    ['class' => 'topbar-btn topbar-btn-outline', 'escape' => false]
                ) ?>
            <?php else: ?>
                <?= $this->Html->link(
                    '<i class="fas fa-sign-in-alt"></i> Login',
                    ['controller' => 'Users', 'action' => 'login'],
                    ['class' => 'topbar-btn topbar-btn-outline', 'escape' => false]
                ) ?>
                <?= $this->Html->link(
                    '<i class="fas fa-user-plus"></i> Register',
                    ['controller' => 'Users', 'action' => 'register'],
                    ['class' => 'topbar-btn topbar-btn-primary', 'escape' => false]
                ) ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('topbar-search-input');
    const searchDropdown = document.getElementById('search-dropdown');
    let searchTimeout;
    let currentResults = [];

    if (searchInput && searchDropdown) {
        // Handle input changes
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                hideDropdown();
                return;
            }
            
            searchTimeout = setTimeout(() => {
                performQuickSearch(query);
            }, 300);
        });

        // Handle keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            const items = searchDropdown.querySelectorAll('.search-dropdown-item');
            const activeItem = searchDropdown.querySelector('.search-dropdown-item.active');
            let activeIndex = activeItem ? Array.from(items).indexOf(activeItem) : -1;

            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    activeIndex = Math.min(activeIndex + 1, items.length - 1);
                    setActiveItem(items, activeIndex);
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    activeIndex = Math.max(activeIndex - 1, -1);
                    setActiveItem(items, activeIndex);
                    break;
                case 'Enter':
                    e.preventDefault();
                    if (activeItem) {
                        window.location.href = activeItem.href;
                    } else {
                        // Submit form
                        this.closest('form').submit();
                    }
                    break;
                case 'Escape':
                    hideDropdown();
                    this.blur();
                    break;
            }
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                hideDropdown();
            }
        });

        // Focus handling
        searchInput.addEventListener('focus', function() {
            if (currentResults.length > 0) {
                showDropdown();
            }
        });
    }

    function performQuickSearch(query) {
        showLoading();
        
        fetch(`<?= $this->Url->build(['controller' => 'Search', 'action' => 'quick']) ?>?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                currentResults = data;
                displayResults(data, query);
            })
            .catch(error => {
                console.error('Search error:', error);
                showError();
            });
    }

    function displayResults(results, query) {
        if (results.length === 0) {
            showNoResults();
            return;
        }

        let html = '';
        results.forEach(result => {
            const url = result.url; // URL is already formatted correctly from SearchController
                
            html += `
                <a href="${url}" class="search-dropdown-item">
                    <div class="search-result-icon ${result.badge_class}">
                        <i class="${result.icon}"></i>
                    </div>
                    <div class="search-result-content">
                        <div class="search-result-title">${escapeHtml(result.title)}</div>
                        <div class="search-result-subtitle">${escapeHtml(result.subtitle)}</div>
                    </div>
                    <div class="search-result-badge ${result.badge_class}">
                        ${escapeHtml(result.badge)}
                    </div>
                </a>
            `;
        });

        html += `
            <div class="search-dropdown-footer">
                <a href="<?= $this->Url->build(['controller' => 'Search', 'action' => 'index']) ?>?q=${encodeURIComponent(query)}">
                    View all results for "${escapeHtml(query)}"
                </a>
            </div>
        `;

        searchDropdown.innerHTML = html;
        showDropdown();
    }

    function showLoading() {
        searchDropdown.innerHTML = '<div class="search-loading"><i class="fas fa-spinner fa-spin"></i> Searching...</div>';
        showDropdown();
    }

    function showNoResults() {
        searchDropdown.innerHTML = '<div class="search-no-results"><i class="fas fa-search"></i> No results found</div>';
        showDropdown();
    }

    function showError() {
        searchDropdown.innerHTML = '<div class="search-no-results"><i class="fas fa-exclamation-triangle"></i> Search error</div>';
        showDropdown();
    }

    function showDropdown() {
        searchDropdown.classList.add('show');
    }

    function hideDropdown() {
        searchDropdown.classList.remove('show');
    }

    function setActiveItem(items, activeIndex) {
        items.forEach((item, index) => {
            if (index === activeIndex) {
                item.classList.add('active');
                item.style.background = 'rgba(0, 102, 204, 0.1)';
            } else {
                item.classList.remove('active');
                item.style.background = '';
            }
        });
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Mobile menu toggle functionality
    const menuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.getElementById('sidebarMenu');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            if (overlay) overlay.classList.toggle('show');
        });
    }
});
</script>