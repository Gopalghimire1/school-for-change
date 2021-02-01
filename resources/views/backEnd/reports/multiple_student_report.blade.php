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
                <div class="col-md-2">
                    logo
                </div>
                <div class="col-md-8">
                    <h5>GOVERNMENT OF NEPAL</h5>
                    <h5>NATIONAL EXAMINATIONS BOARD</h5>
                    <h5 style="font-size:25px;">SCHOOL LEAVING CERTIFICATE EXAMINATION <br> GRADE-SHEET</h5>
                </div>
                <div class="col-md-2">
                    logo
                </div>
            </div>
            <div class="p-3">
                <h5>
                    <div class="d-flex">
                        <span>THE GRADE(S) SECURED BY :</span>
                        <span style="flex-grow: 1;border-bottom:2px dotted black;padding-right:20px;">{{$std->full_name}}</span>
                    </div>
                    DATE OF BIRTH : {{$std->date_of_birth}} <br>
                    REGISTRATION NO. : {{$std->admission_no}} SYMBOL NO. : {{$std->roll_no}} GRADE : {{$std->class->class_name}} <br>
                    OF............................................................................................................................................................................................<br>
                <span>IN THE EXAMINATION CONDUCTED BY THE NATIONAL EXAMINATIONS BOARD IN.................... ARE GIVEN BELOW.</h5>
            </div>

            <div class="col-md-12">
                
            <table class="w-100 mt-30 mb-20 table table-bordered marksheet">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Subject</th>
                        <th>Credit Hour</th>
                        <th>Grade Point</th>
                        <th>Grade</th>
                        <th>Final Grade</th>
                        <th>Remarks</th>
                    </tr>
                    <tbody>

                        @foreach ($data['marks'] as $data)
                        @foreach ($data as $item)
                        {{-- {{ dd($item) }} --}}
                        <tr>
                            <td>{{ $item->subject->subject_code }}</td>
                            <td>{{ $item->subject->subject_name }}</td>
                            <td>{{ $item->subject->credit_hour }}</td>
                            <td>{{ $item->total_gpa_point }}</td>
                            <td>{{ $item->total_gpa_grade }}</td>
                            <td>{{ $item->finalgradel }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </thead>
            </table>
            <div class="row">
                <div class="col-lg-12">
                
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