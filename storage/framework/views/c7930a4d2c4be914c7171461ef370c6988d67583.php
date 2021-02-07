<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>New Student</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.academics'); ?></a>
                <a href="#">New Student</a>
            </div>
        </div>
    </div>
</section>

<form action="<?php echo e(route('new_student_store',[$classs_id,$section_id])); ?>" method="POST" id="add_admission">
<?php echo csrf_field(); ?>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="full">Registraion Number</label>
            <input type="text" class="form-control" name="adm" id="regno">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="full">Symbol Number</label>
            <input type="text" class="form-control" name="roll" id="roll_no" >
        </div>
    </div>
        <div class="col-6">
            <div class="form-group">
                <label for="full">Full Name*</label>
                <input type="text" class="form-control" name="full_name" required placeholder="Name of Student" id="full_name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                <input type="text" name="dob" id="dob" class="form-control" >
            </div>
        </div>
        
        <div class="col-12">
            <span class="btn btn-primary btn-sm btn-block" onclick="addStudent()">Save Student</span>
        </div>
    </div>
</form>
<hr>
<div class="card px-2 py-4" >
    <table class="table">
        <tr>
            <th>
                Registraion No
            </th>
            <th>
                Symbolno
            </th>
            <th>
                Name
            </th>
            <th>
                Dob
            </th>
            <th>
                
            </th>

        </tr>
        <tbody id="students">

            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $std): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="std_<?php echo e($std->id); ?>" data-std="<?php echo e($std->toJson()); ?>">
                <td>
                    <?php echo e($std->regno); ?>

                </td>
                <td>
                    <?php echo e($std->roll_no); ?>

                </td>
                <td>
                    <?php echo e($std->full_name); ?>

                </td>
                <td>
                    <?php echo e($std->nepali_dob); ?>

                </td>
                <td>
                    <span href="" class="btn btn-success btn-sm"  data-std="<?php echo e($std->toJson()); ?>" onclick="initEdit(this)">Edit</span>
                    <span href="" class="btn btn-danger btn-sm">Delete</span>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo e(route('new_student_store',[$classs_id,$section_id])); ?>" method="POST" id="edit_admission">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" id="e_id">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="full">Admission Number</label>
                            <input type="text" class="form-control" name="adm" id="e_admission_no">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="full">Symbol Number</label>
                            <input type="text" class="form-control" name="roll" id="e_roll_no" >
                        </div>
                    </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="full">Full Name*</label>
                                <input type="text" class="form-control" name="full_name" required placeholder="Name of Student" id="e_full_name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="dob">Date Of Birth</label>
                                <input type="text" name="dob" id="e_dob" class="form-control" >
                            </div>
                        </div>
                        
                       
                    </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="update()">Save changes</button>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/js/jquery.mask.min.js"></script>
    <script>
        var lock=false;


        $(document).ready(function(){
            $('#dob').mask('0000/00/00',{placeholder: "____/__/__"});
            $('#e_dob').mask('0000/00/00',{placeholder: "____/__/__"});
            $('#dob').on('keypress',function(e) {
                if(e.which == 13) {
                    addStudent();
                }
            });
            $('#e_dob').on('keypress',function(e) {
                if(e.which == 13) {
                    update();
                }
            });
        });
        id=0;
        function initEdit(ele){
            data=JSON. parse(ele.dataset.std);
            console.log(data.id);
            id=data.id;
            $('#e_id').val(data.id);
            $('#e_admission_no').val(data.regno);
            $('#e_roll_no').val(data.roll_no);
            $('#e_dob').val(data.nepali_dob);
            $('#e_full_name').val(data.full_name);
            $('#editModal').modal('show');
        }

        function update(){
            if(!lock){
                lock=true;
                var data=new FormData(document.getElementById('edit_admission'));
                console.log(data);
                axios.post($( '#edit_admission' ). attr( 'action' ),data)
                .then((response)=>{
                    console.log(response.data);
                    $('#std_'+id).replaceWith($(response.data));
                    // $('#students').append(response.data); 
                    document.getElementById('edit_admission').reset();
                    // $('#roll_no').focus();
                    $('#editModal').modal('hide');
                    replaceWith
                    lock=false;
                })
                .catch((err)=>{
                    console.log(err);
                    lock=false;
                });
            }
        }

        function addStudent(){
            if(!lock){
                lock=true;
                var data=new FormData(document.getElementById('add_admission'));
                console.log(data);
                axios.post($( '#add_admission' ). attr( 'action' ),data)
                .then((response)=>{

                    $('#students').append(response.data); 
                    document.getElementById('add_admission').reset();
                    $('#roll_no').focus();
                    lock=false;
                })
                .catch((err)=>{
                    console.log(err);
                    lock=false;
                });
            }

        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>