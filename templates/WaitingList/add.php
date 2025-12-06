<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WaitingList $waitingList
 */
?>

<div class="form-container" style="max-width: 800px; margin: 0 auto;">
    <div class="page-header">
        <h3 class="page-title">
            <i class="fas fa-clock"></i>
            Join Waiting List
        </h3>
        <?= $this->Html->link('<i class="fas fa-arrow-left"></i> Back', ['action' => 'index'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
    </div>

    <div class="form-card">
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle me-2"></i> Can't find a suitable time? Join our priority waiting list. If a slot opens up, we will notify you.
        </div>

        <?= $this->Form->create($waitingList) ?>
        
        <?php if ($user->role !== 'patient'): ?>
            <h5 class="text-uppercase text-muted small fw-bold mb-3">Patient Details</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-8">
                    <label class="form-label fw-bold">Select Patient</label>
                    <?= $this->Form->control('patient_id', [
                        'options' => $patients, 
                        'class' => 'form-select', 
                        'label' => false, 
                        'empty' => 'Choose a patient...'
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Priority Level</label>
                    <?= $this->Form->control('priority', [
                        'type' => 'select',
                        'options' => [
                            1 => '1 - Urgent', 2 => '2 - High', 3 => '3 - High',
                            4 => '4 - Medium', 5 => '5 - Normal', 6 => '6 - Normal',
                            7 => '7 - Low', 8 => '8 - Low', 9 => '9 - Low', 10 => '10 - Lowest'
                        ],
                        'class' => 'form-select',
                        'label' => false,
                        'value' => 5
                    ]) ?>
                </div>
            </div>
        <?php endif; ?>

        <h5 class="text-uppercase text-muted small fw-bold mb-3">Preferences</h5>
        
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Preferred Doctor (Optional)</label>
                <?= $this->Form->control('doctor_id', [
                    'options' => $doctors, 
                    'class' => 'form-select', 
                    'label' => false, 
                    'empty' => 'Any Available Doctor',
                    'id' => 'doctor-id'
                ]) ?>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Preferred Department (Optional)</label>
                <?= $this->Form->control('department_id', [
                    'options' => $departments, 
                    'class' => 'form-select', 
                    'label' => false, 
                    'empty' => 'Any Department',
                    'id' => 'department-id'
                ]) ?>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Preferred Date</label>
                <?= $this->Form->control('preferred_date', [
                    'type' => 'date', 
                    'class' => 'form-control', 
                    'label' => false, 
                    'min' => date('Y-m-d')
                ]) ?>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Preferred Time (Around)</label>
                <?= $this->Form->control('preferred_time', [
                    'type' => 'time', 
                    'class' => 'form-control', 
                    'label' => false, 
                    'step' => 900 
                ]) ?>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Notes / Specific Requirements</label>
            <?= $this->Form->control('notes', [
                'type' => 'textarea', 
                'class' => 'form-control', 
                'rows' => 3, 
                'label' => false, 
                'placeholder' => 'E.g., Only available on Monday mornings, urgent condition, etc.'
            ]) ?>
        </div>

        <div class="border-top pt-3 mt-4 text-end">
             <?= $this->Form->button('Join Queue', ['class' => 'btn btn-primary']) ?>
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
            if (selectedDocId && doctorMap[selectedDocId]) {
                const targetDeptId = doctorMap[selectedDocId];
                if (deptSelect.value != targetDeptId) {
                    deptSelect.value = targetDeptId;
                    flashField(deptSelect);
                }
            } 
        });

        // 2. When Department is selected -> Filter Doctor List
        deptSelect.addEventListener('change', function() {
            const selectedDeptId = this.value;
            const currentDocId = doctorSelect.value;
            
            doctorSelect.innerHTML = ''; // Clear
            
            originalDoctorOptions.forEach(option => {
                const docId = option.value;
                // Show if "Any Doctor" OR matches department
                if (!docId || !selectedDeptId || doctorMap[docId] == selectedDeptId) {
                    doctorSelect.appendChild(option);
                }
            });

            // Restore selection if valid, else reset
            if (currentDocId && doctorMap[currentDocId] != selectedDeptId && selectedDeptId) {
                doctorSelect.value = ''; 
            } else {
                doctorSelect.value = currentDocId;
            }
        });
    }

    function flashField(element) {
        const originalBg = element.style.backgroundColor;
        element.style.transition = 'background-color 0.3s';
        element.style.backgroundColor = 'rgba(0, 102, 204, 0.1)';
        setTimeout(() => { element.style.backgroundColor = originalBg; }, 500);
    }
});
</script>