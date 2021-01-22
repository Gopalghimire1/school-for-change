<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Fees</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                <a href="#">Fees</a>
                <a href="<?php echo e(route('student_fees')); ?>">Pay Fees</a>
            </div>
        </div>
    </div>
</section>

<input type="hidden" id="url" value="<?php echo e(URL::to('/')); ?>">
<input type="hidden" id="student_id" value="<?php echo e($student->id); ?>">
<section class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between">
                    <div class="main-title">
                        <h3 class="mb-30">Student Information</h3>
                    </div>
                </div>
            </div>
        </div>
              <?php if(session()->has('message-success')): ?>
                <div class="alert alert-success">
                  <?php echo e(session()->get('message-success')); ?>

              </div>
              <?php elseif(session()->has('message-danger')): ?>
              <div class="alert alert-danger">
                  <?php echo e(session()->get('message-danger')); ?>

              </div>
              <?php endif; ?>

        <div class="row">
            <div class="col-md-3 col-lg-3">
                <!-- Start Student Meta Information -->
                <div class="student-meta-box">
                    <div class="student-meta-top"></div>
                    <img class="student-meta-img img-100" src="<?php echo e(asset($student->student_photo)); ?>" alt="">
                    <div class="white-box radius-t-y-0">
                        <div class="single-meta mt-10">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Student Name
                                </div>
                                <div class="value">
                                    <?php echo e($student->first_name.' '.$student->last_name); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Admission Number
                                </div>
                                <div class="value">
                                    <?php echo e($student->admission_no); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Roll Number
                                </div>
                                <div class="value">
                                     <?php echo e($student->roll_no); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Class
                                </div>
                                <div class="value">
                                    <?php if($student->className!="" && $student->session!=""): ?>
                                   <?php echo e($student->className->class_name); ?> (<?php echo e($student->session->session); ?>)
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
                                    <?php echo e($student->section !=""?$student->section->section_name:""); ?>

                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="d-flex justify-content-between">
                                <div class="name">
                                    Gender
                                </div>
                                <div class="value">
                                    <?php echo e($student->gender !=""?$student->gender->base_setup_name:""); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Student Meta Information -->

            </div>

            <div class="col-md-9 col-lg-9">
                <table class="display school-table school-table-style-parent-fees" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Fees Group</th>
                            <th>Fees Code</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Amount (<?php echo e($currency); ?>)</th>
                            <th>Payment ID</th>
                            <th>Mode</th>
                            <th>Date</th>
                            <th>Discount (<?php echo e($currency); ?>)</th>
                            <th>Fine (<?php echo e($currency); ?>)</th>
                            <th>Paid (<?php echo e($currency); ?>)</th>
                            <th>Balance (<?php echo e($currency); ?>)</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $grand_total = 0;
                            $total_fine = 0;
                            $total_discount = 0;
                            $total_paid = 0;
                            $total_grand_paid = 0;
                            $total_balance = 0;
                        ?>
                        <?php $__currentLoopData = $fees_assigneds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                    $grand_total += $fees_assigned->feesGroupMaster->amount;
                                }else{
                                    if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                        $grand_total += $student->route->far;
                                    }else{
                                        $grand_total += $student->room->cost_per_bed;
                                    }
                                }
                                
                            ?>

                            <?php
                                $discount_amount = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'discount_amount');
                                $total_discount += $discount_amount;
                                $student_id = $fees_assigned->student_id;
                            ?>
                            <?php
                                $paid = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'amount');
                                $total_grand_paid += $paid;
                            ?>
                            <?php
                                $fine = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'fine');
                                $total_fine += $fine;
                            ?>
                             
                            <?php
                                $total_paid = $discount_amount + $paid;
                            ?>
                        <tr>
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <td><?php echo e($fees_assigned->feesGroupMaster->feesGroups->name); ?></td>
                            <td><?php echo e($fees_assigned->feesGroupMaster->feesTypes->name); ?></td>
                            <td>
                                
