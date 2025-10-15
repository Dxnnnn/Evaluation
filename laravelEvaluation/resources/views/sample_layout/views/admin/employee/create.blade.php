@extends('layouts.user_app')
@section('title')
Create Employee
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendors/timepicker/jquery.timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/DateTimePicker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
@endpush

@section('maincontent')
<div class="employee-page_wrapper">
    @include('flash-message')
    <div>
        <div class="row" id="employee_row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form class="flex-container-row" method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex flex-row col-sm-3 justify-content-center">
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
                                <div class="flex-container-row grow-1 add-employee_button-group justify-content-center">
                                    <a href="{{ route('employee.list') }}" class="btn btn-danger btn-rounded btn-fw cancel_btn profile-cancel-button" type="button">Cancel</a>
                                    <button class="btn btn-primary btn-rounded btn-fw save_btn add-emplyyee_save-button"  type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
