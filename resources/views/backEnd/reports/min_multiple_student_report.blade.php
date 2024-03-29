@extends('backEnd.master')
@section('mainContent')
<style>
    th{
        border: 1px solid black;
        text-align: center;
    }
    td{
        text-align: center;
    }
    td.subject-name{
        text-align: left;
        padding-left: 10px !important;
    }
    table.marksheet{
        width: 100%;
        border: 1px solid #828bb2 !important;
    }
    table.marksheet th{
        border: 1px solid #828bb2 !important;
    }
    table.marksheet td{
        border: 1px solid #828bb2 !important;
    }
    table.marksheet thead tr{
        border: 1px solid #828bb2 !important;
    }
    table.marksheet tbody tr{
        border: 1px solid #828bb2 !important;
    }

    .studentInfoTable{
        width: 100%;
        padding: 0px !important;
    }

    .studentInfoTable td{
        padding: 0px !important;
        text-align: left;
        padding-left: 15px !important;
    }
    h4{
        text-align: left !important;
    }
</style>

<div class="col-12" style="display: flex; justify-content: space-between;">
    {{-- <div>
        <input type="checkbox" name="abc" id="signgle" onchange="
        document.getElementById('select_student_div').style.display=this.checked?'flex':'none';
    ">
        <label for="relationFather">For Single Student</label>
    </div> --}}
    <div>
        <span class="primary-btn small fix-gr-bg" onclick="printDiv('printdiv');">Print</span>
    </div>
</div>