<?php echo e($fees_assigned->feesGroupMaster->date != ""? App\SmGeneralSettings::DateConvater($fees_assigned->feesGroupMaster->date):''); ?>


                            </td>
                            <td>
                                <?php if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2): ?>
                                    <?php if($fees_assigned->feesGroupMaster->amount == $total_paid): ?>
                                    <button class="primary-btn small bg-success text-white border-0">Paid</button>
                                    <?php elseif($total_paid != 0): ?>
                                    <button class="primary-btn small bg-warning text-white border-0">Partial</button>
                                    <?php elseif($total_paid == 0): ?>
                                    <button class="primary-btn small bg-danger text-white border-0">Unpaid</button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if($fees_assigned->feesGroupMaster->fees_group_id == 1): ?>
                                        <?php if($student->route->far == $total_paid): ?>
                                        <button class="primary-btn small bg-success text-white border-0">Paid</button>
                                        <?php elseif($total_paid != 0): ?>
                                        <button class="primary-btn small bg-warning text-white border-0">Partial</button>
                                        <?php elseif($total_paid == 0): ?>
                                        <button class="primary-btn small bg-danger text-white border-0">Unpaid</button>
                                        <?php endif; ?>
                                    <?php elseif($fees_assigned->feesGroupMaster->fees_group_id == 2): ?>
                                        <?php if($student->room->cost_per_bed == $total_paid): ?>
                                        <button class="primary-btn small bg-success text-white border-0">Paid</button>
                                        <?php elseif($total_paid != 0): ?>
                                        <button class="primary-btn small bg-warning text-white border-0">Partial</button>
                                        <?php elseif($total_paid == 0): ?>
                                        <button class="primary-btn small bg-danger text-white border-0">Unpaid</button>
                                        <?php endif; ?>
                                    <?php endif; ?>    
                                <?php endif; ?>    
                            </td>
                            <td>
                                <?php
                                    if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                        echo $fees_assigned->feesGroupMaster->amount;
                                    }else{
                                        if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                            echo $student->route->far;
                                        }else{
                                            echo $student->room->cost_per_bed;
                                        }
                                    }
                                    
                                ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td> <?php echo e($discount_amount); ?> </td>
                            <td><?php echo e($fine); ?></td>
                            <td><?php echo e($paid); ?></td>
                            <td>
                                <?php 

                                    if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                        $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                    }else{
                                        if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                           $rest_amount = $student->route->far - $total_paid;
                                        }else{
                                           $rest_amount = $student->room->cost_per_bed - $total_paid;
                                        }
                                    }

                                    $total_balance +=  $rest_amount;
                                    echo $rest_amount;
                                ?>
                            </td>
                            <td>
                                <?php if($rest_amount != 0): ?> 
                                <form method="POST" action="<?php echo e(url('pay-with-paystack')); ?>" accept-charset="UTF-8" class="form-horizontal" role="form">
 

                                    <input type="hidden" name="email" value="otemuyiwa@gmail.com"> 
                                    <input type="hidden" name="orderID" value="345">
                                    <input type="hidden" name="amount" value="<?php echo e($rest_amount * 100); ?>"> 
                                    <input type="hidden" name="quantity" value="3">
                                    <input type="hidden" name="fees_type_id" value="<?php echo e($fees_assigned->feesGroupMaster->fees_type_id); ?>">
                                    <input type="hidden" name="payment_mode" value="">
                                    <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
                                    <input type="hidden" name="metadata" value="<?php echo e(json_encode($array = ['key_name' => 'value',])); ?>" >  
                                     <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef()); ?>">  
                                    <input type="hidden" name="key" value="<?php echo e(config('paystack.secretKey')); ?>"> 
                                    <?php echo e(csrf_field()); ?> 

                                     <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
 
                                    <button type="submit" class="primary-btn small fix-gr-bg">Paystack<i class="ti-arrow-right"></i></button> 
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                            <?php 
                                $payments = App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id, $fees_assigned->student_id);
                                

                                $i = 0;
                            ?> 

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><img src="<?php echo e(asset('public/backEnd/img/table-arrow.png')); ?>"></td>
                                <td>
 
                                   
                                    <?php
                                        $created_by = App\User::find($payment->created_by); 
                                    ?>
 
                                    <?php if($created_by != ""): ?>
                                            <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo e('Collected By: '.$created_by->full_name); ?>"><?php echo e($payment->fees_type_id.'/'.$payment->id); ?></a></td>
                                            <?php endif; ?>
                                    
 
                                <td>
                                <?php if($payment->payment_mode == "C"): ?>
                                        <?php echo e('Cash'); ?>

                                <?php elseif($payment->payment_mode == "Cq"): ?>
                                    <?php echo e('Cheque'); ?>

                                <?php elseif('DD'): ?>
                                    <?php echo e('DD'); ?>

                                <?php elseif('PS'): ?>
                                    <?php echo e('Paystack'); ?>

                                    <?php endif; ?> 
                                </td>
                                <td>
                                   
<?php echo e($payment->payment_date != ""? App\SmGeneralSettings::DateConvater($payment->payment_date):''); ?>


                                </td>
                                <td><?php echo e($payment->discount_amount); ?></td>
                                <td><?php echo e($payment->fine); ?></td>
                                <td><?php echo e($payment->amount); ?></td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $fees_discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>Discount</td>
                            <td><?php echo e($fees_discount->feesDiscount !=""?$fees_discount->feesDiscount->name:""); ?></td>
                            <td></td>
                            <td><?php if(in_array($fees_discount->id, $applied_discount)): ?>
                                <?php
                                    $createdBy = App\SmFeesAssign::createdBy($student_id, $fees_discount->id);
                                ?>

                                <?php if($createdBy != ""): ?>

                                    $created_by = App\User::find($createdBy->created_by);


                                
                                    <?php if(!empty( $created_by )): ?>
                                        <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo e('Collected By: '.$created_by->full_name); ?>">Discount of $<?php echo e($fees_discount->feesDiscount->amount); ?> Applied : <?php echo e($createdBy->id.'/'.$createdBy->created_by); ?></a>
                                    <?php endif; ?>
                                    
                                <?php endif; ?>
                                
                                <?php else: ?>
                                Discount of $<?php echo e($fees_discount->feesDiscount !=""?$fees_discount->feesDiscount->amount:""); ?> Assigned
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($fees_discount->name); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Grand Total (<?php echo e($currency); ?>)</th>
                            <th></th>
                            <th><?php echo e($grand_total); ?></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo e($total_discount); ?></th>
                            <th><?php echo e($total_fine); ?></th>
                            <th><?php echo e($total_grand_paid); ?></th>
                            <th><?php echo e($total_balance); ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade admin-query" id="deleteFeesPayment" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Item</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure to delete this item?</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>
                     <?php echo e(Form::open(['url' => 'fees-payment-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" id="feep_payment_id">
                    <button class="primary-btn fix-gr-bg" type="submit">Delete</button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>