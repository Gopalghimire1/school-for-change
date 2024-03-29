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

<div class="col-12" style="display: flex; justify-content: space-between;">
    
    <div>
        <span class="primary-btn small fix-gr-bg" onclick="printDiv('printdiv');">Print</span>
    </div>
</div>

<div class="white-box mt-4">
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'mark_sheet_report_multiple_student', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

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
            <div class="col-lg-3 mt-30-md" id="select_section_div" >
                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section" id="select_section" name="section">
                    <option data-display="Select section *" value="">Select section *</option>
                </select>
                <?php if($errors->has('section')): ?>
                <span class="invalid-feedback invalid-select" role="alert">
                    <strong><?php echo e($errors->first('section')); ?></strong>
                </span>
                <?php endif; ?>
            </div>
            <div class="col-lg-3 mt-30-md" id="select_student_div" style="display: none">
                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                    <option data-display="<?php echo app('translator')->getFromJson('lang.select_student'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_student'); ?> *</option>
                </select>
                <?php if($errors->has('student')): ?>
                <span class="invalid-feedback invalid-select" role="alert">
                    <strong><?php echo e($errors->first('student')); ?></strong>
                </span>
                <?php endif; ?>
            </div>

            <div class="col-lg-3 mt-30-md">
                <select class="w-100 bb niceSelect form-control" name="search_type">
                    <option value="">Select Search Type *</option>
                    <option value="0">Result List</option>
                    <option value="1">Result Marksheet</option>
                </select>
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
<div class="mt-4" id="printdiv" >

    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $std=$data['std'];
            // dd($std);
        ?>
        <div class="card-body" style="border:2px rgb(0, 0, 0) solid; padding:1rem;height:<?php echo e(env('printheight','1350px')); ?>;">
            <div class="row text-center mb-5">
                <div class="col-2">
                    <img src="<?php echo e(asset('public/logo.png')); ?>" alt="" style="width: 200px;">
                </div>
                <div class="col-10 pt-4">
                    <h3 style="font-size:28px;">
                        <strong><?php echo e($name); ?></strong>
                        <br>
                        <strong style="font-size: 20px;"><?php echo e($address); ?></strong> 
                    </h3>
                   
                    <h5 style="padding-top:20px;"> <strong>GRADE-SHEET</strong></h5>
                </div>

            </div>
            <div class="p-3">
                <h5>
                    <div class="d-flex mb-1">
                        <span>THE FOLLOWING ARE THE GRADE(S) OBTAINED BY:  </span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;"><span style="margin-left: 20px;"><?php echo e($std->full_name); ?></span></span>
                    </div>
                    <div class="d-flex mb-1">
                        <span> DATE OF BIRTH : </span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;"><span style="margin-left: 20px;"><?php echo e($std->nepali_dob); ?> BS </span></span>
                    </div>
                    <div class="mb-1" style="display: flex; justify-content: space-between">
                        <span style="flex:2;">REGISTRATION NO. : <span style="border-bottom:2px dotted black;padding:0px 25px;"><?php echo e($std->regno); ?></span></span>
                        <span style="flex:2;text-align:center;">SYMBOL NO. : <span style="border-bottom:2px dotted black;padding:0px 20px;"><?php echo e($std->roll_no); ?></span></span>
                        <span style="flex:1;text-align:right;">GRADE : <span style="border-bottom:2px dotted black;padding:0px 20px;"><?php echo e($std->class->class_name); ?></span></span>
                    </div>
                    <?php
                     $ses = \App\SmSession::where('is_default',1)->first();  
                    ?>
                    
                    <div class="d-flex mb-1">
                        <span>IN THE ANNUAL EXAMINATION CONDUCTED BY SCHOOL/CAMPUS IN </span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;"><span style="margin-left: 20px;"> <?php echo e($ses->session); ?> </span></span>
                        <span>
                            Bs
                        </span>
                    </div>
                    <span>ARE GIVEN BELOW.</span>
                </h5>
            </div>

            <div class="col-md-12">
                
            <table class="w-100 mt-30 mb-20 table table-bordered marksheet mb-5" >
                <thead>
                    <tr style="border:none;">
                        <th style="border-left:1px solid black;border-right:1px solid black;" rowspan="2">Code</th>
                        <th style="border-left:1px solid black;border-right:1px solid black; width: 300px;"  rowspan="2">Subject</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;"  rowspan="2">Credit Hour</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;" colspan="2">Obtained Grade</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;" rowspan="2">Final Grade</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;" rowspan="2">Grade Point</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;" rowspan="2">Remarks</th>
                    </tr>
                    <tr>
                        <th style="border-left:1px solid black;border-right:1px solid black;">
                            TH
                        </th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">
                            PR
                        </th>
                    </tr>
                </thead>
                
                    <tbody>

                        <?php
                            $tt=0;
                        ?>
                        <?php $__currentLoopData = $data['marks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="border:none !important;">
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;"><?php echo e($dataitem[0]->subject->subject_code); ?></td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;"><?php echo e($dataitem[0]->subject->subject_name); ?></td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;"><?php echo e(($dataitem[0]->subject->credit_hour +(isset($dataitem[1])?$dataitem[1]->subject->credit_hour:0))); ?></td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;"><?php echo e($dataitem[0]->total_gpa_grade); ?></td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;"><?php echo e(isset($dataitem[1])?$dataitem[1]->total_gpa_grade:''); ?></td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;"><?php echo e($dataitem[0]->finalgradel); ?></td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;"><?php echo e(($dataitem[0]->finalgrade)); ?></td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;"></td>
                            <?php
                                $tt+=1;
                            ?>
                        </tr>
                        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php for($i = $tt; $i < 15; $i++): ?>
                            <tr style="border:none !important;">
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                
                            </th>
                            <th>
                                Total
                            </th>
                            <th></th>
                            <th></th>
                            <th colspan="3">
                                GRADE POINT AVERAGE(GPA): <?php echo e(round($data['gpa'],2)); ?>

                            </th>
                            <th></th>
                            
                        </tr>
                    </tfoot>
            </table>
           
           
            <div style="margin-top:5rem; visibility: hidden;">hello</div>

            <div class="row mt-5">
                <div class="col-4 text-center">
                    <span style="width:200px;display:inline-block;border-bottom:1px dotted black;">

                    </span>
                    <br>
                    <span>
                        PREPARED BY
                    </span>
                    

                </div>

                <div class="col-4 text-center">
                    <span style="width:200px;display:inline-block;border-bottom:1px dotted black;">

                    </span>
                    <br>
                    <span>
                        CHECKED BY
                    </span>
                    

                </div>

                <div class="col-4 text-center">
                    <span style="width:200px;display:inline-block;border-bottom:1px dotted black;">

                    </span>
                    <br>
                    <span>
                        HEAD MASTER/CAMPUS CHIEF
                    </span>
                </div>
            </div>


            <div class="issued mt-3">
                Issued Date : <?php echo e(date('Y-m-d')); ?>

            </div>
        </div> 
        <div style="width:100%;display:inline-block;border-bottom:1px solid black;margin:2rem 0 0 0;"></div>
        <div style="padding: 5px;">
            NOTE: ONE CREDIT HOUR EQUALS 32 CLOCK HOURS. <br>
          <span>TH = THEORY</span> <span style="margin-left: 4rem;">PR = PRACTICAL</span> <span style="margin-left: 4rem;">XC = EXPELLED</span> <br>
          <span>ABS = ABSENT</span> <span style="margin-left: 4rem;">W = WITHHELD</span>
        </div>
    </div>
    <div class="fs"></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<script>
    function printDiv(id)
    {
        var divToPrint=document.getElementById(id);
        var newWin=window.open('Report','_blank');
        newWin.document.open();
        newWin.document.write('<html><head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="<?php echo e(asset("public/backEnd/css/print.css")); ?>"></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();

    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>