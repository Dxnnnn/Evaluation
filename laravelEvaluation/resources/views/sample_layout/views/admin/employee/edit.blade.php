@extends('layouts.user_app')
@section('title')
Update Employee
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/DateTimePicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.23.0/ui/trumbowyg.css">
@endpush
@section('maincontent')
<div id="employee">
	<span class="message">@include('flash-message')</span>
	<div>
		<div class="row" id="employee_row">
			<div class="col-12 grid-margin">
				<div class="card">
					<div class="card-body">
            <div class="row">
                <form class="flex-container-row" method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex-container-row d-flex flex-column col-sm-3">
                      <div class="col-sm-9">
                        <div class="margin-left-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="required modified-profile-form-group" title="Employee ID">Employee ID </label>
                                            <input type="text" name="emp_id" value="{{ old('emp_id', $employee->emp_id) }}"
                                                class="form-control @error('emp_id') is-invalid @enderror modified-form-control"
                                                placeholder="Employee ID " />
                                            @error('emp_id')
                                            <span class="error" style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="required modified-profile-form-group" title="User Status">User Status </label>
                                            <select name="user_status" class="form-control  @error('user_status') is-invalid @enderror">
                                                <option value="">User Status</option>
                                                @foreach (M_Employee::STATUS as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('user_status', $employee->user_status) == $key ? 'selected' : '' }}>{{ $value }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('user_status')
                                            <span class="error" style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="required modified-profile-form-group" title="User Role">User Role </label>
                                            <select name="user_role" class="form-control @error('user_role') is-invalid @enderror">
                                                <option value="">User Role</option>
                                                @foreach (M_Employee::ROLE as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('user_role', $employee->user_role) == $key ? 'selected' : '' }}>
                                                    {{ str_replace('_', ' ', $value) }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_role')
                                            <span class="error" style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="flex-container-row grow-1 profile-buttons-wrapper justify-content-center">
                        <button class="btn btn-dark btn-rounded btn-fw reset-password" data-id="{{$employee->id}}" data-name="{{ $employee->full_name }}" type="button" disabled style="height: 36px;">Reset Password</button>
                        <a href="{{ route('employee.list') }}" class="btn btn-danger btn-rounded btn-fw update-employee_cancel-button profile-cancel-button" type="button" disabled>Cancel</a>
                        <button class="btn btn-primary btn-rounded btn-fw save_btn" type="submit" disabled style="height: 36px;">Save</button>
                    </div>
                </form>
            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div >
<form action="{{ route('user.history.delete') }}" method="post" class="formToDelete">
    @csrf
    <input type="hidden" name="id" value="" class="inputField">
</form>
