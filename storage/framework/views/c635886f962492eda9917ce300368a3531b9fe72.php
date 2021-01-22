<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Dormitory </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                <a href="<?php echo e(route('student_dormitory')); ?>">Dormitory</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <?php if(isset($room_list)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('room-list')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    add
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"> Dormitory Room List</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table  class="display school-table school-table-style" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>DORMITORY</th>
                                    <th>Room NAME</th>
                                    <th>ROOM TYPE</th>
                                    <th>NO. OF BED</th>
                                    <th>COST PER BED</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $room_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $rowCount=0; ?>
                                    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($rowCount==0): ?>
                                        <td rowspan="<?php echo e($values->count()); ?>"><?php echo e($room_list->dormitory != ""? $room_list->dormitory->dormitory_name:''); ?></td>
                                        <?php endif; ?>
                                        <?php $rowCount=$rowCount+1; ?>
                                        <td><?php echo e($room_list->name); ?></td>
                                        <td><?php echo e($room_list->roomType != ""? $room_list->roomType->type: ''); ?></td>
                                        <td><?php echo e($room_list->number_of_bed); ?></td>
                                        <td><?php echo e($room_list->cost_per_bed); ?></td>
                                        <td>
                                            <?php if($student_detail->room_id == $room_list->id): ?>
                                                <button class="primary-btn small fix-gr-bg">
                                                    Assigned                                                
                                                </button>
                                             <?php else: ?>
                                              
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>