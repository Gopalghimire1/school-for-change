<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmMarkStore extends Model
{
 
    public static function get_mark_by_part($student_id, $exam_id, $class_id, $section_id, $subject_id,$exam_setup_id){
    	$getMark= SmMarkStore::where([
    		['student_id',$student_id], 
    		['exam_term_id',$exam_id], 
    		['class_id',$class_id], 
    		['section_id',$section_id], 
            ['exam_setup_id',$exam_setup_id], 
    		['subject_id',$subject_id]
    	])->first();
		// dd([
    	// 	['student_id',$student_id], 
    	// 	['exam_term_id',$exam_id], 
    	// 	['class_id',$class_id], 
    	// 	['section_id',$section_id], 
        //     ['exam_setup_id',$exam_setup_id], 
    	// 	['subject_id',$subject_id]
    	// ]);
    	if(!empty($getMark)){
    		$output= $getMark->total_marks;
    	}else{
    		$output= '0';
    	}

    	return $output;
	}
	
	public static function get_is_absent_by_part($student_id, $exam_id, $class_id, $section_id, $subject_id,$exam_setup_id){
    	$getMark= SmMarkStore::where([
    		['student_id',$student_id], 
    		['exam_term_id',$exam_id], 
    		['class_id',$class_id], 
    		['section_id',$section_id], 
            ['exam_setup_id',$exam_setup_id], 
    		['subject_id',$subject_id]
    	])->first();
    	if(!empty($getMark)){
			$val= $getMark->is_absent;
			$output=$val==1;
    	}else{
    		$output= false;
    	}

    	return $output;
    }
}
