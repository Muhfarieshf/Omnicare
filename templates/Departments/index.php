<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI Variable', 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: #1f1f1f;
    line-height: 1.6;
    min-height: 100vh;
    padding-top: 56px; /* Account for fixed topbar */
}

/* Background Animation */
body::before {
    content: '';
    position: fixed;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: 
        radial-gradient(circle at 20% 80%, rgba(0, 102, 204, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(34, 197, 94, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(0, 0, 0, 0.02) 0%, transparent 50%);
    animation: float 20s ease-in-out infinite;
    z-index: -1;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(30px, -30px) rotate(120deg); }
    66% { transform: translate(-20px, 20px) rotate(240deg); }
}

/* Main Container */
.departments-container {
    max-width: 1680px;
    margin: 0 auto;
    padding: 40px 20px;
}

/* Page Header */
.page-header {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #0066cc, #22c55e, #0066cc);
    background-size: 200% 100%;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.page-title {
    font-size: 32px;
    font-weight: 700;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #0066cc;
    font-size: 28px;
}

/* Departments Grid */
.departments-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

/* Department Cards */
.department-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: all 0.3s ease;
    min-height: 280px;
    display: flex;
    flex-direction: column;
}

.department-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
}

.card-content {
    display: flex;
    flex: 1;
    min-height: 200px;
}

/* Icon Section */
.department-icon {
    flex: 0 0 140px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.department-icon::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0, 102, 204, 0.05) 0%, transparent 70%);
    animation: iconFloat 8s ease-in-out infinite;
}

@keyframes iconFloat {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(10px, -10px) rotate(180deg); }
}

.department-icon i {
    font-size: 48px;
    color: #0066cc;
    z-index: 1;
    position: relative;
    transition: all 0.3s ease;
}

.department-card:hover .department-icon i {
    transform: scale(1.1);
    color: #004499;
}

/* Card Info */
.card-info {
    flex: 1;
    padding: 24px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.department-name {
    font-size: 20px;
    font-weight: 600;
    color: #1f1f1f;
    margin-bottom: 12px;
    line-height: 1.3;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    gap: 6px;
    width: fit-content;
    margin-bottom: 16px;
}

.status-active {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.status-inactive {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
}

.status-badge i {
    font-size: 8px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    margin-top: auto;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: 500;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
    font-family: inherit;
    white-space: nowrap;
}

.btn:hover {
    text-decoration: none;
    transform: translateY(-1px);
}

.btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    color: white;
}

.btn-success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    box-shadow: 0 2px 8px rgba(34, 197, 94, 0.2);
}

.btn-success:hover {
    background: linear-gradient(135deg, #16a34a, #15803d);
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    color: white;
}

.btn-outline {
    background: transparent;
    color: #0066cc;
    border: 1px solid #0066cc;
}

.btn-outline:hover {
    background: #0066cc;
    color: white;
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2);
}

.btn-secondary {
    background: transparent;
    color: #6b7280;
    border: 1px solid #6b7280;
}

.btn-secondary:hover {
    background: #6b7280;
    color: white;
    box-shadow: 0 2px 8px rgba(107, 114, 128, 0.2);
}

.btn-danger {
    background: transparent;
    color: #e11d48;
    border: 1px solid #e11d48;
}

.btn-danger:hover {
    background: #e11d48;
    color: white;
    box-shadow: 0 2px 8px rgba(225, 29, 72, 0.2);
}

/* Header Actions */
.header-actions .btn {
    padding: 12px 24px;
    font-size: 14px;
}

/* Pagination */
.pagination-container {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 12px;
    padding: 24px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}

.pagination a,
.pagination span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 12px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease;
    min-width: 40px;
    height: 40px;
}

.pagination a {
    background: transparent;
    color: #0066cc;
    border: 1px solid rgba(0, 102, 204, 0.2);
}

.pagination a:hover {
    background: #0066cc;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.2);
}

.pagination .current {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    border: 1px solid #0066cc;
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.3);
}

.pagination .disabled {
    background: transparent;
    color: #ccc;
    border: 1px solid #f0f0f0;
    cursor: not-allowed;
}

