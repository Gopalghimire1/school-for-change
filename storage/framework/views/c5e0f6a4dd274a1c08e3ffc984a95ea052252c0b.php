<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Schoolarship Scheme</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.fees_collection'); ?></a>
                <a href="#">Scholarship</a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area up_st_admin_visitor">
    <h4 class="text-center">List of Scholarship Scheme</h4>
        <?php if(session()->has('message-success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('message-success')); ?>

            </div>
        <?php endif; ?>
    <div class="row">
        <div class="col-md-4" >
            <div style="background:white; padding:10px; border-radius:5px;">
                <form action="<?php echo e(route('scholarship_store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="Enter title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="student">Choose Student</label>
                        <select name="student_id" class="selectpicker" data-width="auto" data-live-search="true" data-size="10" required>
                            <option value="">==== Select Student ====</option>
                           <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($stds->id); ?>"><?php echo e($stds->full_name); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">Choose Class</label>
                        <select name="class_id" class="form-control" required>
                            <option value="">=== Choose Class ===</option>
                            <?php $__currentLoopData = $class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($c->id); ?>"><?php echo e($c->class_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">Choose Fees</label>
                        <select name="fee_id" class="form-control" required>
                            <option value="">=== Choose Fee Type ===</option>
                            <?php $__currentLoopData = $fees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($f->id); ?>"><?php echo e($f->text); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Scholarship Scheme Type</label>
                        <br>
                        <input type="checkbox" name="scheme" value="1" onchange="

                        if(this.checked){
                            document.getElementById('inper').disabled = false;
                        }else{
                            document.getElementById('inper').disabled = true;
                        }
                        " id="per">
                        <label for="per">In Percentage (%)</label>
                        <br>
                        <input type="checkbox" name="scheme" onchange="
                        if(this.checked){
                            document.getElementById('inamt').disabled = false;
                        }else{
                            document.getElementById('inamt').disabled = true;
                        }
                        " id="amt">
                        <label for="amt">In Amount</label>
                      
                    </div>
                    <div class="form-group">
                        <label for="amount">In Percentage</label>
                        <input type="number" name="percentage" class="form-control" id="inper" placeholder="Enter percentage" disabled>
                    </div>
                    <div class="form-group">
                        <label for="amount">In Amount</label>
                        <input type="number" name="amount" class="form-control" id="inamt" placeholder="Enter Amount" disabled>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div style="background:white; padding:10px; border-radius:5px;">
                <table class="table table-bordered text-center">
                    <thead>
                        <th>Title</th>
                        <th>Fee Type</th>
                        <th>Amount</th>
                        <th>Percentage (%)</th>
                        <th>Student Name</th>
                        <th>Class | Lavel</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $scholarship; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($s->title); ?></td>
                                <td><?php echo e($s->fee->text); ?></td>
                                <td>Rs.<?php echo e($s->amount); ?></td>
                                <td><?php echo e($s->percentage); ?></td>
                                <td><?php echo e($s->student->full_name); ?></td>
                                <td><?php echo e($s->class->class_name); ?></td>
                                <td><a href="<?php echo e(route('scholarship_edit',$s->id)); ?>"><small>Edit</small></a> | <a href="<?php echo e(route('scholarship_delete',$s->id)); ?>" onclick="return confirm('Are you sure ?');"><small>Delete</small></a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center" style="margin-top:1rem;">
                <?php echo e($scholarship->links()); ?>

            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script> 
<script>
   
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>