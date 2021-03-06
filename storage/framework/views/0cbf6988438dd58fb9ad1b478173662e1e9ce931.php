<?php $__env->startSection('mainContent'); ?>

<?php
    function showPicName($data){
        $name = explode('/', $data);
        if(!empty($name[4])){

        return $name[4];
        }else{
            return '';
        }
    }
?>

<?php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   ?> 

<section class="student-details">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-3">
                <!-- Start Student Meta Information -->
                <div class="main-title">
                    <h3 class="mb-20">Student Profile</h3>
                </div>
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
                                   <?php echo e($student_detail->className != ""? $student_detail->className->class_name:''); ?> (<?php echo e($student_detail->session != ""? $student_detail->session->session:''); ?>)
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Section
                                </div>
                                <div class="value">
                                    <?php echo e($student_detail->section != ""? $student_detail->section->section_name:""); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Gender
                                </div>
                                <div class="value">
                                    <?php echo e($student_detail->gender!= ""? $student_detail->gender->base_setup_name:""); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Student Meta Information -->

                <!-- Start Siblings Meta Information -->
                <div class="main-title mt-40">
                    <h3 class="mb-20">Sibling Information</h3>
                </div>
                <?php $__currentLoopData = $siblings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sibling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($sibling->id != $student_detail->id): ?>
                    <div class="student-meta-box mb-20">
                        <div class="student-meta-top siblings-meta-top"></div>
                        <img class="student-meta-img img-100" src="<?php echo e(asset($sibling->student_photo)); ?>" alt="">
                        <div class="white-box radius-t-y-0">
                            <div class="single-meta mt-10">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Sibling Name
                                    </div>
                                    <div class="value">
                                        <?php echo e($sibling->full_name); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Admission Number
                                    </div>
                                    <div class="value">
                                        <?php echo e($sibling->admission_no); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Roll Number
                                    </div>
                                    <div class="value">
                                        <?php echo e($sibling->roll_no); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Class
                                    </div>
                                    <div class="value">
                                       <?php echo e($sibling->className !=""?$sibling->className->class_name:""); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Section
                                    </div>
                                    <div class="value">
                                        <?php echo e($sibling->section !=""?$sibling->section->section_name:""); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="single-meta">
                                <div class="d-flex justify-content-between">
                                    <div class="name">
                                        Gender
                                    </div>
                                    <div class="value">
                                        <?php echo e($sibling->gender !=""?$sibling->gender->base_setup_name:""); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- End Siblings Meta Information -->
            </div>

            <!-- Start Student Details -->
            <div class="col-lg-9">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#studentProfile" role="tab" data-toggle="tab">profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentFees" role="tab" data-toggle="tab">fees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentExam" role="tab" data-toggle="tab">exam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentDocuments" role="tab" data-toggle="tab">documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#studentTimeline" role="tab" data-toggle="tab">timeline</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Start Profile Tab -->
                    <div role="tabpanel" class="tab-pane fade  show active" id="studentProfile">
                        <div class="white-box">
                            <h4 class="stu-sub-head">Personal info</h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Admission Date
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                           
<?php echo e($student_detail->admission_date != ""? App\SmGeneralSettings::DateConvater($student_detail->admission_date):''); ?>



                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            Date of birth
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            
<?php echo e($student_detail->date_of_birth != ""? App\SmGeneralSettings::DateConvater($student_detail->date_of_birth):''); ?>



                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            Type
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            <?php echo e($student_detail->category != ""? $student_detail->category->catgeory_name:""); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            Religion
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            <?php echo e($student_detail->religion != ""? $student_detail->religion->base_setup_name:""); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            Phone Number
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            <?php echo e($student_detail->mobile); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            Email Address
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            <?php echo e($student_detail->email); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            Present Address
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                           <?php echo e($student_detail->current_address); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="">
                                            Permanent Address
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-7">
                                        <div class="">
                                            <?php echo e($student_detail->permanent_address); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Start Parent Part -->
                            <h4 class="stu-sub-head mt-40">Parent / Guardian Details</h4>
                            <div class="d-flex">
                                <div class="mr-20 mt-20">
                                    <img class="student-meta-img img-100" src="<?php echo e($student_detail->parents != ""? asset($student_detail->parents->fathers_photo):""); ?>" alt="">
                                </div>
                                <div class="w-100">
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Father’s Name
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""? $student_detail->parents->fathers_name:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Occupation
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""? $student_detail->parents->fathers_occupation:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Phone Number
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""? $student_detail->parents->fathers_mobile:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="mr-20 mt-20">
                                    <img class="student-meta-img img-100" src="<?php echo e($student_detail->parents != ""? asset($student_detail->parents->mothers_photo):""); ?>" alt="">
                                </div>
                                <div class="w-100">
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Mother’s Name
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""? $student_detail->parents->mothers_name:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Occupation
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""?$student_detail->parents->mothers_occupation:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Phone Number
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""?$student_detail->parents->mothers_mobile:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="mr-20 mt-20">
                                    <img class="student-meta-img img-100" src="<?php echo e($student_detail->parents != ""?asset($student_detail->parents->guardians_photo):""); ?>" alt="">
                                </div>
                                <div class="w-100">
                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Guardian’s Name
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""?$student_detail->parents->guardians_mobile:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Email Address
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""?$student_detail->parents->guardians_email:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Phone Number
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""?$student_detail->parents->guardians_phone:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Relation with Guardian
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""?$student_detail->parents->guardians_relation:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Occupation
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""?$student_detail->parents->guardians_occupation:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-info">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="">
                                                    Guardian’s Address
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-md-7">
                                                <div class="">
                                                    <?php echo e($student_detail->parents != ""?$student_detail->parents->guardians_address:""); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Parent Part -->

                            <!-- Start Transport Part -->
                            <h4 class="stu-sub-head mt-40">Transport and Dormitory Details</h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Route
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e($student_detail->route != ""? $student_detail->route->title: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Vehicle Number
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e($student_detail->vehicle != ""? $student_detail->vehicle->vehicle_no: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Driver Name
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e($student_detail->vehicle != ""? $driver->full_name: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Driver Phone Number
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e($student_detail->vehicle != ""? $driver->mobile: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Dormitory Name
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e($student_detail->dormitory != ""? $student_detail->dormitory->dormitory_name: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Transport Part -->

                            <!-- Start Other Information Part -->
                            <h4 class="stu-sub-head mt-40">Other Information</h4>
                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Blood Group
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                           <?php echo e($student_detail->bloodGroup != ""? $student_detail->bloodGroup->base_setup_name: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Height
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e(isset($student_detail->height)? $student_detail->height: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Weight
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e(isset($student_detail->weight)? $student_detail->weight: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Previous School Details
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e(isset($student_detail->previous_school_details)? $student_detail->previous_school_details: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            National Identification Number
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e(isset($student_detail->national_id_no)? $student_detail->national_id_no: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Local Identification Number
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e(isset($student_detail->local_id_no)? $student_detail->local_id_no: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Bank Account Number
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e(isset($student_detail->bank_account_no)? $student_detail->bank_account_no: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            Bank Name
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            <?php echo e(isset($student_detail->bank_name)? $student_detail->bank_name: ''); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="single-info">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5">
                                        <div class="">
                                            IFSC Code
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-6">
                                        <div class="">
                                            UBC56987
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Other Information Part -->
                        </div>
                    </div>
                    <!-- End Profile Tab -->

                    <!-- Start Fees Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentFees">
                        <div style="margin-top:1rem;">
                            <h3 class="text-center">Student Fee Status Records</h3>
                        </div>
                        <hr>
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Paid Fees</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">UnPaid Fees</a>
                              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Payments</a>
                            </div>
                          </nav>


                          <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent" style="margin-left:2rem; margin-righ:2.5rem;">
                            
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div style="background:white;padding:5px;">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <th>Title</th>
                                            <th>Rate</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Taxable</th>
                                            <th>Tax</th>
                                            <th>Status</th>
                                        </thead>
                                        <?php
                                            $total = 0;
                                            $tax = 0;
                                        ?>
                                        <tbody>
                                            <?php if(isset($paiditems)): ?>
                                            <?php $__currentLoopData = $paiditems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($item->title); ?></td>
                                                    <td><?php echo e($item->amount); ?></td>
                                                    <td><?php echo e($item->qty); ?></td>
                                                    <td><?php echo e($item->amount * $item->qty); ?></td>
                                                    <td><?php echo e($item->taxable); ?></td>
                                                    <td><?php echo e($item->taxable*0.01); ?></td>
                                                    <td> <span class="badge badge-success">Paid</span></td>
                                                </tr>
                                                <?php
                                                    $total+=$item->amount * $item->qty;
                                                    $tax+=$item->taxable*0.01;
                                                ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-right">Gross Total</td>
                                                        <td colspan="7">Rs. <?php echo e($total); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-right"> Total Tax</td>
                                                        <td colspan="7">Rs. <?php echo e($tax); ?></td>
                                                    </tr>
                                                    <tr>
                                                          <td colspan="3" class="text-right"> Net Total</td>
                                                          <td colspan="7">Rs. <?php echo e($total+$tax); ?></td>
                                                    </tr>
                                                </tfoot>
                                        </tbody>
                                    </table>
                                  </div>
                            </div>
                            
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div style="background:white;padding:5px;">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            
                                            <th>Title</th>
                                            <th>Rate</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Due</th>
                                            <th>Taxable</th>
                                            <th>Tax</th>
                                            
                                        </thead>
                                        <tbody>
                                            <?php
                                                $totaldue=0;
                                                $totaltax=0;
                                            ?>
                                            <?php if(isset($unpaiditems)): ?>
                                            <?php $__currentLoopData = $unpaiditems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    
                                                    <td><?php echo e($item->title); ?></td>
                                                    <td><?php echo e($item->amount); ?></td>
                                                    <td><?php echo e($item->qty); ?></td>
                                                    <td><?php echo e($item->total); ?></td>
                                                    <?php
                                                        $due=$item->total-$item->pay;
                                                        $taxable=$item->taxable;
                                                        $tax=0;
                                                        if($taxable>0){
                                                            $taxable=$due;
                                                            $tax=$taxable*0.01;
                                                        }
                                                        $totaldue+=$due;
                                                        $totaltax+=$tax;
                                                    ?>
                                                    <td><?php echo e($due); ?></td>
                                                    <td><?php echo e($taxable); ?></td>
                                                    <td><?php echo e($tax); ?></td>
                                                    
                                                    
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-right">Total Due</th>
                                               <th colspan="4" >Rs.<?php echo e($totaldue); ?></th>
                                            </tr>
        
                                            <tr>
                                                <th colspan="4" class="text-right">Total Tax</th>
                                               <th colspan="4" >Rs.<?php echo e($totaltax); ?></th>
                                            </tr>
        
                                            <tr>
                                                <th colspan="4" class="text-right">Net Amount</th>
                                               <th colspan="4" >Rs.<?php echo e($totaldue + $totaltax); ?></th>
                                            </tr>
        
                                            <tr>
                                                <th colspan="4" class="text-right">
                                                    Pay Amount
                                                </th>
                                                <th colspan="4">
                                                    <input id="pay" class="w-100 form-control" type="number" min="0"/>
                                                </th>
                                            </tr>
                                                <td colspan="7" class="text-right">
                                                    <button  class="btn btn-primary btn-md" onclick="initKhaltiPay();"> Pay By Khalti</button>
                                                </td> 
                                            <tr>
                                               
                                            </tr>
                                        </tfoot>
                                    </table>        
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div style="background:white;padding:5px;">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <th>Date</th>
                                            <th>Bill No.</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                        </thead>
                                        <?php
                                            $total = 0;
                                        ?>
                                        <tbody>
                                            <?php if(isset($bills)): ?>
                                                <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($item->date); ?></td>
                                                        <td><?php echo e($item->billno); ?></td>
                                                        <td>
                                                            <?php if($item->payment_type==0): ?>
                                                                Cash
                                                            <?php endif; ?>
                                                            <?php if($item->payment_type==1): ?>
                                                                Bank Deposit
                                                            <?php endif; ?>
                                                            <?php if($item->payment_type==2): ?>
                                                                Cheque Deposit
                                                            <?php endif; ?>
                                                            <?php if($item->payment_type==3): ?>
                                                                Khalti Pay
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($item->total); ?></td>
                                                    </tr>
                                                    <?php
                                                        $total+=$item->total;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-right">Total</th>
                                                <th>Rs. <?php echo e($total); ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                  </div>
                            </div>
                          </div>
                    </div>
                    <!-- End Profile Tab -->
                    
                    <!-- Start Exam Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentExam">
                        <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="white-box no-search no-paginate no-table-info mb-2">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo e($exam->exam != ""? $exam->exam->name:''); ?></h3>
                            </div>
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Full Marks</th>
                                        <th>Passing Marks</th>
                                        <th>Obtained Marks</th>
                                        <th>Results</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $marks = App\SmStudent::marks($exam->exam_id, $student_detail->id);
                                        $grand_total = 0;
                                        $grand_total_marks = 0;
                                        $result = 0;

                                    ?>
                                    <?php $__currentLoopData = $marks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $subject_marks = App\SmStudent::fullMarks($exam->id, $mark->subject_id);
                                            $result_subject = 0;
                                            $grand_total_marks += $subject_marks->full_mark;
                                            if($mark->abs == 0){
                                                $grand_total += $mark->marks;
                                                if($mark->marks < $subject_marks->pass_mark){
                                                   $result_subject++;
                                                   $result++;
                                                }

                                            }else{
                                                $result_subject++;
                                                $result++;
                                            }
                                        ?>
                                    <tr>
                                        <td><?php echo e($mark->subject !=""?$mark->subject->subject_name:""); ?></td>
                                        <td><?php echo e($subject_marks->full_mark); ?></td>
                                        <td><?php echo e($subject_marks->pass_mark); ?></td>
                                        <td><?php echo e($mark->marks); ?></td>
                                        <td>
                                            <?php if($result_subject == 0): ?>
                                                <button class="primary-btn small bg-success text-white border-0">Pass</button>
                                            <?php else: ?>
                                                <button class="primary-btn small bg-danger text-white border-0">Fail</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Grand Total: <?php echo e($grand_total); ?>/<?php echo e($grand_total_marks); ?></th>
                                        <th></th>
                                        <th>Grade: 
                                            <?php
                                                if($result == 0 && $grand_total_marks != 0){

                                                    $percent = $grand_total/$grand_total_marks*100;
                                                    foreach($grades as $grade){
                                                       if($percent >= $grade->percent_from && $percent <= $grade->percent_upto){
                                                           echo $grade->grade_name;
                                                       }
                                                    }
                                                }else{
                                                    echo "F";
                                                }
                                            ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- End Exam Tab -->
                  
                    <!-- Start Documents Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentDocuments">
                        <div class="white-box">
                            <div class="text-right mb-20">
                                <button type="button" data-toggle="modal" data-target="#add_document_madal" class="primary-btn tr-bg text-uppercase bord-rad">
                                    upload document
                                    <span class="pl ti-upload"></span>
                                </button>
                            </div>
                            <table id="" class="table simple-table table-responsive school-table"
                                cellspacing="0">
                                <thead class="d-block">
                                    <tr class="d-flex">
                                        <th class="col-3">Document Title</th>
                                        <th class="col-6">Name</th>
                                        <th class="col-3">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="d-block">
                                    <?php if($student_detail->document_file_1 != ""): ?>
                                    <tr class="d-flex">
                                        <td class="col-3">title</td>
                                        <td class="col-6">dgdsg</td>
                                        <td class="col-3">
                                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                                Download
                                                <span class="pl ti-download"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_2 != ""): ?>
                                    <tr class="d-flex">
                                        <td class="col-3">title</td>
                                        <td class="col-6">dgdsg</td>
                                        <td class="col-3">
                                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                                Download
                                                <span class="pl ti-download"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_3 != ""): ?>
                                    <tr class="d-flex">
                                        <td class="col-3">title</td>
                                        <td class="col-6">dgdsg</td>
                                        <td class="col-3">
                                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                                Download
                                                <span class="pl ti-download"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($student_detail->document_file_4 != ""): ?>
                                    <tr class="d-flex">
                                        <td class="col-3">title</td>
                                        <td class="col-6">dgdsg</td>
                                        <td class="col-3">
                                            <button class="primary-btn tr-bg text-uppercase bord-rad">
                                                Download
                                                <span class="pl ti-download"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="d-flex">
                                        <td class="col-3"><?php echo e($document->title); ?></td>
                                        <td class="col-6"><?php echo e(showPicName($document->file)); ?></td>
                                        <td class="col-3">
                                            <a class="primary-btn tr-bg text-uppercase bord-rad" href="<?php echo e(url('student-download-document/'.showPicName($document->file))); ?>">
                                                 Download<span class="pl ti-download"></span>
                                            </a>
                                            <?php if($document->type=='stu'): ?>
                                            <a class="primary-btn icon-only bg-danger text-light" data-toggle="modal" data-target="#deleteDocumentModal<?php echo e($document->id); ?>"  href="#">
                                                <span class="ti-trash"></span>
                                            </a>
                                                <?php else: ?>
                                                <a></a>
                                            <?php endif; ?>
                                            
                                           
                                        </td>
                                    </tr>
                                    <div class="modal fade admin-query" id="deleteDocumentModal<?php echo e($document->id); ?>" >
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>Are you sure to detete this item?</h4>
                                                    </div>

                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>
                                                        <a class="primary-btn fix-gr-bg" href="<?php echo e(route('delete_document', [$document->id])); ?>">
                                                        Delete</a>
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
                    <!-- End Documents Tab -->
                    <!-- Add Document modal form start-->
                    <div class="modal fade admin-query" id="add_document_madal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Upload Document</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <div class="modal-body">
                                   <div class="container-fluid">
                                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_upload_document',
                                                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="hidden" name="student_id" value="<?php echo e($student_detail->id); ?>">
                                                    <div class="row mt-25">
                                                        <div class="col-lg-12">
                                                            <div class="input-effect">
                                                                <input class="primary-input form-control{" type="text" name="title" value="" id="title">
                                                                <label>Title <span>*</span> </label>
                                                                <span class="focus-border"></span>
                                                                
                                                                <span class=" text-danger" role="alert" id="amount_error">
                                                                    
                                                                </span>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-30">
                                                    <div class="row no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="input-effect">
                                                                <input class="primary-input" type="text" id="placeholderPhoto" placeholder="Document"
                                                                    disabled>
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="primary-btn-small-input" type="button">
                                                                <label class="primary-btn small fix-gr-bg" for="photo">browse</label>
                                                                <input type="file" class="d-none" name="photo" id="photo">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- <div class="col-lg-12 text-center mt-40">
                                                    <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                                        <span class="ti-check"></span>
                                                        save information
                                                    </button>
                                                </div> -->
                                                <div class="col-lg-12 text-center mt-40">
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>

                                                        <button class="primary-btn fix-gr-bg" type="submit">save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Add Document modal form end-->
                    <!-- delete document modal -->

                    <!-- delete document modal -->
                    <!-- Start Timeline Tab -->
                    <div role="tabpanel" class="tab-pane fade" id="studentTimeline">
                        <div class="white-box">
                            <?php $__currentLoopData = $timelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="student-activities">
                                <div class="single-activity">
                                    <h4 class="title text-uppercase">
                                        
<?php echo e($timeline->date != ""? App\SmGeneralSettings::DateConvater($timeline->date):''); ?>


                                    </h4>
                                    <div class="sub-activity-box d-flex">
                                        <h6 class="time text-uppercase"><?php echo e(date('h:i A', strtotime($timeline->date))); ?></h6>
                                        <div class="sub-activity">
                                            <h5 class="subtitle text-uppercase"> <?php echo e($timeline->title); ?></h5>
                                            <p>
                                                <?php echo e($timeline->description); ?>

                                            </p>
                                        </div>

                                        <div class="close-activity">
                                            <?php if($timeline->file != ""): ?>
                                            <a href="<?php echo e(url('download-timeline-doc/'.showPicName($timeline->file))); ?>" class="primary-btn tr-bg text-uppercase bord-rad">
                                                Download<span class="pl ti-download"></span>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Timeline Tab -->
                </div>
            </div>
            <!-- End Student Details -->
        </div>

            
    </div>
</section>

<!-- timeline form modal start-->
<div class="modal fade admin-query" id="add_timeline_madal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Timeline</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
               <div class="container-fluid">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_timeline_store',
                                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'document_upload'])); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="student_id" value="<?php echo e($student_detail->id); ?>">
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{" type="text" name="title" value="" id="title">
                                            <label>Title <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            
                                            <span class=" text-danger" role="alert" id="amount_error">
                                                
                                            </span>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control" id="startDate" type="text"
                                                 name="date">
                                                <label>Date</label>
                                                <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                <div class="input-effect">
                                    <textarea class="primary-input form-control" cols="0" rows="3" name="description" id="Description"></textarea>
                                    <label>Description<span></span> </label>
                                    <span class="focus-border textarea"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-30">
                                <div class="row no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input" type="text" id="placeholderFileFourName" placeholder="Document"
                                                disabled>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_4">browse</label>
                                            <input type="file" class="d-none" name="document_file_4" id="document_file_4">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-30">
                                
                                <input type="checkbox" id="currentAddressCheck" class="common-checkbox" name="visible_to_student" value="1">
                                <label for="currentAddressCheck">Visible to this person</label>
                            </div>


                            <!-- <div class="col-lg-12 text-center mt-40">
                                <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                                    <span class="ti-check"></span>
                                    save information
                                </button>
                            </div> -->
                            <div class="col-lg-12 text-center mt-40">
                                <div class="mt-40 d-flex justify-content-between">
                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>

                                    <button class="primary-btn fix-gr-bg" type="submit">save</button>
                                </div>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- timeline form modal end-->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://khalti.com/static/khalti-checkout.js"></script>
    
    <script>
        
        function initKhaltiPay(){
            var amount=parseFloat( $("#pay").val());

            if(amount!=undefined && amount !=null && amount>0){
                axios.post("/generatebill",{
                    amount:amount,
                    student_id:<?php echo e($student_detail->id); ?>,
                    type:'parent'
                }).then(function(response){
                    console.log(response);
                    var config = {
                        // replace the publicKey with yours
                        "publicKey": "<?php echo e(config('khalti.public_key')); ?>",
                        "productIdentity": response.data,
                        "productName": "Bill for <?php echo e($student_detail->full_name); ?>",
                        "productUrl": "http://localhost:8080/bilview/"+response.data,
                        "eventHandler": {
                            onSuccess (payload) {
                                // hit merchant api for initiating verfication
                                console.log(payload);
                                axios.post('/payemnt/Khalti/sucess',payload)
                                .then(function(verify){
                                    console.log(verify);
                                    alert(verify.data);
                                    location.reload();
                                })
                                .catch(function(err){

                                });
                            },
                            onError (error) {
                                console.log(error);
                            },
                            onClose () {
                                console.log('widget is closing');
                            }
                        }
                    };
                    var checkout = new KhaltiCheckout(config);
                    checkout.show({amount: amount*100});
                   
                })
                .catch(function(error){

                });
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>