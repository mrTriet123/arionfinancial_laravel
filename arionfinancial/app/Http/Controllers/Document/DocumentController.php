<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Docunments\ContractInforRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Debugbar;
use PDF;
use App\Models\Documents\DocumentContracts;
use Storage;
use Session;
use Response;
use Datetime;
use DB;
use App\Models\User\UserModel;
class DocumentController extends Controller
{
    public function __construct() {
        $ID = Session::get('UserID');
        $data = DB::table('tbluser')->where('UserID', $ID)->first();
        View::share('User', $data);

    }
    public function indexFinancial()
    {
        return view('documents.financial');
    }

    public function indexLeasing()
    {
        $userId = Session::get('UserID');
        // $customer = DB::table('tbluser')->where('UserID',$UserID)->first();
        $listCustomer = DB::table('tbluser')->where('WhoCreated', $userId)->get();
        // $listCustomer = DB::table('tbluser')->where('RoleID', 2)->get();
        $mapCb = function ($model) {
            return [$model->UserID => $model->UserName];
        };

        $mergeCb = function ($carry, $item) {
            return array_merge($carry, $item);
        };
        $createdCustomer = array_reduce(array_map($mapCb, $listCustomer), $mergeCb, []);
        return view('documents.leasing',['customerName' => $createdCustomer]);
    }
    public function viewPdf(Request $request)
    {
        $fileName = $request->name;
        $content = Storage::get($fileName);
        $title = 'document.pdf';
        return Response::make($content , 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$title.'"'
        ]);
    }
    public function listContract()
    {
        $userId = Session::get('UserID');
        $data = DocumentContracts::where('user_id', $userId)->get();
        return view('documents.lists', ['data' => $data]);
    }

    public function storeInformation(ContractInforRequest $request)
    {
        $userId = Session::get('UserID');
        
        $data = $request->all();
        $randomName = hash('md5', time().rand(1, 10000).$data['fname']).'.pdf';
        
        $data['dearlerInfor'] = UserModel::find($userId)->toArray();
        $data['file_name'] = $randomName;
        $data['user_id'] = $userId;
        $data['fpay'] = (new Datetime($data['fpay']))->format('Y-m-d');
        $data['birthday'] = (new Datetime($data['birthday']))->format('Y-m-d');

        $documentContract = DocumentContracts::create($data); 
        $data['id'] = $documentContract->id;

        if($request->save === 'Save')
        {
            $pdf = PDF::loadView('documents.contract', $data);
            Storage::disk('local')->put($randomName,  $pdf->output());


            return redirect()->route('lists-contract');
        } else {
            // return view('documents.contract', $data);
            $pdf = PDF::loadView('documents.contract', $data);
            return $pdf->stream('contract.pdf');
        }
    }
}
