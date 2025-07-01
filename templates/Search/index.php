<?php
/**
 * @var \App\View\AppView $this
 * @var string $query
 * @var array $results
 * @var object $currentUser
 */
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.search-container {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: #f8f9fa;
    min-height: 100vh;
    color: #1f1f1f;
    padding: 20px;
    max-width: 1680px;
    margin: 0 auto;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 0 32px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    margin-bottom: 32px;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #0066cc;
}

/* Search Form */
.search-form-container {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    padding: 32px;
    margin-bottom: 32px;
    transition: all 0.3s ease;
}

.search-form-container:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.search-form {
    display: flex;
    gap: 16px;
    align-items: center;
    max-width: 600px;
    margin: 0 auto;
}

.search-input {
    flex: 1;
    padding: 16px 20px;
    font-size: 16px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    transition: all 0.2s ease;
    outline: none;
    font-family: inherit;
}

.search-input:focus {
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}

.search-btn {
    padding: 16px 24px;
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: inherit;
}

.search-btn:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
}

/* Results */
.results-section {
    margin-top: 32px;
}

.results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.results-count {
    font-size: 18px;
    font-weight: 600;
    color: #1f1f1f;
}

.results-query {
    color: #0066cc;
    font-weight: 600;
}

/* Result Items */
.results-grid {
    display: grid;
    gap: 16px;
}

.result-item {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    padding: 20px;
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    display: block;
}

.result-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    color: inherit;
    text-decoration: none;
}

.result-item:focus {
    outline: 2px solid #0066cc;
    outline-offset: 2px;
}

.result-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 12px;
}

.result-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #0066cc, #004499);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
}

.result-icon.success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.result-icon.warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.result-icon.danger {
    background: linear-gradient(135deg, #e11d48, #be185d);
}

.result-icon.info {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
}

.result-content {
    flex: 1;
}

.result-title {
    font-size: 16px;
    font-weight: 600;
    color: #1f1f1f;
    margin-bottom: 4px;
}

.result-subtitle {
    font-size: 14px;
    color: #666;
    margin-bottom: 4px;
}

.result-description {
    font-size: 12px;
    color: #999;
}

.result-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.result-badge.primary {
    background: rgba(0, 102, 204, 0.1);
    color: #0066cc;
}

.result-badge.success {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.result-badge.warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.result-badge.danger {
    background: rgba(225, 29, 72, 0.1);
    color: #e11d48;
}

.result-badge.info {
    background: rgba(6, 182, 212, 0.1);
    color: #06b6d4;
}

.result-badge.secondary {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.empty-state i {
    font-size: 48px;
    color: #0066cc;
    margin-bottom: 16px;
    opacity: 0.5;
}

.empty-state h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #1f1f1f;
}

.empty-state p {
    color: #666;
    font-size: 14px;
}

/* No Query State */
.no-query-state {
    text-align: center;
    padding: 60px 20px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.search-tips {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 32px;
}

.tip-card {
    background: rgba(248, 249, 250, 0.8);
    border-radius: 8px;
    padding: 20px;
    text-align: left;
}

.tip-card h5 {
    color: #1f1f1f;
    font-weight: 600;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.tip-card p {
    color: #666;
    font-size: 14px;
    margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .search-container {
        padding: 16px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .search-form {
        flex-direction: column;
        gap: 12px;
    }
    
    .search-input {
        width: 100%;
    }
    
    .search-btn {
        width: 100%;
        justify-content: center;
    }
    
    .results-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .search-tips {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="search-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-search"></i>
            Search Results
        </h1>
    </div>

    <!-- Search Form -->
    <div class="search-form-container">
        <?= $this->Form->create(null, [
            'type' => 'get',
            'class' => 'search-form',
            'url' => ['controller' => 'Search', 'action' => 'index']
        ]) ?>
            <?= $this->Form->control('q', [
                'label' => false,
                'placeholder' => 'Search patients, appointments, doctors...',
                'value' => h($query),
                'class' => 'search-input',
                'autocomplete' => 'off'
            ]) ?>
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
                Search
            </button>
        <?= $this->Form->end() ?>
    </div>

    <!-- Results Section -->
    <?php if (!empty($query)): ?>
        <div class="results-section">
            <div class="results-header">
                <div class="results-count">
                    <?= count($results) ?> result<?= count($results) !== 1 ? 's' : '' ?> for 
                    <span class="results-query">"<?= h($query) ?>"</span>
                </div>
            </div>

            <?php if (!empty($results)): ?>
                <div class="results-grid">
                    <?php foreach ($results as $result): ?>
                        <?= $this->Html->link('
                        <div class="result-header">
                            <div class="result-icon ' . $result['badge_class'] . '">
                                <i class="' . h($result['icon']) . '"></i>
                            </div>
                            <div class="result-content">
                                <div class="result-title">' . h($result['title']) . '</div>
                                <div class="result-subtitle">' . h($result['subtitle']) . '</div>
                                <div class="result-description">' . h($result['description']) . '</div>
                            </div>
                            <div class="result-badge ' . $result['badge_class'] . '">
                                ' . h($result['badge']) . '
                            </div>
                        </div>', 
                        $result['url'], [
                            'class' => 'result-item',
                            'escape' => false
                        ]) ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <h3>No results found</h3>
                    <p>Try adjusting your search terms or searching for something else.</p>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <!-- No Query State -->
        <div class="no-query-state">
            <i class="fas fa-search" style="font-size: 48px; color: #0066cc; margin-bottom: 16px; opacity: 0.5;"></i>
            <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 8px; color: #1f1f1f;">Start Your Search</h3>
            <p style="color: #666; font-size: 14px; margin-bottom: 32px;">Enter a search term to find patients, appointments, doctors, and more.</p>
            
            <div class="search-tips">
                <?php if ($currentUser->role === 'admin'): ?>
                    <div class="tip-card">
                        <h5><i class="fas fa-users"></i> Patients</h5>
                        <p>Search by name, email, or phone number to find patient records.</p>
                    </div>
                    <div class="tip-card">
                        <h5><i class="fas fa-user-md"></i> Doctors</h5>
                        <p>Find doctors by name, specialization, or department.</p>
                    </div>
                    <div class="tip-card">
                        <h5><i class="fas fa-calendar-check"></i> Appointments</h5>
                        <p>Search appointments by patient name, doctor, or status.</p>
                    </div>
                    <div class="tip-card">
                        <h5><i class="fas fa-building"></i> Departments</h5>
                        <p>Find departments by name or description.</p>
                    </div>
                <?php elseif ($currentUser->role === 'doctor'): ?>
                    <div class="tip-card">
                        <h5><i class="fas fa-users"></i> My Patients</h5>
                        <p>Search your patients by name, email, or phone number.</p>
                    </div>
                    <div class="tip-card">
                        <h5><i class="fas fa-calendar-check"></i> My Appointments</h5>
                        <p>Find your appointments by patient name or status.</p>
                    </div>
                <?php elseif ($currentUser->role === 'patient'): ?>
                    <div class="tip-card">
                        <h5><i class="fas fa-calendar-check"></i> My Appointments</h5>
                        <p>Search your appointment history and upcoming visits.</p>
                    </div>
                    <div class="tip-card">
                        <h5><i class="fas fa-user-md"></i> My Doctors</h5>
                        <p>Find doctors you've had appointments with.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-focus search input
    const searchInput = document.querySelector('.search-input');
    if (searchInput && !searchInput.value) {
        searchInput.focus();
    }
});
</script>