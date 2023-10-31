@extends('layouts.userApp')
@section('content')
    <style>
        .text-xl {
            font-size:1.5rem;
            color:#234765;
        }

        hr {
            height:3px !important; 
            color:#234765;
        }

        .main-container {
            color:#234765;
        }

        .min-h-screen {
            background-color:#F5F5F5 !important;
        }

        .card {
            min-height:322px;
            max-height:322px;
            overflow-x: hidden;
        }

        .field_option_icon {
            width: 1.8rem;
            height: 1.5rem;
            cursor: pointer;
        }
        
        .editIcon {
            height: 1.1rem;
            cursor: pointer;
        }

        .data_source_field {
            padding: 3px 0px;
        }

        .data_sources {
            padding: 3px 0px;
        }

        .data_source_option {
            padding: 3px 0px;
        }

        #result {
            border-color:#dededf !important;
        }

        .size {
            font-size: 14px !important;
        }
        footer{
            background-color:#113C54;
        }
    </style>
    <!-- <x-slot name="header">
        <h1 class="font-semibold fw-bolder text-xl text-gray-800 leading-tight" >
            {{ __('Merge Field Coding Tool') }}
        </h1>
        <hr class="mt-3">
        
    </x-slot> -->
   
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 main-container">
        <div class="row">
       
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="">Select Data Source</label>
                <div class="card ">
                    <div class="card-body p-0 px-2">
                        <div class="data-source">
                           
                        @foreach($dataSources as $data)
                        @if($data->status==1)
                        

                            <div class="row data_sources" id="data_sources{{$data->id}}">
                                <div class="col-10" style="cursor:pointer;">
                                    <!-- <p class="data_sources_name size"  id="{{$data->id}}">{{strtolower($data->name)}}</p> --> 
                                    <p class="data_sources_name size" type="{{$data->data_source_type}}"  id="{{$data->id}}">{{$data->name}}</p>
                                </div>
                                <div class="col-2">
                             
                              <button class="delete_dataSource" data-id="{{$data->id}}"><i class="fa fa-trash color" aria-hidden="true"></i></button>
                                <a id="{{$data->id}}" style="cursor:pointer;" class="edit_data_source">
                                    <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit" >
                                </a>
                                </div>
                            </div>
                           
                            @endif
                        @endforeach
                      
                    </div>
                       
                    </div>
                </div>
              
                    <a href="#" class="btn btn-sm float-start my-3 create_btn" data-bs-toggle="modal" data-bs-target="#createDataSourceModal"><i class="fa fa fa-plus"></i> CREATE DATA SOURCE</a>
              
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="">Select A Field</label>
                <div class="card ">
                    <div class="card-body p-0 px-2 data_field">

                    </div>
                </div>
                
                    <a href="#" class="btn btn-sm float-start my-3 create_btn" data-bs-toggle="modal" data-bs-target="#createDataSourceTypeModal"><i class="fa fa fa-plus"></i> CREATE DATA SOURCE FIELD</a>
              
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="">
                <img src="{{asset('public/images/Icons/noun-flip.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Flip" title="Flip" data-id="Flip">
                        
                    <img src="{{asset('public/images/Icons/other.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Other" data-id="Other" title="Other">
                            
                            
                    <img src="{{asset('public/images/Icons/sort.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Sort" title="Sort" data-id="Sort">
                            
                            
                    <img src="{{asset('public/images/Icons/money.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Sale & Purchase" title="Sale & Purchase" data-id="Sale & Purchase">
                            
                            
                    <img src="{{asset('public/images/Icons/image.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Images" title="Images" data-id="Images">
                            
                            
                    <img src="{{asset('public/images/Icons/person.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Grammar" title="Grammar" data-id="Grammar">
                            
                            
                        <img src="{{asset('public/images/Icons/logic.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Logic" title="Logic" data-id="Logic">
                            
                            
                        <img src="{{asset('public/images/Icons/repeat.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Repeat" title="Repeat" data-id="Repeat">
                            
                            
                        <img src="{{asset('public/images/Icons/edit.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Calendar" title="Calendar" data-id="Calendar">
                            
                            
                        <img src="{{asset('public/images/Icons/phones.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Phones" title="Phones" data-id="Phones">
                            
                            
                        <img src="{{asset('public/images/Icons/numbers.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Numbers" title="Numbers" data-id="Numbers">
                            
                            
                        <img src="{{asset('public/images/Icons/text.svg')}}" class="field_option_icon d-inline float-end border ms-1"  alt="Text" title="Text" data-id="Text">
        
                </div>
                
                        <div class="card">
                    <div class="card-body p-0 px-2 data_options">

                    </div>
                </div>
                @if(Auth::user()->role=='Admin')
                    <a href="#" class="btn btn-sm float-start my-3 create_btn" data-bs-toggle="modal" data-bs-target="#createDataSourceOptionModal"><i class="fa fa fa-plus"></i> CREATE DATA SOURCE OPTION</a>
                @endif    
            </div>
        </div>

        {!! Form::open(['id'=>'saveResult','url' => 'createResult']) !!}
            <div class="row mt-4">
                <label for="result" class=" fw-bolder"> <b>Result</b></label>
                <div class="col-10">
                    <input type="text" name="result" id="result" class="form-control data" >
                    
                </div>
                <div class="col-2" >
                <button id="trash" type="button" onclick = "clearText()" ><i class="fa fa-trash" style="position: relative; left: -55px;bottom: -6px;font-size: 1.3rem;" aria-hidden="true"></i></button>
                    <button type="submit" class="btn btn-secondary add_history">Add to List</button>
                </div>
            </div>
        {!! Form::close() !!}
       <div class="mt-5">
          <p>History List</p>
           <div class="card ">
           
                <div class="card-body p-0 px-2 result_history">
                    
                </div>
            </div>
        </div>
    </div>
    @include('DataSource.createModal')

    <!-- <footer class="text-center max-w-7xl text-white mx-auto py-2">
        <p>Brought to you by</p>
        <div class="">
        <img src="{{url('public/images/Logo.svg')}}" height="160px" width="160px">
        </div>
    </footer> -->
