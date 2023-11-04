@extends('layouts.userApp')
@section('content')
<style>
    .text-xl {
        font-size: 1.5rem;
        'success'=>true,
        color: #234765;
    }

    hr {
        height: 3px !important;
        color: #234765;
    }

    .main-container {
        color: #234765;
    }

    .min-h-screen {
        background-color: #F5F5F5 !important;
    }

    .card {
        min-height: 322px;
        max-height: 322px;
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
        border-color: #dededf !important;
    }

    .size {
        font-size: 14px !important;
    }

    footer {
        background-color: #113C54;
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


        <!-- {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="">Select Data Source</label>
                <div class="card ">
                    <div class="card-body p-0 px-2">
                        <div class="data-source">
                        <script>
                            var actionstepData = @json($dataSources);

                            console.log(actionstepData);
                        </script>
                           
                        @foreach($dataSources as $data)
                        @if($data->status==1)
                        

                            <div class="row data_sources" id="data_sources{{$data->id}}">
                                <div class="col-10" style="cursor:pointer;">
                                    
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
              
            </div> --}} -->

        <!-- {{-- <div class="col-lg-4 col-md-6 col-sm-12">
            <label for="">Select Data Source</label>
            <div class="card ">
                <div class="card-body p-0 px-2">
                    <div class="data-source">
                        <script>
                            var actionstepData = @json($dataCollectionFieldsByCollection);

                            console.log(actionstepData);
                        </script>

                        @if(isset($actionstepData['actiontypes']) && is_array($actionstepData['actiontypes']))
                        @foreach($actionstepData['actiontypes'] as $actionType)
                        @if(isset($actionTypesWithDataCollections[$actionType['id']]) && count($actionTypesWithDataCollections[$actionType['id']]) > 0)


                        @foreach($actionTypesWithDataCollections[$actionType['id']] as $dataCollectionLabel => $dataCollectionId)
                        <div class="row data_sources" data-collection-id="{{ $dataCollectionId }}">
                            <div class="col-12">
                                <p class="data_sources_name size" onclick="showFieldsForCollection('{{ $dataCollectionId }}')" type="Custom" id="{{$actionType['id']}}">{{ $actionType['name'] }} - {{ $dataCollectionLabel }}</p>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="row data_sources">
                            <div class="col-12">
                                <p class="data_sources_name size">{{ $actionType['name'] }}</p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <p>No Action Types available.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div> --}} -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <label for="">Select Data Source</label>
            <div class="card ">
                <div class="card-body p-0 px-2">
                    <div class="data-source">

                        @if(isset($actionstepData['actiontypes']) && is_array($actionstepData['actiontypes']))
                        @foreach($actionstepData['actiontypes'] as $actionType)
                        @if(isset($actionTypesWithDataCollections[$actionType['id']]) && count($actionTypesWithDataCollections[$actionType['id']]) > 0)
                        @foreach($actionTypesWithDataCollections[$actionType['id']] as $dataCollectionLabel => $dataCollectionId)
                        <div class="row data_sources" id="data_sources{{$actionType['id'] . '_' . $dataCollectionId}}">
                            <div class="col-10" style="cursor:pointer;">
                                <!-- <p class="data_sources_name size" onclick="fetch_DataSourceField('{{ $actionType['id'] }}')" type="Custom" id="{{$actionType['id']}}">{{ $actionType['name'] }} - {{ $dataCollectionLabel }}</p> -->
                                <p class="data_sources_name size" type="Actionstep" id="{{$actionType['id']}}" data-collection-id="{{ $dataCollectionId }}">{{ $actionType['name'] }} - {{ $dataCollectionLabel }}</p>
                            </div>
                            <div class="col-2">

                            </div>
                        </div>
                        @endforeach
                        @endif
                        @endforeach
                        @else
                        <p>No Action Types available.</p>
                        @endif

                        <!-- {{-- 
                        @if(isset($participantTypesWithFields) && is_array($participantTypesWithFields))
                        @foreach($participantTypesWithFields as $participantTypeName => $fields)
                        <div class="row data_sources" id="participant_type_{{ Str::slug($participantTypeName) }}">
                            <div class="col-10" style="cursor:pointer;">
                            <p class="data_sources_name size" type="Participant" data-participant-type-name="{{ $participantTypeName }}" id="participant_{{ Str::slug($participantTypeName) }}">
                               

                                    Participant - {{ $participantTypeName }}
                                </p>
                            </div>
                            <div class="col-2">
                            
                            </div>
                        </div>
                        
                        
                        @foreach($fields as $fieldLabel)
                        <div class="row data_source_field" id="field_{{ Str::slug($fieldLabel) }}">
                            <div class="col-12">
                                <p class="field_name size">{{ $fieldLabel }}</p>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                        @else
                        <p>No Participant Types available.</p>
                        @endif
                        --}} -->

                        <!-- <script>
                            var participantTypesWithFields = @json($participantTypesWithFields);
                            console.log(participantTypesWithFields);
                        </script> -->

                        @if(isset($participantTypesWithFields))
                        @foreach($participantTypesWithFields as $participantTypeId => $participantType)

                        <div class="row data_sources" id="participant_type{{ $participantTypeId }}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_sources_name size" type="ActionstepParticipant" data-collection-label="{{ $participantType['name'] }}" data-collection-id="{{ $participantTypeId }}" id="participant_type{{ $participantTypeId }}">
                                    Participant - {{ $participantType['name'] }}
                                </p>
                            </div>
                            <div class="col-2">

                            </div>
                        </div>
                        @endforeach
                        @else
                        <p>No Participant Types available.</p>
                        @endif
                    </div>
                </div>
            </div>
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
                <img src="{{asset('public/images/Icons/noun-flip.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Flip" title="Flip" data-id="Flip">

                <img src="{{asset('public/images/Icons/other.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Other" data-id="Other" title="Other">


                <img src="{{asset('public/images/Icons/sort.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Sort" title="Sort" data-id="Sort">


                <img src="{{asset('public/images/Icons/money.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Sale & Purchase" title="Sale & Purchase" data-id="Sale & Purchase">


                <img src="{{asset('public/images/Icons/image.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Images" title="Images" data-id="Images">


                <img src="{{asset('public/images/Icons/person.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Grammar" title="Grammar" data-id="Grammar">


                <img src="{{asset('public/images/Icons/logic.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Logic" title="Logic" data-id="Logic">


                <img src="{{asset('public/images/Icons/repeat.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Repeat" title="Repeat" data-id="Repeat">


                <img src="{{asset('public/images/Icons/edit.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Calendar" title="Calendar" data-id="Calendar">


                <img src="{{asset('public/images/Icons/phones.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Phones" title="Phones" data-id="Phones">


                <img src="{{asset('public/images/Icons/numbers.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Numbers" title="Numbers" data-id="Numbers">


                <img src="{{asset('public/images/Icons/text.svg')}}" class="field_option_icon d-inline float-end border ms-1" alt="Text" title="Text" data-id="Text">

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
        <div class="col-10" style="position:relative;">
            <input type="text" name="result" id="result" class="form-control data">
            <button id="trash" type="button" onclick="clearText()" style="position: absolute; right: 25px;top: 10px; background: none;"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </div>
        <div class="col-2">

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
    $(document).on('click', '.create_btn', function() {
        document.getElementById("delete_id").value = "";
        document.getElementById("delete_field_id").value = "";
        fetch_Dropdown();
        // var id=$('#type_of_datasource_id').val();
        // $('.dataSourceType option[value="'+id+'"]').attr('selected','selected');
    });

    $(document).on('click', '.edit_data_source_type_btn', function() {

        fetch_Dropdown();
        // var id=$('#type_of_datasource_id').val();
        // $('.dataSourceType option[value="'+id+'"]').attr('selected','selected');
    });

    function fetch_Dropdown() {
        var id = $('#type_of_datasource_id').val();
        var sid = id;
        $.ajax({
            method: 'POST',
            url: 'fetch_dataSource',
            dataType: 'json',
            success: function success(result) {
                if (result.success) {
                    var data = result.data;

                    var resp_data = "";

                    resp_data += ` 
                        <option value="" selected=
                        "selected" disabled="disabled"">please select datasource </option>`;
                    $.each(data, function(key, val) {


                        var status = val.status;
                        if (status == 1) {
                            if (val.id == sid) {

                                resp_data += ` 
                            <option value="${val.id}" data-sourcetype="${val.data_source_type}" selected=
                            "selected"">${val.name}</option>`;
                            } else {
                                resp_data += ` 
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

    $('select#data_source_type').change(function() {
        // document.getElementById("type_of_datasource").value = value;
        var aa = $(this).find(':selected').data('sourcetype');
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
            if (result.value) {
                document.getElementById("result").value = "";
            }

        })

    }

    $(document).on('click', '.delete_dataSource', function() {
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
            if (result.value) {
                $.ajax({
                        url: 'usersdelete_dataSource/' + id,
                        type: 'POST',
                        data: {
                            "id": id
                        }
                    })
                    .done(function(response) {
                        swal.fire('Deleted!', response.message, response.status);
                        fetch_DataSource();
                        $(".data_field").html(" ");
                        $(".data_options").html(" ");
                        document.getElementById("result").value = "";
                        // $("#result").html(" ");

                    })
                    .fail(function() {
                        swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    });
            }

        })


    });

    function fetch_DataSource() {
        $.ajax({
            method: 'POST',
            url: 'fetch_dataSource',
            dataType: 'json',
            success: function success(result) {
                if (result.success) {
                    var data = result.data;

                    var resp_data = "";

                    $.each(data, function(key, val) {
                        var status = val.status;
                        if (status == 1) {
                            resp_data += ` 
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

    $('#createDataSource').submit(function(event) {

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

        function getHistory() {
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
                        // console.log(data);
                        var resp_data = "";
                        $.each(data, function(key, val) {
                            // console.log(val.id);
                            resp_data += `<div class="row data_source_option" id="data_source_option${val.id}">
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

        $(document).on('click', '.deleteResult', function() {
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
                if (result.value) {
                    $.ajax({
                        url: 'deleteResult/' + id,
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
        $(document).on('click', '.edit_data_source', function() {
            var id = $(this).attr('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'Admin/editDataSource/' + id,
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
        $(document).on('click', '.edit_data_source_type_btn', function() {
            var id = $(this).attr('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'Admin/editDataSourceType/' + id,
                type: 'GET',
                success: function success(result) {
                    if (result.success) {

                        $('.dataSourceName').val(result.data.dataSourceName);
                        $('.data_source_type_id').val(result.data.id);
                        $('.mergeFieldDescription').val(result.data.mergeFieldDescription);

                        $('.dataSourceType option[value="' + result.data.dataSourceType + '"]').attr('selected', 'selected');

                        $('#createDataSourceTypeModal').modal('toggle');

                    }
                },
                error: function error(result) {
                    printErrorMessage('#validationErrorsBox', result);
                },
            });
        });

        // update data source options 
        $(document).on('click', '.getDataSourceOptionBtn', function() {
            var id = $(this).attr('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'Admin/editDataSourceOption/' + id,
                type: 'GET',
                success: function success(result) {

                    if (result.success) {

                        $('.option_name').val(result.data.option_name);
                        $('.option_id').val(result.data.id);
                        $('.option_value').val(result.data.option_value);

                        $('.option_type_class option[value="' + result.data.option_type + '"]').attr('selected', 'selected');

                        $('#createDataSourceOptionModal').modal('toggle');

                    }
                },
                error: function error(result) {
                    printErrorMessage('#validationErrorsBoxDSO', result.error);

                },
            });
        });
    });
</script>


<script>
    function fetch_ActionstepSourceField(collectionId) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getActionstepCollection/' + collectionId,
            type: 'GET',

            success: function success(result) {
                if (result.success) {
                    let dataCollection = result.data.datacollectionfields
                    console.log(result)
                    if (dataCollection.length > 0) {
                        let resp_data = "";
                        dataCollection.forEach(field => {
                            resp_data += `
                                        <div class="row data_source_field" id="data_source_field${field.id}">
                                            <div class="col-10" style="cursor:pointer;">
                                                <p class="data_source_type size" data-sourcetype="Actionstep" data-sourceName="${field.label}" data-type="${field.dataType}" id="${field.id}">${field.label}</p>
                                            </div>
                                        </div>`;
                        });
                        $('.data_field').html(resp_data);
                    } else {
                        $('.data_field').html('<p>No fields available for this selection.</p>');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr, status, error);
                // If printErrorMessage expects an error message string, you need to provide that.
                // For example, if the expected error message is in xhr.responseText:
                let errorMessage = xhr.responseText || "An unknown error occurred";
                printErrorMessage('#validationErrorsBox', errorMessage);
            },
        });

        // var fields = @json($dataCollectionFieldsByCollection);
        // console.log(fields);
        // var fieldContainer = document.querySelector('.data_field');
        // fieldContainer.innerHTML = '';

        // if (fields[collectionId] && fields[collectionId].length > 0) {
        //     let resp_data = "";
        //     console.log(fields)
        //     fields[collectionId].forEach(field => {
        //         resp_data += `
        //         <div class="row data_source_field" id="data_source_field${field.id}">
        //             <div class="col-10" style="cursor:pointer;">
        //                 <p class="data_source_type size" data-sourcetype="Actionstep" data-sourceName="${field.name}" data-type="${field.name}" id="${field.id}">${field.name}</p>
        //             </div>
        //         </div>`;
        //     });
        //     $('.data_field').html(resp_data);
        // } else {
        //     fieldContainer.innerHTML = '<p>No fields available for this selection.</p>';
        // }
    }
    /*
        function fetch_ActionstepParticipantField(participantTypeId) {
            var fieldsData = @json($participantTypesWithFields);
            console.log(fieldsData)
            var participantFields = fieldsData[participantTypeId] ? fieldsData[participantTypeId]['fields'] : null;

            if (participantFields) {
                let resp_data = "";
                // Check if participantFields is an array and has elements
                if (Array.isArray(participantFields) && participantFields.length > 0) {
                    participantFields.forEach(field => {
                        resp_data += buildFieldHtml(field, field); // Assuming field is a string here
                    });
                } else if (typeof participantFields === 'object' && Object.keys(participantFields).length > 0) {
                    // If it's an object, iterate over the object keys
                    Object.entries(participantFields).forEach(([key, value]) => {
                        resp_data += buildFieldHtml(key, value);
                    });
                } else {
                    // If there are no fields
                    $('.data_field').html('<p>No fields available for this selection.</p>');
                    return;
                }
                $('.data_field').html(resp_data);
            } else {
                $('.data_field').html('<p>No fields available for this selection.</p>');
            }
        }
        */

    function fetch_ActionstepParticipantField(id) {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getActionstepParticipantCollection/' + id,
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                    if (result.data && result.data.participanttypedatafields.length > 0) {

                        let resp_data = "";

                        result.data.participanttypedatafields.forEach(field => {
                            resp_data += `
                            <div class="row data_source_field" id="data_source_field${field.id}">
                                <div class="col-10" style="cursor:pointer;">
                                    <p class="data_source_type size" data-sourcetype="ActionstepParticipant" data-sourceName="${field.label}" data-type="${field.dataType}" id="${field.id}">${field.label}</p>
                                </div>
                            </div>`;
                        });
                        $('.data_field').html(resp_data);
                    } else {
                        $('.data_field').html('<p class="size">No custom fields available for this participant type.</p>');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr, status, error);
                let errorMessage = xhr.responseText || "An unknown error occurred";
                printErrorMessage('#validationErrorsBox', errorMessage);
            },
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'Participant_field/' + id,
            type: 'GET',
            success: function success(result) {
                if (result.success) {
                    let resp_data = "";
                    let fields = result.field;

                    fields.forEach(field => {
                        // Assuming 'field' has properties like 'dataSourceName', 'id', etc.
                        resp_data += ` 
                    <div class="row data_source_field" id="data_source_field${field.id}">
                        <div class="col-10" style="cursor:pointer;">
                            <p class="data_source_type size" data-sourcetype="Participant" data-sourceName="${field.dataSourceName}" data-sourceid="${id}" data-type="${field.dataSourceType}" id="${field.id}">${field.dataSourceName}</p>
                        </div>
                        <div class="col-2">
                             <button class="delete_dataSourceField" data-type="${field.dataSourceType}" data-sourceid="${id}" data-id="${field.id}"><i class="fa fa-trash color" aria-hidden="true"></i></button>
                             <a id="${field.id}" class="edit_data_source_type_btn" data-sourceid="${id}">
                             <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                             </a>
                         </div>
                     </div>`;
                    });

                    $('.data_field').after(resp_data);
                }
            },
            error: function error(result) {
                db_success = false
                printErrorMessage('#validationErrorsBox', result);
            },
        });
    }


    function buildFieldHtml(id, name) {
        return `
        <div class="row data_source_field" id="data_source_field${id}">
            <div class="col-10" style="cursor:pointer;">
                <p class="data_source_type size" data-sourcetype="Actionstep" data-sourceName="${name}" data-type="${name}" id="${id}">${name}</p>
            </div>
        </div>`;
    }

    /*
        // function fetch_ActionstepParticipantField(participantTypeId) {
        //     var fields = @json($participantTypesWithFields);
        //     console.log(fields)
        //     if (fields[participantTypeId] && Object.keys(fields[participantTypeId]['fields']).length > 0) {
        //         let resp_data = "";
        //         fields[participantTypeId]['fields'].forEach(field => {
        //             resp_data += `
        //             <div class="row data_source_field" id="data_source_field${field.id}">
        //                 <div class="col-10" style="cursor:pointer;">
        //                     <p class="data_source_type size" data-sourcetype="Actionstep" data-sourceName="${field.name}" data-type="${field.name}" id="${field.id}">${field.name}</p>
        //                 </div>
        //             </div>`;
        //         });
        //         $('.data_field').html(resp_data);
        //     } else {
        //         $('.data_field').html('<p>No fields available for this selection.</p>');
        //     }

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // // Assuming you have a route set up to fetch participant fields by ID
            // $.ajax({
            //     url: 'getActionstepParticipantFields/' + participantTypeId,

            //     type: 'GET',
            //     success: function(response) {
            //         if (response.success) {
            //             var fields = response.fields; // Adjust this based on the actual response structure
            //             var fieldContainer = $('.data_field');
            //             fieldContainer.empty();

            //             if (fields && fields.length > 0) {
            //                 let resp_data = "";
            //                 fields.forEach(field => {
            //                     resp_data += `
            //                     <div class="row data_source_field" id="data_source_field${field.id}">
            //                         <div class="col-10" style="cursor:pointer;">
            //                             <p class="data_source_type size" data-sourcetype="Participant" data-sourceName="${field.name}" data-type="${field.name}" id="${field.id}">${field.name}</p>
            //                         </div>
            //                     </div>`;
            //                 });
            //                 fieldContainer.html(resp_data);
            //             } else {
            //                 fieldContainer.html('<p>No fields available for this participant type.</p>');
            //             }
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('AJAX Error:', xhr, status, error);
            //         let errorMessage = xhr.responseText || "An unknown error occurred";
            //         // Handle the error, e.g., display a message to the user
            //     }
            // });
        
    */

    //get field and show data source field
    function fetch_DataSourceField(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getDataSourceType/' + id,
            type: 'GET',

            success: function success(result) {
                if (result.success) {
                    let participant = result.data[0].data_source_type;
                    let dataSourceName = result.data[0].name;
                    console.log("dataSourceName", dataSourceName);
                    let resp_data = "";
                    let data = result.field;
                    let data2 = result.data[0].get_data_source_type;
                    //    console.log(participant);
                    if (participant == 'Custom' || participant == 'Default') {
                        $.each(data, function(key, val) {
                            // console.log(val.dataSourceName);
                            var status = val.status;
                            if (status == 1) {
                                resp_data += ` 
                       <div class="row data_source_field" id="data_source_field${val.id}">
                           <div class="col-10" style="cursor:pointer;">
                               <p class="data_source_type size" data-sourcetype="${participant}" data-sourceName="${dataSourceName}" data-type="${val.dataSourceType}" id="${val.id}">${val.dataSourceName}</p>
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
                    } else {
                        $.each(data2, function(key, val) {
                            // console.log(val.dataSourceName);
                            var status = val.status;
                            if (status == 1) {
                                resp_data += ` 
                       <div class="row data_source_field" id="data_source_field${val.id}">
                           <div class="col-10" style="cursor:pointer;">
                               <p class="data_source_type size" data-sourcetype="Participant" data-sourceName="${dataSourceName}" data-type="${val.dataSourceType}" id="${val.id}">${val.dataSourceName}</p>
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

    // {{--  function fetch_participantfield(id) {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: 'Participant_field/' + id,
    //         type: 'GET',

    //         success: function success(result) {
    //             console.log(result);
    //             if (result.success) {
    //                 // let participant = "Participant";
    //                 var dataSourceName = result.data[0].name;
    //                 var dataSourceid = result.data[0].id;


    //                 let resp_data = "";
    //                 let data = result.field;
    //                 // let data2 = result.data[0].get_data_source_type;
    //                 //    console.log(dataSourceName);

    //                 $.each(data, function(key, val) {
    //                     // console.log(val.dataSourceName);
    //                     var status = val.status;
    //                     if (status == 1) {
    //                         resp_data += ` 
    //                    <div class="row data_source_field" id="data_source_field${val.id}">
    //                        <div class="col-10" style="cursor:pointer;">
    //                            <p class="data_source_type size" data-sourcetype="Participant" data-sourceName="${dataSourceName}" data-sourceid="${dataSourceid}" data-type="${val.dataSourceType}" id="${val.id}">${val.dataSourceName}</p>
    //                        </div>
    //                        <div class="col-2">
    //                             <button class="delete_dataSourceField" data-type="${val.dataSourceType}" data-sourceid="${dataSourceid}" data-id="${val.id}"><i class="fa fa-trash color" aria-hidden="true"></i></button>
    //                             <a id="${val.id}" class="edit_data_source_type_btn" data-sourceid="${dataSourceid}">
    //                             <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
    //                             </a>
    //                         </div>
    //                     </div>`;
    //                     }
    //                 })

    //                 $('.data_field').html(resp_data);
    //             }
    //         },
    //         error: function error(result) {
    //             printErrorMessage('#validationErrorsBox', result);
    //         },
    //     });
    // } --}}

    function fetch_participantfield(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'Participant_field/' + id,
            type: 'GET',
            success: function success(result) {
                console.log(result);
                if (result.success) {
                    let resp_data = "";
                    let fields = result.field;

                    fields.forEach(field => {
                        // Assuming 'field' has properties like 'dataSourceName', 'id', etc.
                        resp_data += ` 
                    <div class="row data_source_field" id="data_source_field${field.id}">
                        <div class="col-10" style="cursor:pointer;">
                            <p class="data_source_type size" data-sourcetype="Participant" data-sourceName="${field.dataSourceName}" data-sourceid="${id}" data-type="${field.dataSourceType}" id="${field.id}">${field.dataSourceName}</p>
                        </div>
                        <div class="col-2">
                             <button class="delete_dataSourceField" data-type="${field.dataSourceType}" data-sourceid="${id}" data-id="${field.id}"><i class="fa fa-trash color" aria-hidden="true"></i></button>
                             <a id="${field.id}" class="edit_data_source_type_btn" data-sourceid="${id}">
                             <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">
                             </a>
                         </div>
                     </div>`;
                    });

                    $('.data_field').html(resp_data);
                }
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBox', result);
            },
        });
    }


    $(document).on('click', '.delete_dataSourceField', function() {
        var id = $(this).data('id');

        var sourcetype = $('#type_of_datasource_id').val();
        var type = $(this).data('type');
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
            if (result.value) {
                $.ajax({
                        url: 'usersdelete_dataSourceField/' + id,
                        type: 'POST',
                        data: {
                            'source_id': sourcetype
                        },
                    })
                    .done(function(response) {
                        swal.fire('Deleted!', "Data is deleted");
                        //  console.log(type)
                        if (type == "Participant") {
                            fetch_participantfield(sourcetype);
                        } else {
                            fetch_DataSourceField(sourcetype);
                        }

                        // location.reload();
                    })
                    .fail(function() {
                        swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    });
                $("#result").val("");
            }


        })


    });

    var selectedFieldName = '';
    var selectedParticipantTypeName = '';

    $(document).on('click', '.data_sources_name', function() {
        var id = $(this).attr('id');
        var type = $(this).attr('type');
        var collectionId = $(this).data('collection-id');
        selectedParticipantTypeName = collectionId
        $('#type_of_datasource').val(type);
        $('#type_of_datasource_id').val(id);
        $('.data_sources').css('background-color', '#fff');
        $('#data_sources' + id + '_' + collectionId).css('background-color', '#C8D0D5');
        $(this).closest('.data_sources').css('background-color', '#C8D0D5');

        if (type == "Actionstep") {
            if (collectionId) {
                // console.log("Showing fields for collection", collectionId);
                fetch_ActionstepSourceField(collectionId);
            }
        } else if (type == "ActionstepParticipant") {
            fetch_ActionstepParticipantField(collectionId)
        } else if (type == "Custom" || type == "Default") {
            // console.log("TEST")
            fetch_DataSourceField(id);
        } else if (type == "Participant") {
            fetch_participantfield(id);
            console.log("selectedFieldName", selectedFieldName);
            result = `${selectedFieldName}|pt=${selectedParticipantTypeName}`;
            console.log("Participant result:", result);
        } else {
            console.log("Error no type:", type);
            result = `${dataSourceName}_${fieldName}`;

        }

    });

    //get field option and show data source field option
    $(document).on('click', '.data_source_type', function() {
        var id = $(this).attr('id');
        var source_id = $(this).attr('data-type');
        var sourcetype = $('#type_of_datasource_id').val();
        var text = $(this).text();
        var dataSourceType = $(this).attr('data-sourceType');
        var dataSourceName = $(this).attr('data-sourcename');
        var dataCollections = @json($dataCollections);
        var fullId = $(this).attr('id');
        var parts = fullId.split('--');
        var collectionId = parts[0];
        var fieldName = parts[1];
        var collectionName = dataCollections[collectionId];
        selectedFieldName = fieldName;
        
        // Determine the result based on the data source type
        var result = '';
        /*
        console.log("collectionName", collectionName);
        console.log("fieldName", fieldName);
        console.log("dataSourceName", dataSourceName);
        console.log("dataSourceType", dataSourceType);
        */
        console.log("selected ffield name", selectedParticipantTypeName);
        if (dataSourceType === "Actionstep") {
            result = `${collectionName}_${fieldName}`;
        } else if (dataSourceType === "Participant") {
            var label = $(`#participant_type${selectedParticipantTypeName} p`).attr('data-collection-label');

            result = `${dataSourceName}|pt=${label}`;
        } else {
            // Handle other types or default case
            result = `${dataSourceName}_${fieldName}`;
        }

        $('.data_source_field').css('background-color', '#fff');
        $('#data_source_field' + id).css('background-color', '#C8D0D5');
        $('#result').val(result);



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getDataSourceOption/' + text,
            type: 'GET',
            data: {
                'source_id': sourcetype
            },
            success: function success(result) {
                if (result.success) {
                    var data = result.data;
                    // var dataSourcetype = result.field[0].data_source_type;
                    var dataSourcetype = result.field?.[0]?.data_source_type;

                    // console.log(dataSourcetype);

                    var resp_data = "";
                    if (dataSourcetype == "Custom") {
                        $.each(data, function(key, val) {
                            // console.log(val.id);
                            // console.log(val.data_source_type);
                            resp_data += `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options size" data-sourcetype="Custom" data-val="${val.option_value}" id="${val.id}">${val.option_name}</p>
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
                    } else {
                        $.each(data, function(key, val) {
                            // console.log(val.id);
                            // console.log(val.data_source_type);
                            resp_data += `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options size" data-sourcetype="Participant" data-val="${val.option_value}" id="${val.id}">${val.option_name}</p>
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
                    }


                    $('.data_options').html(resp_data);
                }
            },
            // error: function error(result) {
            //     printErrorMessage('#validationErrorsBox', result);
            // },
        });

        // var text = $(this).text();
        //    console.log(dataSourceName);
        // $("#result").val(function() {
        //     if (dataSourceType == "Custom") {
        //         if ($(this).val() == '') {
        //             return dataSourceName + '_' + text;
        //         } else {
        //             return dataSourceName + '_' + text;
        //         }
        //     } else if (dataSourceType == "Default") {
        //         if ($(this).val() == '') {
        //             return text;
        //         } else {
        //             return text;
        //         }
        //     } else {
        //         if ($(this).val() == '') {
        //             return text + '|' + dataSourceName;
        //         } else {
        //             return text + '|' + dataSourceName;
        //         }
        //     }



        // });
    });

    // Getting Data Source Options By Option Type
    $(document).on('click', '.field_option_icon', function() {
        var id = $(this).attr('data-id');
        var sourcetype = $('#type_of_datasource_id').val();
        if (id == 'Flip') {
            $(this).toggleClass("toggleclass");
        }

        var className = $(this).is('.toggleclass');


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'getDataSourceOptionByType/' + id,
            type: 'GET',
            data: {
                'source_id': sourcetype
            },
            success: function success(result) {

                if (result.success) {
                    var data = result.data;
                    var resp_data = "";
                    var dataSourcetype = result.field[0].data_source_type;
                    if (dataSourcetype == "Custom") {
                        $.each(data, function(key, val) {
                            if (id != 'Flip' || className == true) {

                                resp_data += `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options size" data-sourcetype="Custom" data-val="${val.option_value}" id="${val.id}">${val.option_name}</p>
                            </div>
                            <div class="col-2">
                            @if(Auth::user()->role=='Admin')
                                <a  id="${val.id}" class="getDataSourceOptionBtn" style="cursor:pointer;">
                                <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">

                                </a>
                                @endif
                            </div>
                        </div>`;
                            } else {
                                resp_data += `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options size" data-sourcetype="Custom" data-val="${val.option_value}" id="${val.id}">${val.option_value}</p>
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
                    } else(
                        $.each(data, function(key, val) {
                            if (id != 'Flip' || className == true) {

                                resp_data += `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options size" data-sourcetype="Participant" data-val="${val.option_value}" id="${val.id}">${val.option_name}</p>
                            </div>
                            <div class="col-2">
                            @if(Auth::user()->role=='Admin')
                                <a  id="${val.id}" class="getDataSourceOptionBtn" style="cursor:pointer;">
                                <img src="{{asset('public/images/Icons/edit.svg')}}" class="editIcon d-inline float-end border ms-1"  alt="edit" title="edit">

                                </a>
                                @endif
                            </div>
                        </div>`;
                            } else {
                                resp_data += `<div class="row data_source_option" id="data_source_option${val.id}">
                            <div class="col-10" style="cursor:pointer;">
                                <p class="data_source_options size" data-sourcetype="Participant" data-val="${val.option_value}" id="${val.id}">${val.option_value}</p>
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
                    )

                    $('.data_options').html(resp_data);
                }
            },

        });
    });

    $('#createDataSourceType').submit(function(event) {
        var sourcetype = $('#type_of_datasource_id').val();

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
                    // console.log(result.field);
                    var dataSourceName = result.field[0].data_source_type;
                    // console.log(dataSourceName)
                    if (dataSourceName === "Participant") {
                        console.log("in if")
                        fetch_participantfield(sourcetype);
                    } else {
                        console.log("in else")
                        fetch_DataSourceField(sourcetype);
                    }
                    $("#result").val();
                }
                $("#result").val("");
            },
            error: function error(result) {
                printErrorMessage('#validationErrorsBoxDST', result);
            },
        });


    });
</script>


@endsection