@extends('student.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" id="registerForm" action="{{ route('register') }}" autocomplete="off">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="s_id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-md-6">
                                <input id="s_id" type="text" class="form-control{{ $errors->has('s_id') ? ' is-invalid' : '' }}" name="s_id" value="{{ old('s_id') }}" required autofocus>

                                @if ($errors->has('s_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('s_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                {{--<input id="department" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ old('department') }}" required autofocus>--}}
                                <select name="department" class="form-control" id="department" >
                                    {{--<option value="" selected="selected" disabled>Select Department</option>--}}
                                    <option value="CSE">CSE</option>
                                    <option value="SWE">SWE</option>
                                    <option value="EEE">EEE</option>
                                    <option value="BBA">BBA</option>
                                    <option value="Textile">Textile</option>
                                    <option value="LAW">LAW</option>
                                    <option value="Pharmacy">Pharmacy</option>
                                    <option value="NFE">NFE</option>
                                </select>
                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="level_term" class="col-md-4 col-form-label text-md-right">{{ __('Level-Term') }}</label>

                            <div class="col-md-6">
                                {{--<input id="campus" type="text" class="form-control{{ $errors->has('campus') ? ' is-invalid' : '' }}" name="campus" value="{{ old('campus') }}" required autofocus>--}}
                                <select name="level_term" class="form-control" id="level_term" >
                                    {{--<option value="" selected="selected" disabled>Select Level-Term</option>--}}
                                    <option value="Level 1 Term 1">Level 1 Term 1</option>
                                    <option value="Level 1 Term 1">Level 1 Term 2</option>
                                    <option value="Level 1 Term 1">Level 1 Term 3</option>
                                    <option value="Level 1 Term 1">Level 2 Term 1</option>
                                    <option value="Level 1 Term 1">Level 2 Term 2</option>
                                    <option value="Level 1 Term 1">Level 2 Term 3</option>
                                    <option value="Level 1 Term 1">Level 3 Term 1</option>
                                    <option value="Level 1 Term 1">Level 3 Term 2</option>
                                    <option value="Level 1 Term 1">Level 3 Term 3</option>
                                    <option value="Level 1 Term 1">Level 4 Term 1</option>
                                    <option value="Level 1 Term 1">Level 4 Term 2</option>
                                    <option value="Level 1 Term 1">Level 4 Term 3</option>
                                </select>
                                @if ($errors->has('level_term'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('level_term') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="campus" class="col-md-4 col-form-label text-md-right">{{ __('Campus') }}</label>

                            <div class="col-md-6">
                                {{--<input id="campus" type="text" class="form-control{{ $errors->has('campus') ? ' is-invalid' : '' }}" name="campus" value="{{ old('campus') }}" required autofocus>--}}
                                <select name="campus" class="form-control" id="department" >
                                    {{--<option value="" selected="selected" disabled>Select Campus</option>--}}
                                    <option value="Ashulia">Ashulia</option>
                                    <option value="Dhanmondi">Dhanmondi</option>
                                    <option value="Uttara">Uttara</option>
                                </select>
                                @if ($errors->has('campus'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('campus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{--submit--}}
{{--<script type="text/javascript">--}}
    {{--$(document).ready(function(){--}}
        {{--$('#registerForm').on('submit',function(event){--}}

            {{--event.preventDefault();--}}
            {{--var data=$(this).serialize();--}}


            {{--$.ajax({--}}
                {{--method:'POST',--}}
                {{--url:'{{route('appointment.store')}}',--}}
                {{--data:data,--}}
                {{--success:function(data){--}}
                    {{--console.log(data);--}}
                    {{--console.log(data.length);--}}

                    {{--if (data.type==="success"){--}}
                        {{--toastr.success(data.message);--}}

                        {{--$('#appointmentForm')[0].reset();--}}

                        {{--$('#appointments-taken').html("");--}}
                        {{--$('#available_slots').html("");--}}

                        {{--$('#starts_at').val("");--}}
                        {{--$('#ends_at').val("");--}}
                    {{--}--}}
                    {{--if (data.type==="error"){--}}
                        {{--toastr.error(data.message);--}}
                    {{--}--}}
                    {{--if (data.type==="warning"){--}}
                        {{--toastr.warning(data.message);--}}
                    {{--}--}}


                {{--},--}}
                {{--error:function(){--}}

                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
@endsection
