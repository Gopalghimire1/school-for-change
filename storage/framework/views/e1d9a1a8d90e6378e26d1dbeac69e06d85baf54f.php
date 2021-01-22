<?php $__env->startSection('mainContent'); ?>
<style>
    th{
        border: 1px solid black;
        text-align: center;
    }
    td{
        text-align: center;
    }
    td.subject-name{
        text-align: left;
        padding-left: 10px !important;
    }
    table.marksheet{
        width: 100%;
        border: 1px solid #828bb2 !important;
    }
    table.marksheet th{
        border: 1px solid #828bb2 !important;
    }
    table.marksheet td{
        border: 1px solid #828bb2 !important;
    }
    table.marksheet thead tr{
        border: 1px solid #828bb2 !important;
    }
    table.marksheet tbody tr{
        border: 1px solid #828bb2 !important;
    }

    .studentInfoTable{
        width: 100%;
        padding: 0px !important;
    }

    .studentInfoTable td{
        padding: 0px !important;
        text-align: left;
        padding-left: 15px !important;
    }
    h4{
        text-align: left !important;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.mark_sheet_report'); ?> <?php echo app('translator')->getFromJson('lang.student'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.mark_sheet_report'); ?> <?php echo app('translator')->getFromJson('lang.student'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_criteria'); ?></h3>
                    </div>
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
                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'mark_sheet_report_student', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('exam') ? ' is-invalid' : ''); ?>" name="exam">
                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_exam'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_exam'); ?> *</option>
                                    <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($exam->id); ?>" <?php echo e(isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''); ?>><?php echo e($exam->title); ?></option>
                                       
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('exam')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('exam')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?> *</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                   
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-3 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                                    <option data-display="Select section *" value="">Select section *</option>
                                </select>
                                <?php if($errors->has('section')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('section')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-3 mt-30-md" id="select_student_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_student'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_student'); ?> *</option>
                                </select>
                                <?php if($errors->has('student')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('student')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search"></span>
                                    <?php echo app('translator')->getFromJson('lang.search'); ?>
                                </button>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
</section>


<?php if(isset($is_result_available)): ?>
<?php 
    $generalSetting= App\SmGeneralSettings::find(1);
    if(!empty($generalSetting)){
        $school_name =$generalSetting->school_name;
        $site_title =$generalSetting->site_title;
        $school_code =$generalSetting->school_code;
        $address =$generalSetting->address;
        $phone =$generalSetting->phone; 
    }

?>
                  
<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30 mt-30"><?php echo app('translator')->getFromJson('lang.mark_sheet_report'); ?></h3>
                </div>
            </div>
            <div class="col-lg-8 pull-right">
                <div class="main-title">
                     <div class="print_button pull-right mt-30">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'mark-sheet-report/print', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'mark_sheet_report'])); ?>

                          <input type="hidden" name="exam" value="<?php echo e($input['exam_id']); ?>">
                          <input type="hidden" name="class" value="<?php echo e($input['class_id']); ?>">
                          <input type="hidden" name="section" value="<?php echo e($input['section_id']); ?>"> 
                          <input type="hidden" name="student" value="<?php echo e($input['student_id']); ?>"> 
                          <button type="submit" class="primary-btn small fix-gr-bg">  <i class="ti-printer"> </i> Print </button> 
                        </form> 
                    </div>  
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="single-report-admit">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex">
                                            <div>
                                                <img class="logo-img" src="<?php echo e(url($generalSetting->logo)); ?>" alt=""> 
                                            </div>
                                            <div class="ml-30">
                                                <h3 class="text-white"> <?php echo e(isset($school_name)?$school_name:'Infix School Management ERP'); ?> </h3>
                                                <p class="text-white mb-0"> <?php echo e(isset($address)?$address:'Infix School Adress'); ?> </p>
                                            </div>
                                            
                                        </div>
                                        <div>
                                            <img class="report-admit-img" src="<?php echo e(asset($studentDetails->student_photo)); ?>" width="100" height="100" alt="<?php echo e(asset($studentDetails->student_photo)); ?>">
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="offset-2 col-md-8">

                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <h4>Student Info</h4>
                                                                <table class="studentInfoTable">
                                                                    <tr>
                                                                        <td class="font-weight-bold">
                                                                            Name of Student :
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($student_detail->full_name); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font-weight-bold">
                                                                            Father's Name :
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($student_detail->parents->fathers_name); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font-weight-bold">
                                                                            Mother's Name :
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($student_detail->parents->mothers_name); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font-weight-bold">
                                                                            Roll Number :
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($student_detail->roll_no); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font-weight-bold">
                                                                            Admission Number :
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($student_detail->admission_no); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font-weight-bold">
                                                                            Date of birth :
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($student_detail->date_of_birth); ?>

                                                                        </td>
                                                                    </tr>


                                                                </table>
                                                            </td>
                                                            <td style="padding-left: 30px">
                                                                <h4>Exam Info</h4>
                                                                <table class="studentInfoTable">
                                                                    <tr>
                                                                        <td class="font-weight-bold">
                                                                            Exam Title :
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($exam_details->title); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font-weight-bold">
                                                                            Academic Class :
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($class_name->class_name); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font-weight-bold">
                                                                            Academic Section :
                                                                        </td>
                                                                        <td>
                                                                            <?php echo e($section->section_name); ?>

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                            </div>
                                        </div>
                                        <table class="w-100 mt-30 mb-20 table   table-bordered marksheet">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">S.N</th>
                                                    <th rowspan="2">Subject Name</th>
                                                    <th colspan="2">Full Marks</th>
                                                    <th colspan="2">Pass Marks</th>
                                                    <th colspan="2">Obtain Marks</th>
                                                    <th rowspan="2">Total</th>
                                                    <th rowspan="2">Letter Grade</th>
                                                    <th rowspan="2">Grade Point</th>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>Theory</th>
                                                    <th>Practical</th>
                                                    <th>Theory</th>
                                                    <th>Practical</th>
                                                    <th>Theory</th>
                                                    <th>Practical</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php $sum_gpa= 0;  $resultCount=1; $subject_count=1; $tota_grade_point=0; $this_student_failed=0; ?>
                                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <tr>
                                                    <?php
                                                        $storemarks=App\SmAssignSubject::getMarkStore($student_detail->id, $data->subject_id, $class_id, $section_id, $exam_type_id);
                                                        
                                                    ?>
                                                    <td><?php echo e($subject_count++); ?></td>
                                                    <td class="subject-name"><?php echo e($data->subject->subject_name); ?> </td>
                                                    <?php if($storemarks==null): ?>
                                                     <?php $examdata = App\SmExam::where([['class_id',$class_id],['section_id',$section_id],['subject_id',$data->subject_id],['exam_type_id',$exam_type_id]])->first(); 
                                                     $metadata = $examdata->GetExamSetup;
                                                     ?>
                                                        <td><?php echo e($metadata[0]!=null?$metadata[0]->exam_mark:"-"); ?></td>
                                                        <td><?php echo e($metadata[1]!=null?$metadata[1]->exam_mark:"-"); ?></td>
                                                        <td><?php echo e($metadata[0]!=null?$metadata[0]->passmark:"-"); ?></td>
                                                        <td><?php echo e($metadata[1]!=null?$metadata[1]->passmark:"-"); ?></td>
                                                        <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                                                    <?php else: ?>
                                                        <?php
                                                            $partialstoremarks=$storemarks->partials();
                                                            // print_r($partialstoremarks);
                                                            $count=$partialstoremarks->count();
                                                        ?>
                                                        <?php if($count==0): ?>
                                                        <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>

                                                        <?php elseif($count==1): ?>
                                                            <?php $metadata=$partialstoremarks->values()->get(0)->fullMark();?>
                                                        <td><?php echo e($metadata->exam_mark); ?></td><td>-</td>
                                                        <td><?php echo e($metadata->passmark); ?></td><td>-</td>
                                                        <td><?php echo e($partialstoremarks[0]->marks); ?></td><td>-</td>
                                                        <td><?php echo e($storemarks->total_marks); ?></td>
                                                        <td><?php echo e($storemarks->total_gpa_grade); ?></td>
                                                        <td><?php echo e($storemarks->total_gpa_point); ?></td>
                                                       
                                                        <?php else: ?>
                                                        <?php 
                                                            $metadata1=$partialstoremarks->values()->get(0)->fullMark();
                                                            $metadata2=$partialstoremarks->values()->get(1)->fullMark();
                                                        ?>
                                                        <td><?php echo e($metadata1->exam_mark); ?></td>
                                                        <td><?php echo e($metadata2->exam_mark); ?></td>
                                                        <td><?php echo e($metadata1->passmark); ?></td>
                                                        <td><?php echo e($metadata2->passmark); ?></td>
                                                        <td><?php echo e($partialstoremarks[0]->marks); ?></td>
                                                        <td><?php echo e($partialstoremarks[1]->marks); ?></td>
                                                        <td><?php echo e($storemarks->total_marks); ?></td>
                                                        <td><?php echo e($storemarks->total_gpa_grade); ?></td>
                                                        <td><?php echo e($storemarks->total_gpa_point); ?></td>
                                                        
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    
                                                </tr>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="result-date">
                                                    <?php
                                                     $data = App\SmMarkStore::select('created_at')->where([
                                                        ['student_id',$student_detail->id],
                                                        ['class_id',$class_id],
                                                        ['section_id',$section_id],
                                                        ['exam_term_id',$exam_type_id],
                                                    ])->first();

                                                    ?>
                                                    Date of Publication of Result : <b> <?php echo e(date_format(date_create($data->created_at),"F j, Y, g:i a")); ?></b>
                                                </p>
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

<?php endif; ?>
            

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>