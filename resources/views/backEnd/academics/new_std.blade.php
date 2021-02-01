@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>New Student</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.academics')</a>
                <a href="#">New Student</a>
            </div>
        </div>
    </div>
</section>

<form action="{{ route('new_student_store',[$classs_id,$section_id])}}" method="POST">
@csrf
<div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="full">Symbol Number</label>
                <input type="number" class="form-control" name="roll">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="full">Admission Number</label>
                <input type="number" class="form-control" name="adm">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="full">Full Name*</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
        </div>
        {{-- <div class="col-12">
            <div class="form-group">
                <select name="session_id" class="form-control">
                    @foreach ($session as $ses)
                        <option value="{{ $ses->id }}">{{ $ses->session }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
        <div class="col-12">
            <button class="btn btn-primary btn-sm btn-block">Save Student</button>
        </div>
    </div>
</form>
@endsection