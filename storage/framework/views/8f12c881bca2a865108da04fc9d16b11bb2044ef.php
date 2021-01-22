<div class="text-center">
    <h4><?php echo app('translator')->getFromJson('lang.return_this_book'); ?></h4>
</div>

<div class="mt-40 d-flex justify-content-between">
    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.none'); ?></button>
    <a href="<?php echo e(url('return-book/'.$issue_book_id)); ?>" class="text-light">
    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.yes'); ?></button>
     </a>
</div>
