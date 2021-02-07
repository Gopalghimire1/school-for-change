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
        <span href="" class="btn btn-success btn-sm" data-std="<?php echo e($std->toJson()); ?>" onclick="initEdit(this)">Edit</span>
        <span href="" class="btn btn-danger btn-sm">Delete</span>
    </td>
</tr>