<script>
    
    
// console.log(data);
$(document).on('click', '.create_btn', function () {
    document.getElementById("delete_id").value = ""; 
    document.getElementById("delete_field_id").value = ""; 
    fetch_Dropdown();
    // var id=$('#type_of_datasource_id').val();
    // $('.dataSourceType option[value="'+id+'"]').attr('selected','selected');
});

$(document).on('click', '.edit_data_source_type_btn', function () {
 
    fetch_Dropdown();
    // var id=$('#type_of_datasource_id').val();
    // $('.dataSourceType option[value="'+id+'"]').attr('selected','selected');
});

function fetch_Dropdown(){
    var id=$('#type_of_datasource_id').val();
    var sid =id; 
	$.ajax({
		method: 'POST',
		url: 'fetch_dataSource',
		dataType: 'json',
		success:function success(result) {
                if (result.success) {
                    var data = result.data;
   
                    var resp_data ="";
                    
                    resp_data+= ` 
                        <option value="" selected=
                        "selected" disabled="disabled"">please select datasource </option>`;
                    $.each(data, function(key, val) {
                       

                      var status=val.status;
                      if(status==1){
                        if(val.id == sid ){
                            
                       resp_data+= ` 
                            <option value="${val.id}" data-sourcetype="${val.data_source_type}" selected=
                            "selected"">${val.name}</option>`;
                        }else{
                            resp_data+= ` 
                            <option value="${val.id}" data-sourcetype="${val.data_source_type}"">${val.name}</option>`;
                        }
                      }
                      
                    $('.dataSourceType').html(resp_data);
                   
                    })
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });

}
$('select#data_source_type').change(function(){
    // document.getElementById("type_of_datasource").value = value;
    var aa=$(this).find(':selected').data('sourcetype');
    $("#type_of_datasource").val(aa);
    
    // alert(aa);
})


   function clearText() {
		swal.fire({
		  	title: 'Are you sure?',
		  	text: "You won't be able to revert this!",
		  	icon: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'Yes, delete it!',
		}).then((result) => {
		  	if (result.value){
                document.getElementById("result").value = ""; 
		  	}
 
		})
 
	}

 

	$(document).on('click', '.delete_dataSource', function(){
		var id = $(this).data('id');
 
		swal.fire({
		  	title: 'Are you sure?',
		  	text: "You won't be able to revert this!",
		  	icon: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'Yes, delete it!',
		}).then((result) => {
		  	if (result.value){
		  		$.ajax({
                    url: 'usersdelete_dataSource/'+id,
                    type: 'POST',
                    data: {
                        "id": id   
                    }
			    })
			    .done(function(response){
			     	swal.fire('Deleted!', response.message, response.status);
					fetch_DataSource();
                    $(".data_field").html(" ");
                    $(".data_options").html(" ");
                    document.getElementById("result").value = "";
                    // $("#result").html(" ");
                    
			    })
			    .fail(function(){
			     	swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
			    });
		  	}
 
		})
        

	});

    function fetch_DataSource(){
	$.ajax({
		method: 'POST',
		url: 'fetch_dataSource',
		dataType: 'json',
		success:function success(result) {
                if (result.success) {
                    var data = result.data;
                   
                    var resp_data ="";
                    
                    $.each(data, function(key, val) {
                      var status=val.status;
                      if(status==1){
                       resp_data+= ` 
                       <div class="row data_sources" id="data_sources${val.id}">
                           <div class="col-10" style="cursor:pointer;">
                               <p class="data_sources_name size" type="${val.data_source_type}" id="${val.id}">${val.name}</p>
                           </div>
                           <div class="col-2">
                                <button class="delete_dataSource" data-id="${val.id}"><i class="fa fa-trash color" aria-hidden="true"></i></button>
                                <a id="${val.id}" style="cursor:pointer;" class="edit_data_source">
                                <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                                </a>
                            </div>
                        </div>`;
                      }
                    })
                    $('.data-source').html(resp_data);
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });

}


 
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
                    // location.reload();
                    fetch_DataSource();
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBoxDS', result);
            },
        });

    }); 
 




    
