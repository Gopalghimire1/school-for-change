<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.email_sms_log'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.communicate'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.email_sms_log'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
<div class="container-fluid p-0">
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <a href="<?php echo e(url('send-email-sms-view')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.send_email'); ?>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                    <thead>
                        <?php if(session()->has('message-success-delete') != "" ||
                        session()->get('message-danger-delete') != ""): ?>
                        <tr>
                            <td colspan="2">
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
                            <th> <?php echo app('translator')->getFromJson('lang.title'); ?></th>
                            <th> <?php echo app('translator')->getFromJson('lang.description'); ?></th>
                            <th> <?php echo app('translator')->getFromJson('lang.date'); ?></th>
                            <th> <?php echo app('translator')->getFromJson('lang.type'); ?></th>
                            <th> <?php echo app('translator')->getFromJson('lang.group'); ?></th>
                            <th> <?php echo app('translator')->getFromJson('lang.individual'); ?></th>
                            <th> <?php echo app('translator')->getFromJson('lang.class'); ?></th>
                           
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(isset($emailSmsLogs)): ?>
                        <?php $__currentLoopData = $emailSmsLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e($value->title); ?></td>
                            <td><?php echo e($value->description); ?></td>
                            <td  data-sort="<?php echo e(strtotime($value->send_date)); ?>" >  

                                <?php echo e($value->send_date != ""? App\SmGeneralSettings::DateConvater($value->send_date):''); ?>


                            </td>
                            <td><?php if($value->send_through == 'E'): ?>
                            <button class="primary-btn small bg-warning text-white border-0"> <?php echo app('translator')->getFromJson('lang.email'); ?></button>
                            <?php else: ?>
                            <button class="primary-btn small bg-success text-white border-0"> <?php echo app('translator')->getFromJson('lang.sms'); ?></button>
                            <?php endif; ?>
                            </td>
                            <td>
                            <?php if($value->send_to == 'G'): ?>
                            <input type="checkbox" id="asdasd" class="" value="1" name="send_to" checked>
                            <?php endif; ?>
                            </td>
                            <td>
                            <?php if($value->send_to == 'I'): ?>
                            <input type="checkbox" id=""  value="" checked>
                            <?php endif; ?>
                            </td>
                            <td>
                            <?php if($value->send_to != 'G' && $value->send_to != 'I'): ?>
                            <input type="checkbox" id=""  value="" checked>
                            <?php endif; ?>
                            </td>
                        </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
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