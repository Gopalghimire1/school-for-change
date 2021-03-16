<?php $__env->startSection('mainContent'); ?>
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
                <option value="<?php echo e($exam->id); ?>" <?php echo e(isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''); ?>>
                    <?php echo e($exam->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($errors->has('exam')): ?>
            <span class="invalid-feedback invalid-select" role="alert">
                <strong><?php echo e($errors->first('exam')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
        <div class="col-lg-3 mt-30-md">
            <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>"
                id="select_class" name="class">
                <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?> *</option>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>>
                    <?php echo e($class->class_name); ?></option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($errors->has('class')): ?>
            <span class="invalid-feedback invalid-select" role="alert">
                <strong><?php echo e($errors->first('class')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
        <div class="col-lg-3 mt-30-md" id="select_section_div">
            <select
                class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?> select_section"
                id="select_section" name="section">
                <option data-display="Select section *" value="">Select section *</option>
            </select>
            <?php if($errors->has('section')): ?>
            <span class="invalid-feedback invalid-select" role="alert">
                <strong><?php echo e($errors->first('section')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
        <div class="col-lg-3 mt-30-md" id="select_student_div" style="display: none">
            <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>"
                id="select_student" name="student">
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
<div class="mt-4" id="printdiv">
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

            <h5 style="padding-top:20px;"> <strong>Result-List</strong></h5>
        </div>

    </div>
    <h5 class="ml-5">Section Name : <?php echo e($section->section_name); ?></h5>
    <div class="card-body" style="height:<?php echo e(env('printheight','1350px')); ?>;">
        <div class="col-md-12">
            <table class="table table-bordered text-center">
                <thead>
                    <tr style="border:none;">
                        <th>Student Name</th>
                        <th>Symbol Number</th>
                        <th>GPA</th>
                        <th>Class</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $std=$data['std']; ?>
                    <tr>
                        <td><?php echo e($std->full_name); ?></td>
                        <td><?php echo e($std->roll_no); ?></td>
                        <td><?php echo e($data['gpa']); ?></td>
                        <td><?php echo e($std->class->class_name); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        </div>

    </div>
    <div class="fs"></div>
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