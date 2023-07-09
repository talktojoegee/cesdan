<?php

namespace App\Http\Controllers;

use App\Models\LocalGovernment;
use Illuminate\Http\Request;

class ShareResourceController extends Controller
{
    public function __construct(){
        $this->localgovernment = new LocalGovernment();
    }

    public function loadLocalGovernments(Request $request){
        $this->validate($request,[
            'stateOfOrigin'=>'required'
        ]);
        $lgas = $this->localgovernment->getLocalGovernmentsByStateId($request->stateOfOrigin);
        return view('partials._local-governments', ['lgas'=>$lgas]);
    }

}
