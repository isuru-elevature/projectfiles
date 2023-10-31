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
    $('#createDataSource').submit(function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: createDataSourceUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function success(result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#createDataSourceModal').modal('hide');
                    location.reload();
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBoxDS', result);
            },
        });
    }); 

    $('#createDataSourceModal').on('hidden.bs.modal', function () {
        resetModalForm('#createDataSource', '#validationErrorsBoxDS');
    });

    //get field and show data source field
    $(document).on('click','.data_sources_name',function(){
        var id = $(this).attr('id');
       
        $('.data_sources').css('background-color','#fff');
        $('#data_sources'+id).css('background-color','#C8D0D5');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getDataSourceType/'+id,
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                    var data = result.data[0].get_data_source_type;
                    var dataSourceName=result.data[0].name;
                    var resp_data ="";
                    console.log(result);
                    $.each(data, function(key, val) {
                      
                       resp_data+= `<div class="row data_source_field" id="data_source_field${val.id}">
                           <div class="col-10" style="cursor:pointer;">
                               <p class="data_source_type" data-sourceName="${dataSourceName}" data-sourceType="${val.dataSourceType}" id="${val.id}">${val.dataSourceName}</p>
                           </div>
                           <div class="col-2">
                                <a id="${val.id}" class="edit_data_source_type_btn">
                                <img src="${window.location.origin}/public/images/Icons/edit.svg" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                                </a>
                           </div>
                       </div>`
                    })
                    $('.data_field').html(resp_data);
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
    });


    //Create Data Source Type
    $('#createDataSourceType').submit(function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: createDataSourceTypeUrl,
            type: 'POST',
            data: $(this).serialize(),
            success: function success(result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#createDataSourceTypeModal').modal('hide');
                    location.reload();
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBoxDST', result);
            },
        });
    }); 

    $('#createDataSourceTypeModal').on('hidden.bs.modal', function () {
        resetModalForm('#createDataSourceType', '#validationErrorsBoxDST');
    });

    $(document).on('click','.data_source_type',function(){
        var id = $(this).attr('id');

        var text = $(this).text();
        var dataSourceType=$(this).attr('data-sourceType');
        var dataSourceName=$(this).attr('data-sourceName');
       
        console.log('datasourcetype ',dataSourceType,dataSourceName);
        $('.data_source_field').css('background-color','#fff');
        $('#data_source_field'+id).css('background-color','#C8D0D5');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getDataSourceOption/'+text,
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                    var data = result.data;
                    var resp_data ="";
                    $.each(data, function(key, val) {
                        // console.log(val.id);
                        // console.log(val.data_source_type);
                        resp_data+= `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options" data-val="${val.option_value}" id="${val.id}">${val.option_name}</p>
                            </div>
                            <div class="col-2">
                                <a  id="${val.id}" class="getDataSourceOptionBtn" style="cursor:pointer;">
                                <img src="${window.location.origin}/public/images/Icons/edit.svg" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                                </a>
                            </div>
                        </div>`
                    })
                    $('.data_options').html(resp_data);
                }
            },
            // error: function error(result) {
            //     printErrorMessage('#validationErrorsBox', result);
            // },
        });

        var text = $(this).text();
       
        $("#result").val(function() {

            if(dataSourceType=='Participant'){

                if($(this).val() == '') {
                    return text + '|'+ dataSourceName;
                } else {
                    return text + '|'+ dataSourceName;
                }
            
            }else if(dataSourceType=='matter_info' || dataSourceType=='crm_info' || dataSourceType=='FamilyLawDetail' || dataSourceType=='key_dates'){

                if($(this).val() == '') {
                    return dataSourceName+ '|'+ text ;
                } else {
                    return dataSourceName+ '|'+ text ;;
                }
    
            }else{

                if($(this).val() == '') {
                    return text;
                } else {
                    return text;
                }
            }
            
        });
    });

    $(document).on('click','.data_source_options',function (event) {
        event.preventDefault();
        var text = $(this).attr('data-val');

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


    // Getting Data Source Options By Option Type
    $(document).on('click','.field_option_icon',function(){
        var id = $(this).attr('data-id');
        if(id=='Flip' ){
        $(this).toggleClass("toggleclass");
        }

        var className=$(this).is('.toggleclass');
        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getDataSourceOptionByType/'+id,
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                    var data = result.data;
                    var resp_data ="";
                    $.each(data, function(key, val) {
                        if(id!='Flip' || className==true){
                        resp_data+= `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options" data-val="${val.option_value}" id="${val.id}">${val.option_name}</p>
                            </div>
                            <div class="col-2">
                                <a  id="${val.id}" class="getDataSourceOptionBtn" style="cursor:pointer;">
                                <img src="${window.location.origin}/public/images/Icons/edit.svg" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">

                                </a>
                            </div>
                        </div>`;
                        }
                        else{
                            resp_data+= `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options" data-val="${val.option_value}" id="${val.id}">${val.option_value}</p>
                            </div>
                            <div class="col-2">
                                <a  id="${val.id}" class="getDataSourceOptionBtn" style="cursor:pointer;">
                                <img src="${window.location.origin}/public/images/Icons/edit.svg" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                                </a>
                            </div>
                        </div>`;
                        }
                    })
                    $('.data_options').html(resp_data);
                }
            },
           
        });
    });


    // Functions 
    window.printErrorMessage = function (selector, errorResult) {
        $(selector).show().html('');
        console.log(errorResult.responseJSON.error);
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