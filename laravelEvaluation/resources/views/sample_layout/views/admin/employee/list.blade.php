@extends('layouts.user_app')
@section('title')
    Employee
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/spinner/spin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
@endpush


@php
$condition['employee_id'] = isset($condition['employee_id']) ? $condition['employee_id'] : '';
$condition['first_name'] = isset($condition['first_name']) ? $condition['first_name'] : '';
$condition['last_name'] = isset($condition['last_name']) ? $condition['last_name'] : '';
$condition['account_id'] = isset($condition['account_id']) ? $condition['account_id'] : '';
$condition['user_status'] = isset($condition['user_status']) ? $condition['user_status'] : '';
$condition['role'] = isset($condition['role']) ? $condition['role'] : '';
$condition['is_wfh'] = isset($condition['is_wfh']) ? $condition['is_wfh'] : '3';
$ROLE = [
    1 => 'USER',
    2 => 'WFM',
    3 => 'ADMIN',
    4 => 'REPORT MANAGER',
];
$STATUS = [
    1 => 'Active',
    2 => 'Block',
];
@endphp

@section('maincontent')
    <div class="employee-page_wrapper">
        @include('flash-message')
        <div>
            <div class="row" id="employee_list">
                <div class="col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('employee.search') }}" method="get" class="form-sample">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control form-control-lg" id="employee_id"
                                                    name="employee_id" placeholder="Employee ID"
                                                    value="{{ $condition['employee_id'] ? $condition['employee_id'] : '' }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control form-control-lg" id="first_name"
                                                    name="first_name" placeholder="First Name"
                                                    value="{{ $condition['first_name'] ? $condition['first_name'] : '' }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control form-control-lg" id="last_name"
                                                    name="last_name" placeholder="Last Name"
                                                    value="{{ $condition['last_name'] ? $condition['last_name'] : '' }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="account_id" name="account_id" class="form-control"
                                                    aria-placeholder="Account">
                                                    <option value="" class="form-control form-control-lg">Accounts</option>
                                                    @foreach ($accounts as $account)
                                                        @if ($condition)
                                                            @if ($condition['account_id'] == $account->id)
                                                                <option value="{{ $account->id }}"
                                                                    class="form-control form-control-lg" selected>
                                                                    {{ $account->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $account->id }}"
                                                                    class="form-control form-control-lg">
                                                                    {{ $account->name }}
                                                                </option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <select id="user_status" name="user_status" class="form-control"
                                                    aria-placeholder="User Status">
                                                    <option value="" class="form-control form-control-lg">User Status
                                                    </option>
                                                    @foreach ($STATUS as $key => $status)
                                                        @if (isset($condition) && $key == $condition['user_status'])
                                                            <option value="{{ $key }}" selected>
                                                                {{ $status }}</option>
                                                        @else
                                                            <option value="{{ $key }}">{{ $status }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3 attendance_button-wrapper">
                                                <select id="workbase-employee" name="is_wfh" class="form-control"
                                                    aria-placeholder="Status">
                                                    <option value="2" class="form-control form-control-lg">Work Base
                                                    </option>
                                                    @foreach (M_Attendance::BASE as $is_wfh => $key)
                                                        @if (isset($condition) && $key == $condition['is_wfh'])
                                                            <option value="{{ $key }}" selected>
                                                                {{ $is_wfh }}</option>
                                                        @else
                                                            <option value="{{ $key }}">{{ $is_wfh }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="role" name="role" class="form-control"
                                                    aria-placeholder="Role">
                                                    <option value="" class="form-control form-control-lg">Role</option>
                                                    @foreach ($ROLE as $key => $role)
                                                        @if (isset($condition) && $key == $condition['role'])
                                                            <option value="{{ $key }}" selected>
                                                                {{ $role }}</option>
                                                        @else
                                                            <option value="{{ $key }}">{{ $role }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3 attendance_button-wrapper">
                                                <button type="submit"
                                                    class="btn btn-primary btn-rounded btn-fw employee_search-button">Search</button>
                                                <button type="button"
                                                    class="btn btn-primary btn-rounded btn-fw search-reset employee_reset-button" id="search-employee-reset">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @if (!$is_rm)
                                <a href="{{ route('employee.create') }}" id="emp_add"
                                    class="btn btn-primary btn-rounded btn-fw add-employee_button">Add Employee</a>
                            @endif

                            @include('common._showentries')

                            <table class="table table-striped table-bordered nowrap" id="emp-table" width="100%">
                                {{-- employee-table --}}
                                <thead>
                                    <tr>
                                        <th> Employee ID </th>
                                        <th> First Name </th>
                                        <th> Last Name </th>
                                        <th> Employee Type </th>
                                        <th> Account </th>
                                        <th> User Status </th>
                                        <th> User Role </th>
                                        @if (!$is_rm)
                                            <th> Actions </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->emp_id }}</td>
                                            <td>{{ $employee->first_name }}</td>
                                            <td>{{ $employee->last_name }}</td>
                                            <td>{{ $employee->emp_statuses }}</td>
                                            @if (empty($employee->account))
                                                <td></td>
                                            @else
                                                <td>{{ $employee->account->name }}</td>
                                            @endif
                                            <td>{{ $employee->user_statuses }}</td>
                                            <td>{{ str_replace('_', ' ', $employee->user_roles) }}</td>
                                            @if (!$is_rm)
                                                <td>
                                                    <a href="{{ route('employee.edit', $employee->id) }}"><em
                                                            class="fa fa-pencil-square-o" title="Update"></em></a>
                                                    <a href="#" class="btn-delete" data-id="{{ $employee->id }}"><em
                                                            class="fa fa-trash-o employee_delete" title="Delete"></em></a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </table>
                            <div class="d-flex justify-content-center" style="margin-top:50px">
                                {!! $employees->appends(request()->except(['page']))->links() !!}
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit"
                                    class="btn btn-secondary btn-fw search-attendance attendance_search-button"
                                    style="width: 170px;" id="download-employees-list">Download Excel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