.pagination-info {
    text-align: center;
    color: #666;
    font-size: 14px;
    margin: 0;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 40px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.empty-state i {
    font-size: 64px;
    color: #ccc;
    margin-bottom: 24px;
}

.empty-state h3 {
    color: #1f1f1f;
    margin-bottom: 12px;
    font-size: 24px;
    font-weight: 600;
}

.empty-state p {
    color: #666;
    margin-bottom: 24px;
    font-size: 16px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .departments-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .departments-container {
        padding: 20px 16px;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        padding: 24px;
    }
    
    .page-title {
        font-size: 24px;
    }
    
    .header-actions {
        align-self: stretch;
    }
    
    .header-actions .btn {
        width: 100%;
        justify-content: center;
    }
    
    .departments-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .department-card {
        min-height: 240px;
    }
    
    .card-content {
        min-height: 180px;
    }
    
    .department-icon {
        flex: 0 0 100px;
    }
    
    .department-icon i {
        font-size: 36px;
    }
    
    .card-info {
        padding: 20px;
    }
    
    .department-name {
        font-size: 18px;
    }
    
    .pagination {
        gap: 4px;
    }
    
    .pagination a,
    .pagination span {
        padding: 6px 10px;
        font-size: 13px;
        min-width: 36px;
        height: 36px;
    }
}

@media (max-width: 480px) {
    .card-content {
        flex-direction: column;
    }
    
    .department-icon {
        flex: 0 0 80px;
        border-radius: 0;
    }
    
    .department-icon i {
        font-size: 32px;
    }
    
    .card-info {
        padding: 16px;
    }
    
    .action-buttons {
        flex-wrap: wrap;
    }
    
    .btn {
        flex: 1;
        min-width: 80px;
    }
}

/* Loading Animation */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Card Variants for Different Department Types */
.department-card.medical::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.department-card.surgical::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(135deg, #e11d48, #be185d);
}

.department-card.diagnostic::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(135deg, #06b6d4, #0891b2);
}
</style>

<div class="departments-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-building"></i>
            <?= __('Departments') ?>
        </h1>
        <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
            <div class="header-actions">
                <?= $this->Html->link(
                    '<i class="fas fa-plus"></i> ' . __('New Department'),
                    ['action' => 'add'],
                    ['class' => 'btn btn-success', 'escape' => false]
                ) ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Departments Grid -->
    <?php if (!empty($departments)): ?>
        <div class="departments-grid">
            <?php foreach ($departments as $department): ?>
                <div class="department-card">
                    <div class="card-content">
                        <!-- Department Icon -->
                        <div class="department-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        
                        <!-- Department Info -->
                        <div class="card-info">
                            <div>
                                <h5 class="department-name">
                                    <?= h($department->name) ?>
                                </h5>
                                
                                <div class="status-badge status-<?= h($department->status) === 'active' ? 'active' : 'inactive' ?>">
                                    <i class="fas fa-circle"></i>
                                    <?= h(ucfirst($department->status)) ?>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <?= $this->Html->link(
                                    '<i class="fas fa-eye"></i>',
                                    ['action' => 'view', $department->id],
                                    [
                                        'class' => 'btn btn-outline',
                                        'escape' => false,
                                        'title' => 'View Department'
                                    ]
                                ) ?>
                                
                                <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
                                    <?= $this->Html->link(
                                        '<i class="fas fa-edit"></i>',
                                        ['action' => 'edit', $department->id],
                                        [
                                            'class' => 'btn btn-secondary',
                                            'escape' => false,
                                            'title' => 'Edit Department'
                                        ]
                                    ) ?>
                                    
                                    <?= $this->Form->postLink(
                                        '<i class="fas fa-trash"></i>',
                                        ['action' => 'delete', $department->id],
                                        [
                                            'method' => 'delete',
                                            'confirm' => __('Are you sure you want to delete # {0}?', $department->id),
                                            'class' => 'btn btn-danger',
                                            'escape' => false,
                                            'title' => 'Delete Department'
                                        ]
                                    ) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="empty-state">
            <i class="fas fa-building"></i>
            <h3>No Departments Found</h3>
            <p>No departments have been created yet.</p>
            <?php if (!isset($currentUser) || ($currentUser->role !== 'doctor' && $currentUser->role !== 'patient')): ?>
                <?= $this->Html->link(
                    '<i class="fas fa-plus"></i> Create First Department',
                    ['action' => 'add'],
                    ['class' => 'btn btn-primary', 'escape' => false]
                ) ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Pagination -->
    <?php if (!empty($departments)): ?>
        <div class="pagination-container">
            <div class="pagination">
                <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
                <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
                <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
            </div>
            <p class="pagination-info">
                <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
            </p>
        </div>
    <?php endif; ?>
</div>

<script>
// Enhanced interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to action buttons
    const actionButtons = document.querySelectorAll('.btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.href && !this.href.includes('#')) {
                this.classList.add('loading');
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                
                // Restore original content if navigation is cancelled
                setTimeout(() => {
                    if (this.classList.contains('loading')) {
                        this.classList.remove('loading');
                        this.innerHTML = originalContent;
                    }
                }, 3000);
            }
        });
    });
    
    // Enhanced delete confirmation
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add visual feedback during confirmation
            this.style.background = '#dc2626';
            this.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                this.style.background = '';
                this.style.transform = '';
            }, 200);
        });
    });
    
    // Smooth scroll to top after pagination
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function() {
            setTimeout(() => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }, 100);
        });
    });
    
    // Add keyboard navigation for cards
    const departmentCards = document.querySelectorAll('.department-card');
    departmentCards.forEach((card, index) => {
        card.setAttribute('tabindex', '0');
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const viewButton = card.querySelector('.btn-outline');
                if (viewButton) {
                    viewButton.click();
                }
            }
        });
    });
    
    // Animate cards on scroll (intersection observer)
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Initially hide cards and observe them
    departmentCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `all 0.3s ease ${index * 0.1}s`;
        observer.observe(card);
    });
});
</script>