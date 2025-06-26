<div class="row justify-content-center" style="margin-top: 50px;">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Patient Registration</h4>
            </div>
            <div class="card-body">
                <?= $this->Form->create() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('first_name', [
                                    'class' => 'form-control',
                                    'placeholder' => 'First Name',
                                    'required' => true,
                                    'label' => 'First Name'
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('last_name', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Last Name',
                                    'required' => true,
                                    'label' => 'Last Name'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('username', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Choose a username',
                                    'required' => true,
                                    'label' => 'Username'
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('email', [
                                    'type' => 'email',
                                    'class' => 'form-control',
                                    'placeholder' => 'your.email@example.com',
                                    'required' => true,
                                    'label' => 'Email'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('password', [
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'placeholder' => 'Choose a strong password',
                                    'required' => true,
                                    'label' => 'Password',
                                    'minlength' => 6
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('confirm_password', [
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'placeholder' => 'Confirm your password',
                                    'required' => true,
                                    'label' => 'Confirm Password'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('gender', [
                                    'type' => 'select',
                                    'options' => [
                                        'Male' => 'Male',
                                        'Female' => 'Female',
                                        'Other' => 'Other'
                                    ],
                                    'empty' => 'Select Gender',
                                    'class' => 'form-select',
                                    'required' => true,
                                    'label' => 'Gender'
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $this->Form->control('dob', [
                                    'type' => 'date',
                                    'class' => 'form-control',
                                    'required' => true,
                                    'label' => 'Date of Birth'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <?= $this->Form->control('contact_number', [
                            'class' => 'form-control',
                            'placeholder' => 'Your phone number',
                            'required' => true,
                            'label' => 'Contact Number'
                        ]) ?>
                    </div>
                    
                    <div class="d-grid">
                        <?= $this->Form->submit('Register', ['class' => 'btn btn-success']) ?>
                    </div>
                <?= $this->Form->end() ?>
                
                <div class="text-center mt-3">
                    <p class="mb-0">Already have an account? 
                        <?= $this->Html->link('Login here', ['action' => 'login'], ['class' => 'text-decoration-none']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add password confirmation validation
document.addEventListener('DOMContentLoaded', function() {
    const password = document.querySelector('input[name="password"]');
    const confirmPassword = document.querySelector('input[name="confirm_password"]');
    
    function validatePassword() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Passwords do not match');
        } else {
            confirmPassword.setCustomValidity('');
        }
    }
    
    password.addEventListener('change', validatePassword);
    confirmPassword.addEventListener('keyup', validatePassword);
});
</script>