</script>
    <script>
      
      $(document).ready(function() {
       
        function getHistory(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getResult',
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                    var data = result.data;
                    console.log(data);
                    var resp_data ="";
                    $.each(data, function(key, val) {
                        // console.log(val.id);
                        resp_data+= `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options size" data-val="${val.result}" id="${val.id}">${val.result}</p>
                            </div>
                            <div class="col-2">
                                <button  class="float-end mt-1 deleteResult" id="${val.id}">
                                <img src="{{asset('public/images/Icons/deletebtn.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="delete" title="delete">                      
                                </button>
                            </div>
                        </div>`
                    })
                    $('.result_history').html(resp_data);
                }
            },
            // error: function error(result) {
            //     printErrorMessage('#validationErrorsBox', result);
            // },
        });

        }
        getHistory();


        $(document).on('click','.deleteResult',function(){
        var id = $(this).attr('id');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal.fire({
		  	title: 'Are you sure?',
		  	text: "You won't be able to revert this!",
		  	icon: 'warning',
		  	showCancelButton: true,
		  	confirmButtonColor: '#3085d6',
		  	cancelButtonColor: '#d33',
		  	confirmButtonText: 'Yes, delete it!',
		}).then((result) => {
		  	if (result.value){
                $.ajax({
            url: 'deleteResult/'+id,
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    getHistory();
                  
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
		  	}
              
 
		})
      
    });
    //update data source 
    $(document).on('click','.edit_data_source',function(){
        var id = $(this).attr('id');
      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'Admin/editDataSource/'+id,
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                   
                    $('.data_source_name').val(result.data.name);
                    $('.data_source_id').val(result.data.id);
                    $('.data_source_type_field').val(result.data.data_source_type);

                    $('#createDataSourceModal').modal('toggle');
                  
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
    });

     // update data source type 
    $(document).on('click','.edit_data_source_type_btn',function(){
        var id = $(this).attr('id');
      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'Admin/editDataSourceType/'+id,
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                   
                    $('.dataSourceName').val(result.data.dataSourceName);
                    $('.data_source_type_id').val(result.data.id);
                    $('.mergeFieldDescription').val(result.data.mergeFieldDescription);
                    
                    $('.dataSourceType option[value="'+result.data.dataSourceType+'"]').attr('selected','selected');

                    $('#createDataSourceTypeModal').modal('toggle');
                  
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
    });

      // update data source options 
      $(document).on('click','.getDataSourceOptionBtn',function(){
        var id = $(this).attr('id');
      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'Admin/editDataSourceOption/'+id,
            type: 'GET',
            success: function success(result) {
               
                if (result.success) {
                   
                    $('.option_name').val(result.data.option_name);
                    $('.option_id').val(result.data.id);
                    $('.option_value').val(result.data.option_value);
                    
                    $('.option_type_class option[value="'+result.data.option_type+'"]').attr('selected','selected');

                    $('#createDataSourceOptionModal').modal('toggle');
                  
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBoxDSO',result.error);

            },
        });
    });
});

