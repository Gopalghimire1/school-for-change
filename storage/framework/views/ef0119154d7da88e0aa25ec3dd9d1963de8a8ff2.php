<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.examinations'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.examinations'); ?></a>
                <a href="<?php echo e(url('online-exam')); ?>"><?php echo app('translator')->getFromJson('lang.online_exam'); ?></a>
                <a href="<?php echo e(route('online_exam_result', [$online_exam_question->id])); ?>"><?php echo app('translator')->getFromJson('lang.result_view'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="mt-20">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.result_view'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                 <?php if(session()->has('message-success') != ""): ?>
                    <?php if(session()->has('message-success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('message-success')); ?>

                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                 <?php if(session()->has('message-danger') != ""): ?>
                    <?php if(session()->has('message-danger')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session()->get('message-danger')); ?>

                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <table id="table_id" class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.student'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.class_Sec'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.exam'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.subject'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.total_marks'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.obtained_marks'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.result'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                
                            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($student->admission_no); ?></td>
                                <td><?php echo e($student->full_name); ?></td>
                                <td><?php echo e($student->className!=""?$student->className->class_name:""); ?> (<?php echo e($student->section!=""?$student->section->section_name:""); ?>)</td>
                                <td><?php echo e($online_exam_question->title); ?></td>
                                <td><?php echo e($online_exam_question->subject!=""?$online_exam_question->subject->subject_name:""); ?></td>
                                <td><?php echo e($total_marks); ?></td>
                                <td>
                                    <?php if(in_array($student->id, $present_students)): ?>
                                        <?php
                                            $obtained_marks = App\SmOnlineExam::obtainedMarks($online_exam_question->id, $student->id);
                                            if($obtained_marks->status == 1){
                                                echo "Waiting for marks";
                                            }else{
                                                echo $obtained_marks->total_marks;
                                            }
                                        ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->getFromJson('lang.absent'); ?>
                                    <?php endif; ?>
                                    
                                </td>
                                <td>
                                    <?php if(in_array($student->id, $present_students)): ?>
                                        <?php
                                            if($obtained_marks->status == 1){
                                                echo "Waiting for marks";
                                            }else{
                                                
                                                $result = $obtained_marks->total_marks * 100 / $total_marks;
                                                if($result >= $online_exam_question->percentage){
                                                    echo "Pass";  
                                                }else{
                                                    echo "Fail";
                                                }
                                            }
                                        ?>
                                    <?php else: ?>

                                        <?php echo app('translator')->getFromJson('lang.absent'); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>