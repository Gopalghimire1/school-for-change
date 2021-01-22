<script src="<?php echo e(asset('public/backEnd/')); ?>/js/main.js"></script>
        <div class="add-visitor">
            <div class="common-fields" id="common-fields">

                <div class="row  mt-25">
                    <div class="col-lg-12">
                        <div class="input-effect">
                            <input class="primary-input form-control"
                                type="number" name="mark" autocomplete="off" value="<?php echo e($question_bank->marks); ?>" required>
                            <label>Mark</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-25">
                    <div class="col-lg-12">
                        <div class="input-effect">
                            <textarea class="primary-input form-control" cols="0" rows="5" name="question_title" required><?php echo e($question_bank->question); ?></textarea>
                            <label>Question Title</label>
                            <span class="focus-border textarea"></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($question_bank->type == "M"): ?>
            <?php
                $multiple_options = $question_bank->questionMu;
                $number_of_option = $question_bank->questionMu->count();
            ?>
            <div class="multiple-choice" id="multiple-choice">
                
                <div class="row  mt-25">
                    <div class="col-lg-10">
                        <div class="input-effect">
                            <input class="primary-input form-control"
                                type="number" name="number_of_option" autocomplete="off" id="number_of_option_edit" value="<?php echo e($number_of_option); ?>">
                            <label>Number Options</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button class="primary-btn fix-gr-bg" type="button" id="create-option-edit">Create</button>
                    </div>
                </div>
            </div>

            <div class="multiple-options" id="multiple-options">
                <?php $i=0; ?>
                <?php $__currentLoopData = $multiple_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $multiple_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $i++; ?>
                <div class='row  mt-25'>
                    <div class='col-lg-10'>
                        <div class='input-effect'>
                            <input class='primary-input form-control' type='text' name='option[]' autocomplete='off' required value="<?php echo e($multiple_option->title); ?>">
                            <label>option <?php echo e($i); ?></label>
                            <span class='focus-border'></span>
                        </div>
                    </div>
                    <div class='col-lg-2'>
                        <input type='checkbox' class="common-checkbox" id="commonCheckbox<?php echo e($i); ?>" name='option_check_<?php echo e($i); ?>' value='1' <?php echo e($multiple_option->status == 1? 'checked': ''); ?>>
                        <label for="commonCheckbox<?php echo e($i); ?>"></label>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <?php elseif($question_bank->type == "T"): ?>
            <div class="true-false" id="true-false">
                <div class="row  mt-25">
                    <div class="col-lg-12 d-flex">
                        <p class="text-uppercase fw-500 mb-10"></p>
                        <div class="d-flex radio-btn-flex">
                            <div class="mr-30">
                                <input type="radio" name="trueOrFalse" id="relationFatherEdit" value="T" class="common-radio relationButton" <?php echo e($question_bank->trueFalse == 'T'? 'checked': ''); ?>>
                                <label for="relationFatherEdit">True</label>
                            </div>
                            <div class="mr-30">
                                <input type="radio" name="trueOrFalse" id="relationMotherEdit" value="F" class="common-radio relationButton" <?php echo e($question_bank->trueFalse == 'F'? 'checked': ''); ?>>
                                <label for="relationMotherEdit">False</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="fill-in-the-blanks" id="fill-in-the-blanks">
                <div class="row  mt-25">
                    <div class="col-lg-12">
                        <div class="input-effect">
                            <textarea class="primary-input form-control" cols="0" rows="5" name="suitable_words" required><?php echo e($question_bank->suitable_words); ?></textarea>
                            <label>Suitable Words</label>
                            <span class="focus-border textarea"></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>


