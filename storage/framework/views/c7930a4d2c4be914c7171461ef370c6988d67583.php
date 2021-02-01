<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>New Student</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.academics'); ?></a>
                <a href="#">New Student</a>
            </div>
        </div>
    </div>
</section>

<form action="<?php echo e(route('new_student_store',[$classs_id,$section_id])); ?>" method="POST">
<?php echo csrf_field(); ?>
<div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="full">Symbol Number</label>
                <input type="number" class="form-control" name="roll">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="full">Admission Number</label>
                <input type="number" class="form-control" name="adm">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="full">Full Name*</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
        </div>
        
        <div class="col-12">
            <button class="btn btn-primary btn-sm btn-block">Save Student</button>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>