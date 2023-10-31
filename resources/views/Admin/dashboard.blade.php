@extends('layouts.app')
@section('heading','Dashboard')
@section('navLinkDashboard','active')
@section('dashboardMenu','menu-open')
@section('content')

<div class="container-fluid">
    
    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="text-right mb-2">
          <button class="btn action-btn btn-primary btn-md  text-light" data-bs-toggle="modal" data-bs-target="#createUserModal" >Create New User</button>
        </div>
        <table class="table table-responsive-sm" id="usersTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Create Date</th>
                    <th>Last Login</th>
                    <th>Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>
    </section>
    </div>
   
 </div>
 
<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(['id'=>'createUser']) !!}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display: none" id="validationErrorsBox"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- update User Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Update User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(['id'=>'updateUser']) !!}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display: none" id="updateValidationErrorsBox"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="updateName">Name</label>
                                <input type="text" name="name" id="updateName" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="updateEmail">Email</label>
                                <input type="email" name="email" id="updateEmail" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="updatePassword">Password</label>
                                <input type="password" name="password" id="updatePassword" class="form-control" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="updatePassword_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="updatePassword_confirmation" class="form-control" >
                                <span class="password_confirmation_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="updateRole">Role</label>
                                <select name="role" id="updateRole" class="form-control" required>
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="userId" id="userId" class="form-control">
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    let createUserUrl = "{{route('Admin/createUser')}}";
    let updateUserUrl = "{{route('Admin/updateUser')}}";
    let changeUserRole= "{{url('Admin/changeUserRole')}}";
   
</script>

 <script>
 $(document).ready( function () {

    let usersTable = new DataTable('#usersTable', {
        "bDestroy": true,
        ajax: {
            url: "{{url('Admin/dashboard')}}",
        },
        columnDefs: [
            {
                'targets': [5],
                'className': 'text-center',
            },
        ],
        columns: [
            
            {  
                data:'Sno',
                name:'sno'
            },
            {  
                data:'name',
                name:'name'
            },
            {  
                data:'email',
                name:'email'
            },
            {  
                data:'create_date',
                name:'create_date'
            },
            {  
                data:'name',
                name:'name'
            },
            {  
                data: function data(row) {
                    var checked = '';
                    var disable = '';
                    if(row.role == 'Admin') {
                        checked = 'checked';
                    }
                    if(row.id=='1'){
                         disable='disabled';
                    }
                    return `
                        <div class="form-check form-switch">
                          
                            <input class="form-check-input changeRole" type="checkbox" value=${row.role} data-id="${row.id}" role="switch" id="is_admin " ${checked} ${disable}>
                           </div>`;
                },
                name:'name'
            },
            {  
                data: function data(row) {
                    return '<a title="Edit" data-bs-toggle="modal" data-bs-target="#updateUserModal" class="btn  editUser action-btn btn-primary btn-sm text-light edit_btn" data-id="' + row.id + '">' + '<i class="fa fa-pencil"></i>' + '</a>' + '<a title="Delete" class="ms-1 btn action-btn text-light btn-danger btn-sm delete_btn" data-id="' + row.id + '">' + '<i class="fa fa-trash" ></i></a>';
                },
                name:'name'
            },
            
        ],
    });
} );
</script>


@endsection