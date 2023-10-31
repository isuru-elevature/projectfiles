<!-- Create Data Source Modal -->
<div class="modal fade" id="createDataSourceModal" tabindex="-1" aria-labelledby="createDataSourceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataSourceModalLabel">Create Data Source</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(['id'=>'createDataSource']) !!}
                <div class="modal-body">
                    {{-- @php
                     $data=Auth::id();
                           echo $data;
                    @endphp --}}
                    <div class="alert alert-danger" style="display: none" id="validationErrorsBoxDS"></div>
                    <div class="row">
                        <div class="col-sm-12">
                                <div class="form-group">
                                <label for="data_source_type">Type of Data Source</label>
                                <!-- <input type="text" name="data_source_type" id="data_source_type" class="form-control data_source_type_field" required> -->  
                                 <select class="form-select data_source_type_field" name="data_source_type" id="data_source_type" required>
                                    <option selected=
                                    "selected" disabled="disabled">please select datasource</option>
                                    {{-- <option value="Default" disabled="disabled">Default</option> --}}
                                    {{-- <option value="Action">Action</option>
                                    <option value="Action Billing Settings">Action Billing Settings</option>
                                    <option value="Action Sale Data">Action Sale Data</option>
                                    <option value="Action Sale Payments Data">Action Sale Payments Data</option>
                                    <option value="Actionstep Payments">Actionstep Payments</option>
                                    <option value="Bill consolidation">Bill consolidation</option>
                                    <option value="Bill expenses/disbursements">Bill expenses/disbursements</option>
                                    <option value="Bill fees">Bill fees</option>
                                    <option value="Bill payments">Bill payments</option>
                                    <option value="Bill retainers">Bill retainers</option>
                                    <option value="Bill trust statement">Bill trust statement</option>
                                    <option value="Check">Check</option>  --}}
                                    <option value="Custom">Custom</option>
                                   
                                    {{-- <option value="Deposit slip">Deposit slip</option>
                                    <option value="Deposit slip items">Deposit slip items</option>
                                    <option value="Division/Company Data">Division/Company Data</option>
                                    <option value="Document Data">Document Data</option>
                                    <option value="Grammar">Grammar</option>
                                    <option value="Misc/Other">Misc/Other</option>  --}}
                                    <option value="Participant">Participant</option>
                                    {{-- <option value="Receipt Actions">Receipt Actions</option>
                                    <option value="Receipt Data">Receipt Data</option>
                                    <option value="Sale/Purchase Data">Sale/Purchase Data</option>
                                    <option value="Sale/Purchase Line Item Data">Sale/Purchase Line Item Data</option>
                                    <option value="System Data">System Data</option>
                                    <option value="Trust Accounting Data">Trust Accounting Data</option>
                                    <option value="Trust EFT Requisition">Trust EFT Requisition</option>
                                    <option value="Trust Payment Confirmation">Trust Payment Confirmation</option>
                                    <option value="Trust Receipt Actions">Trust Receipt Actions</option>
                                    <option value="Trust Statement">Trust Statement</option>
                                    <option value="Trust Statement Invoices">Trust Statement Invoices</option>
                                    <option value="Trust Statement Item">Trust Statement Item</option>
                                    <option value="Unpaid Client Invoices">Unpaid Client Invoices</option>
                                   --}}
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                       
                             <div class="form-group mt-3">
                                <label for="name">Name of Data Source</label>
                                <input type="text" name="name" id="name" class="form-control data_source_name" required>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="delete_id" class="data_source_id">
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

<!-- Create Data Source Type Modal -->
<div class="modal fade" id="createDataSourceTypeModal" tabindex="-1" aria-labelledby="createDataSourceTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataSourceTypeModalLabel">Create Data Source Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(['id'=>'createDataSourceType']) !!}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display: none" id="validationErrorsBoxDST"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                               
                                    <label for="name">Type of Data Source</label>
                                    <select name="data_source_type" id="data_source_type" class="form-control dataSourceType"  required>
                                        <option selected=
                                        "selected" disabled="disabled">please select datasource</option>
                                        {{-- <div class="dropdown">
                                        {{-- @foreach($dataSources as $data)
                                        @if($data->status==1)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                       @endif
                                        @endforeach 
                                        </div> --}}
                                    </select> 
                                
                                    <input type="hidden" class="form-control" id="type_of_datasource" name="type_of_datasource">
                                    <input type="hidden" class="form-control" id="type_of_datasource_id" name="type_of_datasource_id">

                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <label for="dataSourceName">Name of Data Source Field</label>
                                <input type="text" name="dataSourceName" id="dataSourceName" class="form-control dataSourceName" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <label for="mergeFieldDescription">Description of Data Source Field</label>
                                <textarea  name="mergeFieldDescription" id="mergeFieldDescription" class="form-control mergeFieldDescription" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="data_source_type_id" id="delete_field_id" class="data_source_type_id" value="">
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Create Data Source Option Modal -->
<div class="modal fade" id="createDataSourceOptionModal" tabindex="-1" aria-labelledby="createDataSourceOptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataSourceOptionModalLabel">Create Data Source Option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(['id'=>'createDataSourceOption']) !!}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display: none" id="validationErrorsBoxDSO"></div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="option_type">List field Options Type</label>
                                <select name="option_type" id="option_type" class="form-control option_type_class" required> 
                                    <option selected=
                                    "selected" disabled="disabled">please select List field</option>
                                    <option value="Text">Text</option>
                                    <option value="Numbers">Numbers</option>
                                    <option value="Phones">Phones</option>
                                    <option value="Calendar">Calendar</option>
                                    <option value="Repeat">Repeat</option>
                                    <option value="Logic">Logic</option>
                                    <option value="Grammar">Grammar</option>
                                    <option value="Images">Images</option>
                                    <option value="Sale & Purchase">Sale & Purchase</option>
                                    <option value="Sort">Sort</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="option_name">List field Options Name</label>
                                <input type="text" name="option_name" id="option_name" class="form-control option_name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mt-3">
                                <label for="option_value">List field Options Value</label>
                                <input type="text" name="option_value" id="option_value" class="form-control option_value" required>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="option_id" id="option_id" class="option_id">
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<script>
    let createDataSourceUrl = "{{route('createDataSource')}}";
    let createDataSourceTypeUrl = "{{route('createDataSourceType')}}";
    let createDataSourceOptionUrl = "{{route('createDataSourceOption')}}";
 
</script>