</script>

<script>
 //get field and show data source field
 function fetch_DataSourceField(id){
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
                    let participant = result.data[0].data_source_type;
                    let dataSourceName=result.data[0].name;
                    let resp_data ="";
                    let data =result.field;
                    let data2 = result.data[0].get_data_source_type;
                       console.log(participant);
                       if(participant=='Custom'){ 
                        $.each(data, function(key, val) {
                        // console.log(val.dataSourceName);
                      var status=val.status;
                      if(status==1){
                       resp_data+= ` 
                       <div class="row data_source_field" id="data_source_field${val.id}">
                           <div class="col-10" style="cursor:pointer;">
                               <p class="data_source_type size" data-sourceName="${dataSourceName}" data-type="${val.dataSourceType}" id="${val.id}">${val.dataSourceName}</p>
                           </div>
                           <div class="col-2">
                                <button class="delete_dataSourceField" data-type="${val.dataSourceType}"  data-id="${val.id}"><i class="fa fa-trash color" aria-hidden="true"></i></button>
                                <a id="${val.id}" class="edit_data_source_type_btn">
                                <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                                </a>
                            </div>
                        </div>`;
                      }
                    })
                }else{
                    $.each(data2, function(key, val) {
                        // console.log(val.dataSourceName);
                      var status=val.status;
                      if(status==1){
                       resp_data+= ` 
                       <div class="row data_source_field" id="data_source_field${val.id}">
                           <div class="col-10" style="cursor:pointer;">
                               <p class="data_source_type size" data-sourceName="${dataSourceName}" data-type="${val.dataSourceType}" id="${val.id}">${val.dataSourceName}</p>
                           </div>
                           <div class="col-2">
                                <button class="delete_dataSourceField" data-type="${val.dataSourceType}"  data-id="${val.id}"><i class="fa fa-trash color" aria-hidden="true"></i></button>
                                <a id="${val.id}" class="edit_data_source_type_btn">
                                <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                                </a>
                            </div>
                        </div>`;
                      }
                    })
                }
                      
                    
                    $('.data_field').html(resp_data);
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
            
           }

    $(document).on('click','.data_sources_name',function(){
        var id = $(this).attr('id');
        var type = $(this).attr('type');
        $('#type_of_datasource').val(type);
        // $('.dataSourceType option[value="'+id+'"]').attr('selected','selected');
    //    console.log(id);
        $('#type_of_datasource_id').val(id);
        $('.data_sources').css('background-color','#fff');
        $('#data_sources'+id).css('background-color','#C8D0D5');
        $('#delete_dataSourceField'+id).css('background-color','#C8D0D5');
        
        fetch_DataSourceField(id);

    });

    $(document).on('click', '.delete_dataSourceField', function(){
    var id = $(this).data('id');
    var sourcetype=$(this).data('type');
    
    // console.log(sourcetype)
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
          if (result.value){
              $.ajax({
                url: 'usersdelete_dataSourceField/'+id,
                type: 'POST',
                data: {
                    "id": id   
                }
            })
            .done(function(response){
                 swal.fire('Deleted!', "Data is deleted");
                 if(sourcetype=="Participant"){
                    fetch_participantfield();
                 }else{
                    fetch_DataSourceField(sourcetype);
                 }
                 
                // location.reload();
            })
            .fail(function(){
                 swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
            });
          }
        

    })
   
    
});

