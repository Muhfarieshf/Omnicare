<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WaitingList $waitingList
 */
?>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 20px;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
}

.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #1f1f1f;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #0066cc;
}

/* Form Card */
.form-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    padding: 40px;
}

.section-title {
    font-size: 12px;
    font-weight: 700;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.form-group {
    margin-bottom: 24px;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #1f1f1f;
    margin-bottom: 8px;
}

.form-control, .form-select, .form-textarea {
    width: 100%;
    padding: 12px 16px;
    font-size: 14px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.8);
    transition: all 0.2s ease;
    outline: none;
    font-family: inherit;
}

.form-control:focus, .form-select:focus, .form-textarea:focus {
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
    background: white;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 24px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #0066cc, #004499);
    color: white;
    box-shadow: 0 4px 16px rgba(0, 102, 204, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0052a3, #003366);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
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
}

/* Info Box */
.info-box {
    background: rgba(0, 102, 204, 0.05);
    border: 1px solid rgba(0, 102, 204, 0.1);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 32px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
}

.info-box i {
    font-size: 24px;
    color: #0066cc;
}

.info-box-content h6 {
    margin: 0 0 4px 0;
    color: #0066cc;
    font-weight: 600;
}

.info-box-content p {
    margin: 0;
    color: #555;
    font-size: 14px;
    line-height: 1.5;
}
</style>

<div class="form-container">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-clock"></i>
            Join Waiting List
        </h1>
        <?= $this->Html->link(
            '<i class="fas fa-arrow-left"></i> Back', 
            ['action' => 'index'], 
            ['class' => 'btn btn-outline', 'escape' => false]
        ) ?>
    </div>

    <div class="form-card">
        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <div class="info-box-content">
                <h6>Can't find a suitable time?</h6>
                <p>Join our priority waiting list. If an appointment slot becomes available that matches your preferences, we will notify you immediately.</p>
            </div>
        </div>

        <?= $this->Form->create($waitingList) ?>
        
        <?php if ($user->role !== 'patient'): ?>
            <div class="section-title">Patient & Priority</div>
            
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label>Select Patient</label>
                    <?= $this->Form->control('patient_id', [
                        'options' => $patients, 
                        'class' => 'form-select', 
                        'label' => false, 
                        'empty' => 'Choose a patient...'
                    ]) ?>
                </div>
                
                <div class="form-group">
                    <label>Priority Level</label>
                    <?= $this->Form->control('priority', [
                        'type' => 'select',
                        'options' => [
                            1 => '1 - Highest (Urgent)',
                            2 => '2 - High',
                            3 => '3 - High',
                            4 => '4 - Medium-High',
                            5 => '5 - Normal',
                            6 => '6 - Normal',
                            7 => '7 - Low-Medium',
                            8 => '8 - Low',
                            9 => '9 - Low',
                            10 => '10 - Lowest'
                        ],
                        'class' => 'form-select',
                        'label' => false,
                        'value' => 5 // Default to Normal
                    ]) ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="section-title" style="margin-top: 20px;">Preferences</div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Preferred Doctor (Optional)</label>
                <?= $this->Form->control('doctor_id', [
                    'options' => $doctors, 
                    'class' => 'form-select', 
                    'label' => false, 
                    'empty' => 'Any Available Doctor'
                ]) ?>
            </div>
            <div class="form-group">
                <label>Preferred Department (Optional)</label>
                <?= $this->Form->control('department_id', [
                    'options' => $departments, 
                    'class' => 'form-select', 
                    'label' => false, 
                    'empty' => 'Any Department'
                ]) ?>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
            <div class="form-group">
                <label>Preferred Date</label>
                <?= $this->Form->control('preferred_date', [
                    'type' => 'date', 
                    'class' => 'form-control', 
                    'label' => false, 
                    'min' => date('Y-m-d')
                ]) ?>
            </div>
            <div class="form-group">
                <label>Preferred Time (Around)</label>
                <?= $this->Form->control('preferred_time', [
                    'type' => 'time', 
                    'class' => 'form-control', 
                    'label' => false, 
                    'step' => 900 // 15 min intervals
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <label>Notes / Specific Requirements</label>
            <?= $this->Form->control('notes', [
                'type' => 'textarea', 
                'class' => 'form-textarea', 
                'rows' => 3, 
                'label' => false, 
                'placeholder' => 'E.g., Only available on Monday mornings, urgent condition, etc.'
            ]) ?>
        </div>

        <div style="margin-top: 32px; text-align: right; border-top: 1px solid #eee; padding-top: 24px;">
             <?= $this->Form->button('Join Waiting List', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the mapping from PHP (ID -> DeptID)
    const doctorMap = <?= json_encode($doctorDepartments) ?>;
    
    const doctorSelect = document.getElementById('doctor-id');
    const deptSelect = document.getElementById('department-id');

    if (doctorSelect && deptSelect) {
        
        // Store original doctor options to restore them later
        const originalDoctorOptions = Array.from(doctorSelect.options);

        // 1. When Doctor is selected -> Auto-select Department
        doctorSelect.addEventListener('change', function() {
            const selectedDocId = this.value;
            
            // If a specific doctor is chosen
            if (selectedDocId && doctorMap[selectedDocId]) {
                const targetDeptId = doctorMap[selectedDocId];
                
                // Only update if it's different to avoid conflict
                if (deptSelect.value != targetDeptId) {
                    deptSelect.value = targetDeptId;
                    
                    // Trigger change event on department so filters update correctly? 
                    // No, we usually don't want to re-filter the doctor list immediately 
                    // or we might hide the doctor we just picked if logic isn't perfect.
                    // Just visual feedback is enough.
                    flashField(deptSelect);
                }
            } 
        });

        // 2. When Department is selected -> Filter Doctor List
        deptSelect.addEventListener('change', function() {
            const selectedDeptId = this.value;
            const currentDocId = doctorSelect.value;
            
            // Reset doctor dropdown
            doctorSelect.innerHTML = '';
            
            // Re-add options that match the criteria
            originalDoctorOptions.forEach(option => {
                const docId = option.value;
                
                // Always show the "Any Doctor" (empty value) option
                if (!docId) {
                    doctorSelect.appendChild(option);
                    return;
                }

                // If no department selected (Show All) OR Doctor belongs to selected department
                // Note: doctorMap[docId] might be string/int, so use loose comparison (==)
                if (!selectedDeptId || doctorMap[docId] == selectedDeptId) {
                    doctorSelect.appendChild(option);
                }
            });

            // If the previously selected doctor is no longer in the valid list, reset selection
            // (Unless it was "Any Doctor")
            if (currentDocId && doctorMap[currentDocId] != selectedDeptId && selectedDeptId) {
                doctorSelect.value = ''; 
            } else {
                // Otherwise keep the selection (it might be valid)
                doctorSelect.value = currentDocId;
            }
        });
    }

    // Helper for visual feedback
    function flashField(element) {
        const originalBg = element.style.backgroundColor;
        element.style.transition = 'background-color 0.3s';
        element.style.backgroundColor = 'rgba(0, 102, 204, 0.1)';
        setTimeout(() => {
            element.style.backgroundColor = originalBg;
        }, 500);
    }
});
</script>