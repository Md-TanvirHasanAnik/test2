@extends('layouts.app_faculty')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Faculty Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                        <?php echo Auth::user()->f_id; ?>

                        <div id="form" class="form-area">
                            <form action="http://hospitalnew.bdtask.com/demo6/website/appointment/create" id="appointmentForm" method="post" accept-charset="utf-8">
                                <input type="hidden" name="csrf_stream_token" value="447a6832bb22061e6b48ae857b7bf5c8" />

                                <div class="form-padding">
                                    <h4>Appointment Form</h4>

                                    <!-- patient id -->
                                    <div class="form-group">
                                        <label>Patient ID <i class="text-danger">*</i></label>
                                        <input name="patient_id" autocomplete="off" type="text" class="form-control" id="patient_id" placeholder="Patient ID" value="">
                                        <span></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Department Name <i class="text-danger">*</i></label>
                                        <select name="department_id" class="form-control" id="department_id">
                                            <option value="" selected="selected">Select Department</option>
                                            <option value="12">Microbiology</option>
                                            <option value="13">Neonatal</option>
                                            <option value="14">Nephrology</option>
                                            <option value="15">Neurology</option>
                                            <option value="16">Oncology</option>
                                            <option value="17">Orthopaedics</option>
                                            <option value="19">Radiotherapy</option>
                                            <option value="21">Rheumatology</option>
                                            <option value="22">Gynaecology</option>
                                            <option value="23">Obstetrics</option>
                                            <option value="25">General Surgery</option>
                                        </select>
                                        <span class="doctor_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Doctor Name<i class="text-danger">*</i></label>
                                        <select name="doctor_id" class="form-control" id="doctor_id">
                                            <option value="0"></option>
                                        </select>
                                        <p class="help-block" id="available_days"></p>
                                    </div>

                                    <div class="form-group">
                                        <label>Appointment Date <i class="text-danger">*</i></label>
                                        <input name="date" type="text" class="datepicker-avaiable-days form-control" id="date" placeholder="Appointment Date" >
                                    </div>

                                    <div class="form-group">
                                        <label>Serial No <i class="text-danger">*</i></label>
                                        <div id="serial_preview">
                                            <div class="btn btn-success disabled btn-sm"> 01</div>
                                            <div class="btn btn-success disabled btn-sm"> 02</div>
                                            <div class="btn btn-success disabled btn-sm"> 03</div>...
                                            <div class="slbtn btn btn-success disabled btn-sm"> N</div>

                                        </div>
                                        <input type="hidden" name="schedule_id" id="schedule_id"/>
                                        <input type="hidden" name="serial_no" id="serial_no"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Problem </label>
                                        <textarea name="problem" class="form-control" placeholder="Problem"  rows="7"></textarea>
                                    </div>

                                </div>

                                <div class="form-footer">
                                    <div class="checkbox">
                                        <label></label>
                                    </div>
                                    <button type="submit" id="submit" class="btn thm-btn">Submit</button>
                                </div>

                            </form>
                        </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

