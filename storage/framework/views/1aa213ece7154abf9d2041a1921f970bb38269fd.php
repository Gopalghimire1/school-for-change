<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.exam'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.examinations'); ?></a>
                <a href="/exam-type"><?php echo app('translator')->getFromJson('lang.exam'); ?></a>
                <a href="/exam-marks-setup/<?php echo e($exam->id); ?>"><?php echo e($exam->title); ?></a>

            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="white-box">
        <h1 class="text-center">
        <?php echo e($exam->title); ?>

        </h1>
    </div>
    <?php
        $haspermission=in_array(215, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ;
    ?>
    <?php if($haspermission): ?>
        <form class="white-box mt-4" action="<?php echo e(url('exam')); ?>" method="POST" enctype="multipart/form-data" onsubmit='return checkfornull()'>
           <?php echo csrf_field(); ?>
            <div class="row">
                <input type="hidden" name="exams_types[]" value="<?php echo e($exam->id); ?>"/>

                <div class="col-md-6">
                    <select class="w-100 bb niceSelect form-control" name="class_ids" id="exam_class" required>
                        <option data-display="select class *">select class *</option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>"><?php echo e($class->class_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-6" id="exam_subejct">
                    
                </div>
               
            </div>

            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box mt-10">
                        <div class="row">
                             <div class="col-lg-10">
                                <div class="main-title">
                                    <h2>Marks Distribution </h2>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addRowMark();" id="addRowBtn">
                                <span class="ti-plus pr-2"></span></button>
                            </div>
                        </div>
                        <hr>

                        <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <?php endif; ?>


                        <table class="table" id="productTable">
                            <thead>
                                <tr>
                                  <th>Title</th>
                                  <th>Fullmarks</th>
                                  <th>Passmarks</th>
                                  <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr id="row1" class="mt-40">
                                <td class="border-top-0">
                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">  
                                    <div class="input-effect">
                                        <input class="primary-input form-control<?php echo e($errors->has('exam_title') ? ' is-invalid' : ''); ?>"
                                            type="text" id="exam_title" name="exam_title[]" autocomplete="off" value="<?php echo e(isset($editData)? $editData->exam_title : 'Theory'); ?>" required  />
                                            <label><?php echo app('translator')->getFromJson('lang.title'); ?></label>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="input-effect">
                                        <input class="primary-input form-control exam_mark"
                                        type="number" id="exam_mark" name="exam_mark[]" autocomplete="off"   value="<?php echo e(isset($editData)? $editData->exam_mark : 0); ?>" required />
                                    </div>
                                </td> 
                                <td>
                                    <div class="input-effect">
                                        <input class="primary-input form-control exam_pass_mark"
                                        type="number" id="exam_pass_mark" name="exam_pass_mark[]" autocomplete="off"   value="<?php echo e(isset($editData)? $editData->pass : 0); ?>" required />
                                    </div>
                                </td>
                                <td class="border-top">
                                     <button class="primary-btn icon-only fix-gr-bg" type="button">
                                         <span class="ti-trash"></span>
                                    </button>
                                   
                                </td>
                                </tr>
                                <tfoot>
                                    <tr>
                                       <td class="border-top-0"><?php echo app('translator')->getFromJson('lang.total'); ?></td>

                                       <td class="border-top-0" id="totalMark">
                                         <input type="text" class="primary-input form-control" id="i-totalmark" value="0" name="totalmark" readonly="true" required />
                                       </td>
                                       <td class="border-top-0" id="totalPassMark">
                                        <input type="text" class="primary-input form-control" id="i-totalpassmark" value="0" name="totalpassmark" readonly="true" required />
                                      </td>
                                       <td class="border-top-0"></td>
                                   </tr>
                                  
                               </tfoot>
                           </tbody>
                        </table>
                    </div>
                    <hr>
                    <button class="btn btn-primary btn-block"> Save Item </button>
                </div>
            </div>
        </form>
    <?php else: ?>
    <div class="white-box">
        <h1 class="text-center">
            You Don't have permissionn to manage Exams
        </h1>
    </div>
    <?php endif; ?>

    <div class="col-lg-12" style="margin-top:3rem;">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.exam'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                    <thead>
                                <?php if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != ""): ?>
                                <tr>
                                    <td colspan="7">
                                        <?php if(session()->has('message-success-delete')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success-delete')); ?>

                                        </div>
                                        <?php elseif(session()->has('message-danger-delete')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('message-danger-delete')); ?>

                                        </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('lang.sl'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.exam_title'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.class'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.section'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.subject'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.total_mark'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.mark_distribution'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                                </tr>
                    </thead>

                    <tbody>
                    <?php $count =1 ; ?>
                                <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($count++); ?></td>

                                    <td><?php echo e($exam->GetExamTitle !=""?$exam->GetExamTitle->title:""); ?></td>
                                    <td><?php echo e($exam->getClassName !=""?$exam->getClassName->class_name:""); ?></td>
                                    <td><?php echo e($exam->GetSectionName !=""?$exam->GetSectionName->section_name:""); ?></td>
                                    <td><?php echo e($exam->GetSubjectName !=""?$exam->GetSubjectName->subject_name:""); ?></td>
                                    <td><?php echo e($exam->exam_mark); ?></td>

                                   <td>
                                        <?php $mark_distributions = App\SmExam::getMarkDistributions($exam->exam_type_id, $exam->class_id,  $exam->section_id, $exam->subject_id);  ?>                                  
                                      


                                        <?php $__currentLoopData = $exam->GetExamSetup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                           <div class="col-sm-6"> <?php echo e($row->exam_title); ?> </div> <div class="col-sm-4"><b> <?php echo e($row->exam_mark); ?> </b></div> 
                                       </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>


                                            <?php 

                                                $registered = App\SmExam::getMarkREgistered($exam->exam_type_id, $exam->class_id, $exam->section_id, $exam->subject_id);
                                                    

                                            ?>
                                                <?php if($registered == ""): ?>


                                            <div class="dropdown-menu dropdown-menu-right">

                                                

                                                <?php if(in_array(397, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                    <a class="dropdown-item"
                                                        href="<?php echo e(url('exam', $exam->id)); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                                 <?php endif; ?>

                                                <?php if(in_array(216, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 ): ?>

                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteExamModal<?php echo e($exam->id); ?>"
                                                        href="#"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                                 <?php endif; ?>
                                                 

                                            </div>
                                            <?php endif; ?>
                                        </div> 


                                    </td>
                                </tr>
                                    <div class="modal fade admin-query" id="deleteExamModal<?php echo e($exam->id); ?>" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.exam'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                                                         <?php echo e(Form::open(['url' => 'exam/'.$exam->id, 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                                                        <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                                                         <?php echo e(Form::close()); ?>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        
        function checkfornull(){
            var q=true;
          if($("#exam_class").val()=='select class *'){
            toastr.error("Please Select a class");
            $("#exam_class").focus();
            q= false;  
          }
            var tfm=parseFloat($("#i-totalmark").val());
            var tpm=parseFloat($("#i-totalpassmark").val());
            if(tfm<=0 || tpm<=0 || tfm==undefined || tpm==undefined){
                toastr.error("Please Insert All Data");
                q= false;
            }

            var fms=document.querySelectorAll('.exam_mark');
            fms.forEach(element => {
                var fm=parseFloat( element.value);
                if(fm<=0|| fm==undefined){
                    toastr.error("Please Insert Full Marks");
                    element.focus();
                    q= false;
                }
            });

            var pms=document.querySelectorAll('.exam_pass_mark');
            pms.forEach(element => {
                var pm= parseFloat( element.value);
                if(pm<=0|| pm==undefined){
                    toastr.error("Please Insert Pass Marks");
                    element.focus();
                    q= false;
                }
            });

            var checked=false;
            var cs=document.querySelectorAll('.subject-checkbox');
            cs.forEach(element => {
                if(element.checked){
                    checked=true;
                }
            });
            if(!checked){
                toastr.error("Please Select At least One Subject");
                q= false;
            }
            

            return q;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>