function fetch_participantfield(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'Participant_field',
            type: 'GET',
           
            success: function success(result) {
                if (result.success) {
                    let participant = "Participant";
                    let dataSourceName="Participant";
                    let resp_data ="";
                   let data=result.field;
                    // let data2 = result.data[0].get_data_source_type;
                    //    console.log(participant);
                      
                    $.each(data, function(key, val) {
                        // console.log(val.dataSourceName);
                      var status=val.status;
                      if(status==1){
                       resp_data+= ` 
                       <div class="row data_source_field" id="data_source_field${val.id}">
                           <div class="col-10" style="cursor:pointer;">
                               <p class="data_source_type size" data-sourceName="${val.dataSourceName}" data-type="${val.dataSourceType}" id="${val.id}">${val.dataSourceName}</p>
                           </div>
                           <div class="col-2">
                                <button class="delete_dataSourceField" data-type="${val.dataSourceType}"  data-id="${val.id}"><i class="fa fa-trash color" aria-hidden="true"></i></button>
                                <a id="${val.id}" class="edit_data_source_type_btn">
                                <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                                </a>
                            </div>
                        </div>`;
                      }
                    })
                
                      
                    
                    $('.data_field').html(resp_data);
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
}



$('#createDataSourceType').submit(function (event) {
    var sourcetype=$('#type_of_datasource_id').val();
    // var sourcetype=$(".option_type_class option[value]").each( function () {
    // $(this).val( $(this).attr("value") );
    // });
    // console.log();
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
                // location.reload();
                if(sourcetype=="Participant"){
                    fetch_participantfield();
                 }else{
                    fetch_DataSourceField(sourcetype);
                 }
            }
        },
        error: function error(result) {
            printErrorMessage('#validationErrorsBoxDST', result);
        },
    });

    
});
   
//get field option and show data source field option

    $(document).on('click','.data_source_type',function(){
        var id = $(this).attr('id');

        var text = $(this).text();
        var dataSourceType=$(this).attr('data-sourceType');
        var dataSourceName=$(this).attr('data-sourceName');
       
        // console.log('datasourcetype ',dataSourceType,dataSourceName);
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
                                <p class="data_source_options size" data-val="${val.option_value}" id="${val.id}">${val.option_name}</p>
                            </div>
                            <div class="col-2">
                            @if(Auth::user()->role=='Admin')
                                <a  id="${val.id}" class="getDataSourceOptionBtn" style="cursor:pointer;">
                                <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                                </a>
                                @endif
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
                                <p class="data_source_options size" data-val="${val.option_value}" id="${val.id}">${val.option_name}</p>
                            </div>
                            <div class="col-2">
                            @if(Auth::user()->role=='Admin')
                                <a  id="${val.id}" class="getDataSourceOptionBtn" style="cursor:pointer;">
                                <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">

                                </a>
                                @endif
                            </div>
                        </div>`;
                        }
                        else{
                            resp_data+= `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options size" data-val="${val.option_value}" id="${val.id}">${val.option_value}</p>
                            </div>
                            <div class="col-2">
                            @if(Auth::user()->role=='Admin')
                                <a  id="${val.id}" class="getDataSourceOptionBtn" style="cursor:pointer;">
                                <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                                </a>
                                @endif
                            </div>
                        </div>`;
                        }
                    })
                    $('.data_options').html(resp_data);
                }
            },
           
        });
    });


  
    </script>

    
@endsection
