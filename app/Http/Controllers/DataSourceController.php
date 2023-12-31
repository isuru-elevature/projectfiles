<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\DataSource;
use App\Models\DataSourceType;
use App\Models\DataSourceOption;
use App\Models\ResultModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Exception, Validator;
use DB;
use Auth;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Session;
//i use access toke in 3 places
class DataSourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delete_dataSource($id)
    {
        $delete =  DataSource::find($id);
        $delete->status = '0';
        $delete->update();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function delete_dataSourceField(Request $request, $id)
    {
        $delete = DataSourceType::find($id);
        $delete->status = '0';
        $delete->update();
        $dataSourceType = DataSource::where('id', $request->source_id)->get();
        return response()->json([
            'success' => 'Record deleted successfully!',
            'field' => $dataSourceType,
        ]);
    }

    public function fetch_dataSource()
    {
        if (Auth::id() == 1) {
            $dataSources = DataSource::select('id', 'name', 'data_source_type', 'status', 'DisplayOrder')
                // ->where('created_by',Auth::id())
                ->orderBy('DisplayOrder', 'asc') // Order by DisplayOrder
                ->get();
        } else {
            $dataSources = DataSource::select('id', 'name', 'data_source_type', 'status', 'DisplayOrder')
                // ->OrWhere('created_by',Auth::id())
                ->Where('created_by', 1)
                ->OrWhere('created_by', Auth::id())
                ->orderBy('DisplayOrder', 'asc') // Order by DisplayOrder
                ->get();
        }
        return response()->json([
            'success' => true,
            'data' => $dataSources,
        ]);
    }
    
    public function index()
    {
        $dataSources = DataSource::select('id', 'name', 'data_source_type', 'status', 'DisplayOrder')
            ->orderBy('DisplayOrder', 'asc') 
            ->get();

//now im trying to get the access token via login
        //$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhIjoiTmpZNVlqY3lPRE00TmpjMU16bGpaV013T1RjMU1HRm1Nek5tWTJJMU4yTTNNV1l5WVRGalpHRTNOMk16IiwiYiI6Im5ld3N0YWZmZWxlIiwiYyI6IjEwLjExLjIxLjMyIiwiZyI6IlQxNi0xMjUtMSIsImUiOiJGIiwiZiI6IkF1c3RyYWxpYVwvQnJpc2JhbmUiLCJoIjoiYiIsImQiOiIiLCJuYmYiOjE2OTkzOTgyNjQsImV4cCI6MTY5OTQyNzA3NH0.mM74oH4lwc7u6D6lY2T0qSYrZF5z_0-j1fykZqUNLjs2JzGJABYLhdg-yYg0DtrbujuWbdCwyRel35QbrQYGK1DHizBMLqRnkjQiVWvyUM1QiO1-ukMxBwIzdqxoSxPqaAPGZErBQLGU2UZF46BcTS2IkJC55de4MmCxSthDxoGw-6ZpeQFtHMXbDLCIs_6cb-s2vc7PHyxPJ9xrzsXuudiMgwkQrJsQW2OfV1Ef3OqquACtFqrgMhQ1CwF94qNCMqqzYkKwoGNnKaGqMVZyfyo5dzq2Pz84M99_s-solC5Yy33UYqPCZ3f3fIzKGayX946yPLlTneuvia0RBIhrQg';

        $accessToken = Session::get('access_token');

        // API URLs
        $apiUrl = 'https://ap-southeast-2.actionstep.com/api/rest/actiontypes';
        $datacollectionsUrl = 'https://ap-southeast-2.actionstep.com/api/rest/datacollections?pageSize=200';
        $datacollectionsFieldsUrl = 'https://ap-southeast-2.actionstep.com/api/rest/datacollectionfields?pageSize=200';
        $participanttypesUrl = 'https://ap-southeast-2.actionstep.com/api/rest/participanttypes';
        $participanttypedatafieldsUrl = 'https://ap-southeast-2.actionstep.com/api/rest/participanttypedatafields';

        // Fetch data from Actionstep API
        $actionstepData = $this->makeApiRequest($apiUrl, $accessToken);
        $dataCollectionsData = $this->makeApiRequest($datacollectionsUrl, $accessToken);
        $dataCollectionsFieldsData = $this->makeApiRequest($datacollectionsFieldsUrl, $accessToken);
        $participantTypesData = $this->makeApiRequest($participanttypesUrl, $accessToken);
        $participantTypedatafieldsData = $this->makeApiRequest($participanttypedatafieldsUrl, $accessToken);


        $actionTypesWithDataCollections = [];


        foreach ($dataCollectionsData['datacollections'] as $collection) {
            $actionTypeId = $collection['links']['actionType'] ?? null;
            if ($actionTypeId) {
                foreach ($actionstepData['actiontypes'] as $actionType) {
                    if ($actionType['id'] == $actionTypeId) {
                        $actionTypeName = $actionType['name'];
                        $actionTypesWithDataCollections[$actionTypeId][$collection['label']] = $collection['id'];
                        break;
                    }
                }
            }
        }

        $dataCollectionFieldsByCollection = [];
        foreach ($dataCollectionsFieldsData['datacollectionfields'] as $field) {
            $dataCollectionId = $field['links']['dataCollection'] ?? null;
            if ($field['dataType'] !== 'HtmlReadOnly' && $dataCollectionId) {
                $dataCollectionFieldsByCollection[$dataCollectionId][] = [
                    'id' => $field['id'],
                    'name' => $field['label']
                ];
            }
        }//

        /*
        $participantTypesWithFields = [];
        foreach ($participantTypesData['participanttypes'] as $participantType) {
            $participantTypeId = $participantType['id'];
            $participantTypeName = $participantType['displayName'];
            $fields = array_filter($participantTypedatafieldsData['participanttypedatafields'], function ($field) use ($participantTypeId) {
                return $field['links']['participantType'] == $participantTypeId;
            });
            
            $mappedFields = array_map(function ($field) {
                return $field['label'];
            }, $fields);

            
            $participantTypesWithFields[$participantTypeId]['name'] = $participantTypeName;
            $participantTypesWithFields[$participantTypeId]['fields'] = $mappedFields;
        }
        */
        $participantTypes = [];

        foreach ($participantTypesData['participanttypes'] as $participantType) {
            $participantTypes[$participantType['id']] = [
                'name' => $participantType['name'],
                'displayName' => $participantType['displayName'],
                'description' => $participantType['description'],
                'isBaseParticipantType' => $participantType['isBaseParticipantType'],
                'companyFlag' => $participantType['companyFlag'],
                'taxNumberAlias' => $participantType['taxNumberAlias']
            ];
            //this is the backend where i harddcode the access token to test before i implement this actionstep login
        }
        $dataCollections = [];
        foreach ($dataCollectionsData['datacollections'] as $collection) {
            $dataCollections[$collection['id']] = $collection['name'];
        }

        return view('DataSource.index', [
            'dataSources' => $dataSources,
            'actionstepData' => $actionstepData,
            'actionTypesWithDataCollections' => $actionTypesWithDataCollections,
            'dataCollectionFieldsByCollection' => $dataCollectionFieldsByCollection,
            'dataCollections' => $dataCollections,
            'participantTypesWithFields' => $participantTypes
        ]);
    }

    private function makeApiRequest($url, $accessToken)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/vnd.api+json',
            'Accept: application/vnd.api+json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            // Handle error - perhaps log it and return an empty array or null
            return null;
        }

        curl_close($ch);
        return json_decode($response, true);
    }


    public function createDataSource(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255',],
            'data_source_type' => ['required', 'string', 'max:255',],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        $data['name'] = $request->name;
        $data['data_source_type'] = $request->data_source_type;
        $id = Auth::id();
        $data['created_by'] = $id;



        if ($request->id) {

            $create = DataSource::where('id', $request->id)->update($data);
            $message = "Data Source updated Successfully!";
        } else {
            $create = DataSource::create($data);
            $message = "Data Source Created Successfully!";
        }

        if ($create) {
            return response()->json([
                'success' => true,
                'message' =>  $message,
            ], 200);
        }
    }
    public function createDataSourceType(Request $request)
    {
        //    echo $request;
        $validator = Validator::make($request->all(), [
            'dataSourceName' => ['required', 'string', 'max:255'],
            'mergeFieldDescription' => ['required', 'string', 'max:255'],
            'data_source_type' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $data['dataSourceName'] = $request->dataSourceName;

        if ($request->type_of_datasource == "Participant") {
            $data['dataSourceType'] = "Participant";
        } else {
            $data['dataSourceType'] = $request->data_source_type;
        }
        $data['mergeFieldDescription'] = $request->mergeFieldDescription;
        $id = Auth::id();
        $data['created_by'] = $id;

        if ($request->data_source_type_id) {

            $create = DataSourceType::where('id', $request->data_source_type_id)->update($data);
            $message = "Data Source Type Updated Successfully!";
        } else {
            $create = DataSourceType::create($data);
            $message = "Data Source Type Created Successfully!";
        }

        $dataSourceType = DataSource::where('id', $request->type_of_datasource_id)->get();
        if ($create) {
            return response()->json([
                'success' => true,
                'message' =>  $message,
                "field" => $dataSourceType,
            ], 200);
        }
    }

    public function createDataSourceOption(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'option_type' => ['required', 'string', 'max:255'],
            'option_name' => ['required', 'string', 'max:255'],
            'option_value' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $data['option_type'] = $request->option_type;
        $data['option_name'] = $request->option_name;
        $data['option_value'] = $request->option_value;

        if ($request->option_id) {

            $create = DB::table('data_source_options')->where('id', $request->option_id)->update($data);
            $message = "Data Source Option Updated Successfully!";
        } else {
            $create = DataSourceOption::create($data);
            $message = "Data Source Option Created Successfully!";
        }


        if ($create) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'error' => "Something Went Wrong !",
            ], 501);
        }
    }


    public function createResult(Request $request)
    {
        $request->validate([
            'result' => ['required'],

        ]);

        $data['result'] = $request->result;
        $data['user_id'] = Auth::user()->id;

        ResultModel::insert($data);

        return back()->with('success', 'Data is  successfully added .');
    }


    public function getResult(Request $request)
    {
        $data = ResultModel::where('user_id', Auth::user()->id)->get();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => $data,
            ]);
        }
    }


    public function deleteResult(Request $request, $id)
    {
        $data = ResultModel::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => "successfully deleted ",
        ]);
    }

    public function getDataSourceType(Request $request, $id)
    {
        $dataSourceType = DataSource::where('id', $id)->with('getDataSourceType')->get();
        if (Auth::id() == 1) {
            $dataField = DataSourceType::where('dataSourceType', $id)
                // ->where('created_by',Auth::id())
                ->get();
        } else {
            $dataField = DataSourceType::where('dataSourceType', $id)

                ->Where('created_by', 1)
                ->OrWhere('created_by', Auth::id())
                // ->Where('dataSourceType',! "participant")
                ->where('dataSourceType', $id)
                ->get();
        }


        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => $dataSourceType,
                'field' => $dataField,
            ]);
        }
    }

    public function getActionstepCollection(Request $request, $id)
    {

        //$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhIjoiTmpZNVlqY3lPRE00TmpjMU16bGpaV013T1RjMU1HRm1Nek5tWTJJMU4yTTNNV1l5WVRGalpHRTNOMk16IiwiYiI6Im5ld3N0YWZmZWxlIiwiYyI6IjEwLjExLjIxLjMyIiwiZyI6IlQxNi0xMjUtMSIsImUiOiJGIiwiZiI6IkF1c3RyYWxpYVwvQnJpc2JhbmUiLCJoIjoiYiIsImQiOiIiLCJuYmYiOjE2OTkzOTgyNjQsImV4cCI6MTY5OTQyNzA3NH0.mM74oH4lwc7u6D6lY2T0qSYrZF5z_0-j1fykZqUNLjs2JzGJABYLhdg-yYg0DtrbujuWbdCwyRel35QbrQYGK1DHizBMLqRnkjQiVWvyUM1QiO1-ukMxBwIzdqxoSxPqaAPGZErBQLGU2UZF46BcTS2IkJC55de4MmCxSthDxoGw-6ZpeQFtHMXbDLCIs_6cb-s2vc7PHyxPJ9xrzsXuudiMgwkQrJsQW2OfV1Ef3OqquACtFqrgMhQ1CwF94qNCMqqzYkKwoGNnKaGqMVZyfyo5dzq2Pz84M99_s-solC5Yy33UYqPCZ3f3fIzKGayX946yPLlTneuvia0RBIhrQg';
        $accessToken = Session::get('access_token');
        $datacollectionsFieldsUrl = "https://ap-southeast-2.actionstep.com/api/rest/datacollectionfields?dataCollection_eq={$id}";
        $dataCollectionsFieldsData = $this->makeApiRequest($datacollectionsFieldsUrl, $accessToken);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => $dataCollectionsFieldsData,
            ]);
        }
    }

    public function getActionstepParticipantCollection(Request $request, $id)
{
    //$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhIjoiTmpZNVlqY3lPRE00TmpjMU16bGpaV013T1RjMU1HRm1Nek5tWTJJMU4yTTNNV1l5WVRGalpHRTNOMk16IiwiYiI6Im5ld3N0YWZmZWxlIiwiYyI6IjEwLjExLjIxLjMyIiwiZyI6IlQxNi0xMjUtMSIsImUiOiJGIiwiZiI6IkF1c3RyYWxpYVwvQnJpc2JhbmUiLCJoIjoiYiIsImQiOiIiLCJuYmYiOjE2OTkzOTgyNjQsImV4cCI6MTY5OTQyNzA3NH0.mM74oH4lwc7u6D6lY2T0qSYrZF5z_0-j1fykZqUNLjs2JzGJABYLhdg-yYg0DtrbujuWbdCwyRel35QbrQYGK1DHizBMLqRnkjQiVWvyUM1QiO1-ukMxBwIzdqxoSxPqaAPGZErBQLGU2UZF46BcTS2IkJC55de4MmCxSthDxoGw-6ZpeQFtHMXbDLCIs_6cb-s2vc7PHyxPJ9xrzsXuudiMgwkQrJsQW2OfV1Ef3OqquACtFqrgMhQ1CwF94qNCMqqzYkKwoGNnKaGqMVZyfyo5dzq2Pz84M99_s-solC5Yy33UYqPCZ3f3fIzKGayX946yPLlTneuvia0RBIhrQg'; // Replace with your actual access token
    $accessToken = Session::get('access_token');
    $participantTypedatafieldsUrl = "https://ap-southeast-2.actionstep.com/api/rest/participanttypedatafields?participantType_eq={$id}";
    $participantTypedatafieldsData = $this->makeApiRequest($participantTypedatafieldsUrl, $accessToken);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'status' => 200,
            'data' => $participantTypedatafieldsData,
        ]);
    } else {
        // Handle non-AJAX request if necessary
        return view('someview', ['data' => $participantTypedatafieldsData]);
    }
}

    public function getparticipantfield(Request $request, $id)
    {
        // $dataField=[];
        // dd(auth::id());
        $dataSourceType = DataSource::where('id', $id)->with('getDataSourceType')->get();
        if (Auth::id() == 1) {
            $dataField = DataSourceType::where('dataSourceType', "Participant")
                // ->where('created_by',Auth::id())
                ->get();
        } else {
            $dataField = DataSourceType::where('dataSourceType', "Participant")
                ->Where('created_by', 1)
                ->orWhere('created_by', Auth::id())

                // ->where('dataSourceType',"Participant")
                // ->where('dataSourceType',$id)

                ->get();
        }


        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'field' => $dataField,
                'data' => $dataSourceType,
            ]);
        }
    }

    public function getDataSourceOption(Request $request, $id)
    {

        $text = 'Text';
        if (str_contains($id, 'Date') || str_contains($id, 'year')) {
            $text = 'Calendar';
        } else if (str_contains($id, 'Number') || str_contains($id, 'Amount')) {
            $text = 'Numbers';
        } else if (str_contains($id, 'pronoun')) {
            $text = 'Grammar';
        } else if (str_contains($id, 'Phone')) {
            $text = 'Phones';
        }
        session::put('data_source_icon', $text);

        $source_id = $request->source_id;
        $dataSourceType = DataSource::where('id', $source_id)->with('getDataSourceType')->first();

        // If dataSourceType is null, create a default object with a default data_source_type
        if (is_null($dataSourceType)) {
            $dataSourceType = new \stdClass();
            $dataSourceType->data_source_type = 'default'; 
        }

        $dataSourceOption = DB::table('data_source_options')->where('option_type', $text)->get();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => $dataSourceOption,
                'field' => [$dataSourceType], 
            ]);
        }
    }

    public function getDataSourceOptionByType(Request $request, $id)
    {
        if ($id != 'Flip') {
            session::put('data_source_icon', $id);
            $dataSourceOption = DB::table('data_source_options')->where('option_type', $id)->get();
        } else {
            $dataSourceOption = DB::table('data_source_options')->where('option_type', session::get('data_source_icon'))->get();
        }

        $source_id = $request->source_id;
        $dataSourceType = DataSource::where('id', $source_id)->with('getDataSourceType')->first();

        
        if (is_null($dataSourceType)) {
            $dataSourceType = new \stdClass();
            $dataSourceType->data_source_type = 'default'; 
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => $dataSourceOption,
                'field' => [$dataSourceType], // Ensure field is always an array
            ]);
        }
    }

    public function editDataSource(Request $request, $id)
    {


        $data = DataSource::where('id', $id)->first();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => $data,
            ]);
        }
    }

    public function editDataSourceType(Request $request, $id)
    {


        $data = DataSourceType::where('id', $id)->first();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => $data,
            ]);
        }
    }

    public function editDataSourceOption(Request $request, $id)
    {


        $data = DB::table('data_source_options')->where('id', $id)->first();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => $data,
            ]);
        }
    }




    // public function upload(Request $request)
    // {

    //         if ( $request->hasFile('file')) {
    //         $file = $request->file;
    //         $filename = $file->getClientOriginalName();
    //         $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
    //         $tempPath = $file->getRealPath();
    //         $fileSize = $file->getSize(); //Get size of uploaded file in bytes
    //         $location = public_path() . '/storage/category'; //Created an "uploads" folder for that

    //         $file->move($location, $filename);
    //         $filepath = public_path('/storage/category/'.$filename);

    //         $csv= file_get_contents($filepath);
    //         $array = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $csv));
    //         $json = json_encode($array);

    //         $file = fopen($filepath, "r");
    //         $importData_arr = array(); // Read through the file and store the contents as an array

    //         $i = 0;
    //         $insert_data = [];
    //         //Read the contents of the uploaded file 
    //         while (($filedata = fgetcsv($file, 5000, ",")) !== FALSE) {


    //         $num = count($filedata);
    //         if ($i == 0) {
    //         $i++;
    //         continue;
    //         }
    //         for ($c = 0; $c < $num; $c++) {

    //             $importData_arr[$i][] = $filedata[$c];
    //         }
    //         $i++;
    //         }
    //         fclose($file); //Close after reading

    //         foreach ($importData_arr as $importData) {


    //             DB::table('data_source_fields')->insert([
    //                'dataSourceType'=>$importData[0],
    //                'dataSourceName'=>$importData[1],
    //                'mergeFieldDescription'=>$importData[2],
    //             ]);
    //         }



    //        }

    //       return back()->with(['message','success']);


    // }
}
