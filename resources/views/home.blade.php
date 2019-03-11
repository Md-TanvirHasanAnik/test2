
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Student Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div id="form" class="form-area">
                            <form action="#" id="appointmentForm" method="post" accept-charset="utf-8">
                                <input type="hidden" name="csrf_stream_token" value="447a6832bb22061e6b48ae857b7bf5c8" />

                                <div class="form-padding">
                                    <h4>Appointment Form</h4>



                                    <div class="form-group">
                                        <label>Department Name <i class="text-danger">*</i></label>
                                        <select name="department_id" class="form-control" id="department_id">
                                            <option value="" selected="selected">Select Department</option>
                                            <option value="12">CSE</option>
                                            <option value="13">SWE</option>
                                            <option value="14">EEE</option>
                                            <option value="15">BBA</option>
                                            <option value="16">Textile</option>
                                            <option value="17">LLB</option>
                                            <option value="19">Pharmacy</option>
                                            <option value="21">NFE</option>
                                        </select>
                                        <span class="doctor_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Faculty Name<i class="text-danger">*</i></label>
                                        <select name="doctor_id" class="form-control" id="doctor_id">
                                            <option value="0"></option>
                                        </select>
                                        <p class="help-block" id="available_days"></p>
                                    </div>

                                    <div class="form-group">
                                        <label>Appointment Date <i class="text-danger">*</i></label>
                                        <div class="input-group date col-md-4" data-provide="datepicker">
                                            <input type="text" name="date" class="form-control" placeholder="dd-mm-yyyy">
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Select Time<i class="text-danger">*</i></label>
                                            <input name="time_id" autocomplete="off" type="text" class="form-control" id="patient_id" placeholder="Time" value="">
                                            <span></span>
                                        </div>

                                    <div class="form-group">
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
                                </div>
                            </form>
                        </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection

