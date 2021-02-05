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
    <div>
        <input type="checkbox" name="abc" id="signgle" onchange="
        document.getElementById('select_student_div').style.display=this.checked?'flex':'none';
    ">
        <label for="relationFather">For Single Student</label>
    </div>
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

            
            <div class="col-lg-12 mt-20 text-right">
                <button type="submit" class="primary-btn small fix-gr-bg">
                    <span class="ti-search"></span>
                    @lang('lang.search')
                </button>
            </div>
        </div>
    {{ Form::close() }}
</div>
<div class="mt-4" id="printdiv">
    @foreach ($datas as $data)
        @php
            $std=$data['std'];
            // dd($std);
        @endphp
        <div class="card-body" >
            <div class="row text-center mb-5">
                <div class="col-2">
                    logo
                </div>
                <div class="col-8">
                    <h3>{{$name}}</h3>
                   
                    <h5 style="font-size:25px;">{{$address}} <br> GRADE-SHEET</h5>
                </div>

            </div>
            <div class="p-3">
                <h5>
                    <div class="d-flex mb-1">
                        <span>THE FOLLOWING ARE THE GRADE(S) OBTAINED BY:  </span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;">{{$std->full_name}}</span>
                    </div>
                    <div class="d-flex mb-1">
                        <span> DATE OF BIRTH : </span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;">{{$std->date_of_birth}} BS</span>
                    </div>
                    <div class="mb-1" style="display: flex; justify-content: space-between">
                        <span style="flex:1;">REGISTRATION NO. : <span style="border-bottom:2px dotted black;padding:0px 20px;">{{$std->regno}}</span></span>
                        <span style="flex:1;">SYMBOL NO. : <span style="border-bottom:2px dotted black;padding:0px 20px;">{{$std->roll_no}}</span></span>
                        <span style="flex:1;">GRADE : <span style="border-bottom:2px dotted black;padding:0px 20px;">{{$std->class->class_name}}</span></span>
                    </div>
                    
                    <div class="d-flex mb-1">
                        <span>IN THE ANNUAL EXAMINATION CONDUCTED BY SCHOOL/CAMPUS IN </span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;"> </span>
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
                        <th style="border-left:1px solid black;border-right:1px solid black;">Code</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">Subject</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">Credit Hour</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">Grade Point</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">Grade</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">Final Grade</th>
                        <th style="border-left:1px solid black;border-right:1px solid black;">Remarks</th>
                    </tr>
                </thead>
                
                    <tbody>

                        @php
                            $tt=0;
                        @endphp
                        @foreach ($data['marks'] as $dataitem)
                        @foreach ($dataitem as $item)
                        {{-- {{ dd($item) }} --}}
                        <tr style="border:none !important;">
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;">{{ $item->subject->subject_code }}</td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;">{{ $item->subject->subject_name }}</td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;">{{ $item->subject->credit_hour }}</td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;">{{ $item->total_gpa_point }}</td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;">{{ $item->total_gpa_grade }}</td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;">{{ $item->finalgradel }}</td>
                            <td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black !important;"></td>
                        </tr>
                        @php
                            $tt+=1;
                        @endphp
                        @endforeach
                        @endforeach
                        @for ($i = $tt; $i < 15; $i++)
                            <tr style="border:none !important;"><td style="padding:5px !important;border-top:none !important;border-bottom:none  !important;border-left:1px solid black !important;border-right:1px solid black  !important;" colspan="7"></td></tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                
                            </th>
                            <th>
                                Total
                            </th>
                            <th></th>
                            <th></th>
                            <th colspan="3">
                                GRADE POINT AVERAGE(GPA): {{round($data['gpa'],2)}}
                            </th>
                            
                        </tr>
                    </tfoot>
            </table>
           
           
            <div class="mt-5">PREPARED BY:</div>

            <div class="row mt-5">
                <div class="col-6 text-center">
                    <span style="width:200px;display:inline-block;border-bottom:1px dotted black;">

                    </span>
                    <br>
                    <span>
                        Class Teacher
                    </span>
                    

                </div>
                <div class="col-6 text-center">
                    <span style="width:200px;display:inline-block;border-bottom:1px dotted black;">

                    </span>
                    <br>
                    <span>
                        HEAD MASTER/CAMPUS CHIEF
                    </span>
                </div>
            </div>


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