<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.examinations'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.examinations'); ?></a>
                <a href="<?php echo e(url('online-exam')); ?>"><?php echo app('translator')->getFromJson('lang.online_exam'); ?></a>
                <a href="<?php echo e(route("manage_online_exam_question", [$online_exam->id])); ?>"><?php echo app('translator')->getFromJson('lang.online_exam_question'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        
        <div class="row">
            <div class="col-lg-8 mt--1">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.question_list'); ?></h3>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'online_exam_question_assign',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_form'])); ?>

                <input type="hidden" name="online_exam_id" value="<?php echo e($online_exam->id); ?>">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table pb-120" cellspacing="0" width="100%">
                            <thead>
                                <?php if(session()->has('message-success') != "" ||
                                session()->get('message-danger') != ""): ?>
                                <tr>
                                    <td colspan="6">
                                        <?php if(session()->has('message-success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success')); ?>

                                        </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('message-danger')); ?>

                                        </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th width="2%">#</th>
                                    <th width="20%"><?php echo app('translator')->getFromJson('lang.group'); ?></th>
                                    <th width="20%"><?php echo app('translator')->getFromJson('lang.type'); ?></th>
                                    <th width="50"><?php echo app('translator')->getFromJson('lang.question'); ?></th>
                                    <th width="15%"><?php echo app('translator')->getFromJson('lang.marks'); ?></th>
                                    <th width="15%"><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_marks = 0; ?>
                                <?php $__currentLoopData = $question_banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question_bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $total_marks += $question_bank->mark; ?>
                                <tr class="abc">
                                    <td>
                                        <input type="checkbox" id="question<?php echo e($question_bank->id); ?>" class="common-checkbox" name="questions[]" value="<?php echo e($question_bank->id); ?>" <?php echo e(in_array($question_bank->id, $already_assigned)? 'checked': ''); ?>>
                                        <label for="question<?php echo e($question_bank->id); ?>"></label>
                                    </td>
                                    <td><?php echo e($question_bank->questionGroup !=""?$question_bank->questionGroup->title:""); ?></td>
                                    <td>
                                        <?php if($question_bank->type == "M"): ?>
                                            <?php echo e('Multiple Choice'); ?>

                                        <?php elseif($question_bank->type == "F"): ?>
                                            <?php echo e('Fill In The Blanks'); ?>

                                        <?php else: ?>
                                            <?php echo e('True False'); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($question_bank->question); ?></td>
                                    <td><?php echo e($question_bank->marks); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item modalLink" data-modal-size="modal-lg" title="View Question"  href="<?php echo e(route('view_online_question_modal', [$question_bank->id])); ?>" ><?php echo app('translator')->getFromJson('lang.view'); ?></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <!-- <tr>
                                    <td colspan="5" align="center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            save Questions
                                        </button>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12 mt-30 text-center exam-cus-btns">
                    <button class="primary-btn fix-gr-bg">
                        <span class="ti-check"></span>
                        <?php echo app('translator')->getFromJson('lang.save'); ?> <?php echo app('translator')->getFromJson('lang.questions'); ?>
                    </button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>

            <div class="col-lg-4 mt-20">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"> <?php echo app('translator')->getFromJson('lang.exam_details'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row student-details">
                    <div class="col-lg-12">
                        <div class="student-meta-box">
                            <div class=" staff-meta-top"></div>
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-meta mt-20">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        <?php echo app('translator')->getFromJson('lang.title'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        <?php echo e($online_exam->title); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        <?php echo app('translator')->getFromJson('lang.class'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        <?php echo e($online_exam->class!=""?$online_exam->class->class_name:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        <?php echo app('translator')->getFromJson('lang.section'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        <?php echo e($online_exam->section !=""?$online_exam->section->section_name:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        <?php echo app('translator')->getFromJson('lang.subject'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        <?php echo e($online_exam->subject!=""?$online_exam->subject->subject_name:""); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-meta mt-20">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        <?php echo app('translator')->getFromJson('lang.date'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                       
                                                    <?php echo e($online_exam->date != ""? App\SmGeneralSettings::DateConvater($online_exam->date):''); ?>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        <?php echo app('translator')->getFromJson('lang.time'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        <?php echo e($online_exam->start_time.' - '.$online_exam->end_time); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        <?php echo app('translator')->getFromJson('lang.passing_percentage'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        <?php echo e($online_exam->percentage); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        <?php echo app('translator')->getFromJson('lang.total_marks'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        <?php echo e($total_marks); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
        
    </div>
</section>


<div class="modal fade admin-query" id="deleteOnlineExamQuestion" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.item'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                     <?php echo e(Form::open(['url' => 'online-exam-question-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" id="online_exam_question_id">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>