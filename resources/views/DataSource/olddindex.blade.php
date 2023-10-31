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
            width: 1.1rem;
            height: 1.5rem;
            cursor: pointer;
        }
        
        .editIcon{
            height: 1.1rem;
            cursor: pointer;
        }
         .data_source_field{
            padding: 3px 0px;
        }
        .data_sources{
            padding: 3px 0px;
        }
        .data_source_option{
            padding: 3px 0px;
        }
        #result{
            border-color:#dededf !important;
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
                        @foreach($dataSources as $data)
                            <div class="row data_sources" id="data_sources{{$data->id}}">
                                <div class="col-10" style="cursor:pointer;">
                                    <p class="data_sources_name"  id="{{$data->id}}">{{$data->name}}</p>
                                </div>
                                <div class="col-2">
                                <a id="{{$data->id}}" style="cursor:pointer;" class="edit_data_source">
                                   
                                    <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit" >

                                </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if(Auth::user()->role=='Admin')
                    <a href="#" class="btn btn-sm float-start my-3 create_btn" data-bs-toggle="modal" data-bs-target="#createDataSourceModal"><i class="fa fa fa-plus"></i> CREATE DATA SOURCE</a>
                @endif    
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="">Select A Field</label>
                <div class="card ">
                    <div class="card-body p-0 px-2 data_field">

                    </div>
                </div>
                @if(Auth::user()->role=='Admin')
                    <a href="#" class="btn btn-sm float-start my-3 create_btn" data-bs-toggle="modal" data-bs-target="#createDataSourceTypeModal"><i class="fa fa fa-plus"></i> CREATE DATA SOURCE FIELD</a>
                @endif    
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
            <label for="">Select An Option</label>
              
                   
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

                       

                    
             

                        <div class="card ">
                    <div class="card-body p-0 px-2 data_field">

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
                    <input type="text" name="result" id="result" class="form-control data">
                    
                </div>
                <div class="col-2" >
                <button id="trash" onclick = "clearText()" ><i class="fa fa-trash" style="position: relative; left: -55px;bottom: -6px;font-size: 1.3rem;" aria-hidden="true"></i></button>
                    <button type="submit" class="btn btn-secondary">Add to List</button>
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
<script>
   function clearText(event) {

        }
       

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
                                <p class="data_source_options" data-val="${val.result}" id="${val.id}">${val.result}</p>
                            </div>
                            <div class="col-2">
                                <button  class="float-end mt-1 deleteResult" id="${val.id}">
                                <img src="${window.location.origin}/public/images/Icons/deletebtn.svg" class="editIcon d-inline float-end border ms-1"  alt="delete" title="delete">
                                    
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
@endsection