<div class="white-box mt-4">
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'mark_sheet_report_multiple_student', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
        <div class="row">
            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
            
            <div class="col-lg-3 mt-30-md">
                <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}" name="exam">
                    <option data-display="@lang('lang.select_exam') *" value="">@lang('lang.select_exam') *</option>
                    @foreach($exams as $exam)
                        <option value="{{$exam->id}}" {{isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''}}>{{$exam->title}}</option>
                    @endforeach
                </select>
                @if ($errors->has('exam'))
                <span class="invalid-feedback invalid-select" role="alert">
                    <strong>{{ $errors->first('exam') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-lg-3 mt-30-md">
                <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                    <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class') *</option>
                    @foreach($classes as $class)
                    <option value="{{$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                   
                    @endforeach
                </select>
                @if ($errors->has('class'))
                <span class="invalid-feedback invalid-select" role="alert">
                    <strong>{{ $errors->first('class') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-lg-3 mt-30-md" id="select_section_div" >
                <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section" id="select_section" name="section">
                    <option data-display="Select section *" value="">Select section *</option>
                </select>
                @if ($errors->has('section'))
                <span class="invalid-feedback invalid-select" role="alert">
                    <strong>{{ $errors->first('section') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-lg-3 mt-30-md" id="select_student_div" style="display: none">
                <select class="w-100 bb niceSelect form-control{{ $errors->has('student') ? ' is-invalid' : '' }}" id="select_student" name="student">
                    <option data-display="@lang('lang.select_student') *" value="">@lang('lang.select_student') *</option>
                </select>
                @if ($errors->has('student'))
                <span class="invalid-feedback invalid-select" role="alert">
                    <strong>{{ $errors->first('student') }}</strong>
                </span>
                @endif
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
                    @lang('lang.search')
                </button>
            </div>
        </div>
    {{ Form::close() }}
</div>
<div class="mt-4" id="printdiv" >

    @foreach ($datas as $data)
        @php
            $std=$data['std'];
            if($std->regno==null || $std->regno==''){
                continue;
            }
            // dd($std);
        @endphp
        <div class="card-body" style="border:2px rgb(0, 0, 0) solid; padding:1rem;height:{{env('printheight','1350px')}};">
            <div class="row text-center mb-5">
                <div class="col-2">
                    <img src="{{ asset('public/logo.png') }}" alt="" style="width: 200px;">
                </div>
                <div class="col-10 pt-4">
                    <h3 style="font-size:28px;">
                        <strong>{{$name}}</strong>
                        <br>
                        <strong style="font-size: 20px;">{{$address}}</strong> 
                    </h3>
                   
                    <h5 style="padding-top:20px;"> <strong>GRADE-SHEET</strong></h5>
                </div>

            </div>
            <div class="p-3">
                <h5>
                    <div class="d-flex mb-1">
                        <span>THE FOLLOWING ARE THE GRADE(S) OBTAINED BY:  </span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;"><span style="margin-left: 20px;">{{$std->full_name}}</span></span>
                    </div>
                    <div class="d-flex mb-1">
                        <span> DATE OF BIRTH : </span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;"><span style="margin-left: 20px;">{{$std->nepali_dob}} BS </span></span>
                    </div>
                    <div class="mb-1" style="display: flex; justify-content: space-between">
                        <span style="flex:2.5;">REGISTRATION NO. : <span style="border-bottom:2px dotted black;padding:0px 25px;">{{$std->regno}}</span></span>
                        <span style="flex:2;text-align:center;">SYMBOL NO. : <span style="border-bottom:2px dotted black;padding:0px 20px;">{{$std->roll_no}}</span></span>
                        <span style="flex:1;text-align:right;">GRADE : <span style="border-bottom:2px dotted black;padding:0px 20px;">{{$std->class->class_name}}</span></span>
                    </div>
                    @php
                     $ses = \App\SmSession::where('is_default',1)->first();  
                    @endphp
                    
                    <div class="d-flex mb-1">
                        <span>IN THE ANNUAL EXAMINATION CONDUCTED BY SCHOOL/CAMPUS IN </span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;"><span style="margin-left: 20px;"> {{$ses->session}} </span></span>
                        <span>
                            Bs
                        </span>
                    </div>
                    <span>ARE GIVEN BELOW.</span>
                </h5>
            </div>

            <div class="col-md-12">
                
            <table class="w-100 mt-30 mb-20 table table-bordered marksheet mb-5" >
                <thead>
                    <tr style="border:none;">
                        <th style="border-left:1px solid black;border-right:1px solid black;">SUBJECT <BR> CODE</th>
                        <th style="border-left:1px solid black;border-right:1px solid black; width: 300px;">SUBJECTS</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;" >CREDIT <BR> HOUR (CH)</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;" >GRADE POINT (GP)</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">GRADE</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">FINAL GRADE (FG)</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">Remarks</th>
                    </tr>
                </thead>
                
                    <tbody>

                        @php
                            $tt=0;
                            $totgrade=0;
                            $totalcredit=0;
                            $hasop=false;
                        @endphp
                        @foreach ($data['marks_old'] as $datas)
                            @php
                                $isabs=false;
                                $_totgrade=0;
                                $_totalcredit=0;
                                $_finalGrade='ABS';
                                $_finalGradePoint='ABS';
                                foreach ($datas as $dataitem){
                                    if($dataitem->is_absent || $isabs){
                                        $isabs=true;
                                    }else{
                                        $_totgrade+= $dataitem->total_gpa_point * $dataitem->credit_hour;
                                        $_totalcredit+=$dataitem->credit_hour;
                                    }
                                }

                                if(!$isabs){
                                    $totgrade+=$_totgrade;
                                    $totalcredit+=$_totalcredit;
                                    $_finalGradePoint=round($_totgrade/$_totalcredit,2);
                                    if($_finalGradePoint==0){
                                        $_finalGrade='NG';
                                    }else{
                                        $_=$grades->where('from','<=',$_finalGradePoint )->where('up','>=',$_finalGradePoint)->first();
                                       
                                        if($_){
                                            $_finalGrade=$_->grade_name;
                                        }

                                    }
                                }

                            @endphp
                            @foreach ($datas as $key=>$dataitem)
                                @if(!$dataitem->isop)
                                <tr style="border:none !important;">
                                    <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;">{{ $dataitem->code }}</td>
                                    <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;">{{ $dataitem->name }}</td>
                                    <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;">{{ $dataitem->credit_hour}}</td>
                                    <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;">{{ $dataitem->is_absent?'ABS':number_format((float)($dataitem->total_gpa_point),2,'.','')}}</td>
                                    <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;">{{ $dataitem->is_absent?'ABS':$dataitem->total_gpa_grade }}</td>
                                    @if($key==0)
                                        <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;" rowspan="2">{{ $_finalGrade }}</td>
                                    @endif
                                    <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;"></td>
                                    @php
                                        $tt+=1;
                                    @endphp
                                </tr>
                                @else
                                    @php
                                        $hasop=true;
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach
                        
                        @for ($i = $tt; $i < 10; $i++)
                            <tr style="border:none !important;">
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                                <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                          
                            <th colspan="5" class="text-right">
                                
                                    GRADE POINT AVERAGE(GPA):
                            </th>
                            <th colspan="2">
                                {{round(($totgrade/$totalcredit),2)}}
                            </th>
                            
                        </tr>
                        <tr style="border:1px #black solid;">
                            <td colspan="7" style="border:none !important;">
                                <h2 class="my-1 text-left">
                                    Extra Credit Subject
                                </h2>
                            </td>
                        </tr>
                        @if($hasop)
                            @foreach ($data['marks_old'] as $datas)
                                @php
                                    $isabs=false;
                                    $_totgrade=0;
                                    $_totalcredit=0;
                                    $_finalGrade='ABS';
                                    $_finalGradePoint='ABS';
                                    foreach ($datas as $dataitem){
                                        if($dataitem->is_absent || $isabs){
                                            $isabs=true;
                                        }else{
                                            $_totgrade+= $dataitem->total_gpa_point * $dataitem->credit_hour;
                                            $_totalcredit+=$dataitem->credit_hour;
                                        }
                                    }

                                    if(!$isabs){
                                        $_finalGradePoint=round($_totgrade/$_totalcredit,2);
                                        if($_finalGradePoint==0){
                                            $_finalGrade='NG';
                                        }else{
                                            $_=$grades->where('from','<=',$_finalGradePoint )->where('up','>=',$_finalGradePoint)->first();
                                        
                                            if($_){
                                                $_finalGrade=$_->grade_name;
                                            }

                                        }
                                    }

                                @endphp
                                @foreach ($datas as $key=>$dataitem)
                                    @if($dataitem->isop)
                                        <tr style="border:none !important;">
                                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;">{{ $dataitem->code }}</td>
                                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;">{{ $dataitem->name }}</td>
                                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;">{{ $dataitem->credit_hour}}</td>
                                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;">{{ $dataitem->is_absent?'ABS':number_format((float)($dataitem->total_gpa_point),2,'.','')}}</td>
                                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;">{{ $dataitem->is_absent?'ABS':$dataitem->total_gpa_grade }}</td>
                                            @if($key==0)
                                                <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;" rowspan="2">{{ $_finalGrade }}</td>
                                            @endif
                                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important; text-align: left !important;text-transform: uppercase;"></td>

                                        </tr>
                                    
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                        <tr style="border:1px solid black !important;">
                            <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                            <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                            <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                            <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                            <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                            <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                            <td style="padding:12px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" ></td>
                        </tr>
                        @endif
                    </tfoot>
            </table>
            

           
           
            <div style="margin-top:4rem; visibility: hidden;">hello</div>

            <div class="row mt-5">
                <div class="col-4 text-center">
                    <span style="width:200px;display:inline-block;border-bottom:1px dotted black;">

                    </span>
                    <br>
                    <span>
                        PREPARED BY
                    </span>
                    

                </div>

                <div class="col-4 text-center">
                   
                    

                </div>

                <div class="col-4 text-center">
                    <span style="width:200px;display:inline-block;border-bottom:1px dotted black;">

                    </span>
                    <br>
                    <span>
                        HEAD TEACHER
                    </span>
                </div>
            </div>


            <div class="issued mt-3">
                Issued Date : {{ date('Y-m-d') }}
            </div>
        </div> 
        <div style="width:100%;display:inline-block;border-bottom:1px solid black;margin:2rem 0 0 0;"></div>
        <div style="padding: 5px;">
            NOTE: ONE CREDIT HOUR EQUALS 32 CLOCK HOURS. <br>
          <span>TH = THEORY</span> <span style="margin-left: 4rem;">PR = PRACTICAL</span> <span style="margin-left: 4rem;">XC = EXPELLED</span> <br>
          <span>ABS = ABSENT</span> <span style="margin-left: 4rem;">W = WITHHELD</span>
        </div>
    </div>
    <div class="fs"></div>
    @endforeach
</div>

<script>
    function printDiv(id)
    {
        var divToPrint=document.getElementById(id);
        var newWin=window.open('Report','_blank');
        newWin.document.open();
        newWin.document.write('<html><head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="{{ asset("public/backEnd/css/print.css") }}"></head><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();

    }
</script>
@endsection