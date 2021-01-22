<?php $__env->startSection('mainContent'); ?>

<?php
    function showPicName($data){
        $name = explode('/', $data);
        return $name[4];
    }
?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Exam Result</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                <a href="#">Examinations</a>
                <a href="<?php echo e(route('parent_examination', [$student_detail->id])); ?>">Exam Result</a>
            </div>
        </div>
    </div>
</section>

<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-6 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">Student Information</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <!-- Start Student Meta Information -->
                <div class="student-meta-box">
                    <div class="student-meta-top"></div>
                    <img class="student-meta-img img-100" src="<?php echo e(asset($student_detail->student_photo)); ?>" alt="">
                    <div class="white-box radius-t-y-0">
                        <div class="single-meta mt-10">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Student Name
                                </div>
                                <div class="value">
                                    <?php echo e($student_detail->first_name.' '.$student_detail->last_name); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Admission Number
                                </div>
                                <div class="value">
                                    <?php echo e($student_detail->admission_no); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Roll Number
                                </div>
                                <div class="value">
                                     <?php echo e($student_detail->roll_no); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Class
                                </div>
                                <div class="value">
                                    <?php if($student_detail->className !="" && $student_detail->session !=""): ?>
                                   <?php echo e($student_detail->className->class_name); ?> (<?php echo e($student_detail->session->session); ?>)
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Section
                                </div>
                                <div class="value">
                                    <?php echo e($student_detail->section !=""?$student_detail->section->section_name:""); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Gender
                                </div>
                                <div class="value">
                                    <?php echo e($student_detail->gender !=""?$student_detail->gender->base_setup_name:""); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Student Meta Information -->

            </div>

            <!-- Start Student Details -->
            <div class="col-lg-9">
                <div class="accordion" id="accordionExample">
                    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card">
                      <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <?php echo e($item['name']); ?>

                          </button>
                        </h2>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                          <div class="card-body">
                            <button class="btn btn-primary" onclick="
                            myWindow=window.open('','MsgWindow','width=200,height=100');
                            myWindow.document.write($('#mark').html());
                            myWindow.document.close();
                            myWindow.onafterprint=function(){
                                myWindow.close();
                            };
                            myWindow.print();
                            ">Print</button>
                            <div id="mark">

                                <table  class="w-100 mb-20 table table-bordered marksheet text-center">
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
                                        <?php
                                            $sn=1;
                                        ?>
                                        <?php $__currentLoopData = $item['results']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($sn++); ?></td>
                                                <td><?php echo e($i['subject']); ?></td>
                                                <td><?php echo e(isset($i['partial'][0])!=null?$i['partial'][0]['full']:"-"); ?></td>
                                                <td><?php echo e(isset($i['partial'][1])!=null?$i['partial'][1]['full']:"-"); ?></td>
                                                <td><?php echo e(isset($i['partial'][0])!=null?$i['partial'][0]['pass']:"-"); ?></td>
                                                <td><?php echo e(isset($i['partial'][1])!=null?$i['partial'][1]['pass']:"-"); ?></td>
                                                <td><?php echo e(isset($i['partial'][0])!=null?$i['partial'][0]['mark']:"-"); ?></td>
                                                <td><?php echo e(isset($i['partial'][1])!=null?$i['partial'][1]['mark']:"-"); ?></td>
                                                <td><?php echo e($i['total_marks']); ?></td>
                                                <td><?php echo e($i['total_gpa_grade']); ?></td>
                                                <td><?php echo e($i['total_gpa_point']); ?></td>
                                            </tr> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                  </div>  
            </div>
            <!-- End Student Details -->
        </div>

            
    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>