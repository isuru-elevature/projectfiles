$(document).ready(function() {
    $('#createUser').submit(function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: createUserUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function success(result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#createUserModal').modal('hide');
                    $('#usersTable').DataTable().ajax.reload();
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
    }); 

    $('#createUserModal').on('hidden.bs.modal', function () {
        resetModalForm('#createUser', '#validationErrorsBox');
    });
     //edit form data 
     $(document).on('click', '.editUser', function (event) {
        event.preventDefault();
        var id = $(event.currentTarget).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "editUser"+"/"+id,
            type: 'get',
           
            success: function success(result) {
                console.log(result);
                if (result.success) {
                   
                    $("#updateName").val(result.data.name);
                    $("#userId").val(result.data.id);
                    $("#updateEmail").val(result.data.email);
                    if(result.data.id=='1'){
                        $("select > option[value=" + result.data.role + "]").prop("selected",true);
                        $("select").prop('disabled', true);
                    }
                    else{
                        $("select").prop('disabled', false);
                        $("select > option[value=" + result.data.role + "]").prop("selected",true);
                    }
                   
                    // $("#updatePassword").val(result.data.name);
                    // $("#updatePassword_confirmation").val(result.data.name);
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
    }); 
     //change role of user 
    
        $(document).on('change', '.changeRole', function (event) {
       
        var id = $(event.currentTarget).data('id');
        var role = $(event.currentTarget).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: changeUserRole,
            type: 'post',
           data:{role:role,id:id},
            success: function success(result) {
                console.log(result);
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#usersTable').DataTable().ajax.reload();
                   
                }

            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
    }); 
    //update user model 
    $('#updateUser').submit(function (event) {
        event.preventDefault();
       
         var data=$(this).serialize();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: updateUserUrl,
            type: 'POST',
            data: data,
            success: function success(result) {
                console.log(result);
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#updateUserModal').modal('hide');
                    $('#usersTable').DataTable().ajax.reload();
                }
            },
            error: function error(result) {
                printErrorMessage('#updateValidationErrorsBox', result);
            },
        });
    }); 

    $('#updateUserModal').on('hidden.bs.modal', function () {
        resetModalForm('#updateUser', '#updateValidationErrorsBox');
    });


    $(document).on('click', '.delete_btn', function (event) {
        var id = $(event.currentTarget).data('id');
        deleteItem('../Admin/deleteUser/' + id, '#usersTable', 'User');
    });


    //Create Data Source
   

    $('#createDataSourceModal').on('hidden.bs.modal', function () {
        resetModalForm('#createDataSource', '#validationErrorsBoxDS');
    });

    //get field and show data source field
   



    $('#createDataSourceTypeModal').on('hidden.bs.modal', function () {
        resetModalForm('#createDataSourceType', '#validationErrorsBoxDST');
    });

    

    $(document).on('click','.data_source_options',function (event) {
        event.preventDefault();
        var text = $(this).attr('data-val');
        var id = $(this).attr('id');
       var type=$(this).attr('data-sourcetype');
    //    console.log(type)
        $('.data_source_option').css('background-color','#fff');
        $('#data_source_option'+id).css('background-color','#C8D0D5');
           
                $("#result").val(function() {
                    if($(this).val()) {
                        return this.value + '|' + text;
                    } else {
                        return text;
                    }
                });
            
      
    });


    //Create Data Source Option
    $('#createDataSourceOption').submit(function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: createDataSourceOptionUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function success(result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#createDataSourceOptionModal').modal('hide');
                    location.reload();
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBoxDSO', result);
            },
        });
    }); 

    $('#createDataSourceOptionModal').on('hidden.bs.modal', function () {
        resetModalForm('#createDataSourceOption', '#validationErrorsBoxDSO');
    });



    


    

    // Functions 
    window.printErrorMessage = function (selector, errorResult) {
        $(selector).show().html('');
        // console.log(errorResult.responseJSON.error);
        $(selector).text(errorResult.responseJSON.error);
    };
      
    window.resetModalForm = function (formId, validationBox) {
        $(formId)[0].reset();
        $(validationBox).hide();
    };
    window.displaySuccessMessage = function (message) {
        $.toast({
          heading: 'Success',
          text: message,
          showHideTransition: 'slide',
          icon: 'success',
          position: 'top-right'
        });
    };
    window.deleteItem = function (url, tableId, header) {
        var callFunction = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
        swal({
          title: 'Delete !',
          text: 'Are you sure you want to delete this "' + header + '" ?',
          type: 'warning',
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          confirmButtonColor: '#5cb85c',
          cancelButtonColor: '#d33',
          cancelButtonText: 'No',
          confirmButtonText: 'Yes'
        }, function () {
          deleteItemAjax(url, tableId, header, callFunction = null);
        });
    };

    function deleteItemAjax(url, tableId, header) {
        var callFunction = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
        $.ajax({
          url: url,
          type: 'get',
          dataType: 'json',
          success: function success(obj) {
            if (obj.success) {
                $(tableId).DataTable().ajax.reload(null, false);
            }
      
            swal({
              title: 'Deleted!',
              text: header + ' has been deleted.',
              type: 'success',
              timer: 2000
            });

      
            if (callFunction) {
              eval(callFunction);
            }
          },
          error: function error(data) {
            swal({
              title: '',
              text: data.responseJSON.message,
              type: 'error',
              timer: 5000
            });
          }
        });
    }
});

