<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class GridController extends Controller
{
    public function getIndex(){
        return view('index');
    }

    public function getData(Request $request){
        $list = \DB::table('data');

        if($request->has('sidx')){
            switch ($request->get('sidx')) {
                case 'id':
                    $list->orderBy('id', ($request->get('sord') =='desc'?'DESC':'ASC'));
                    break;
                case 'title':
                    $list->orderBy('title', ($request->get('sord') =='desc'?'DESC':'ASC'));
                    break;
                case 'description':
                    $list->orderBy('description', ($request->get('sord') =='desc'?'DESC':'ASC'));
                    break;
                case 'created':
                    $list->orderBy('created_at', ($request->get('sord') =='desc'?'DESC':'ASC'));
                    break;
            }
        }

        $grid_data = $list->skip(($request->get('page')-1)*20)
                            ->take(20)
                            ->get();

        return response()->json(['rows' => $grid_data]);
    }


    public function postData(StoreData $request)
    {

        return response()->json(['ok' => 1]);
    }


    public function postUpdateData(Request $request)
    {

        if($request->has('oper')){
            switch ($request->get('oper')) {
                case 'add':
                        Data::create([
                            'title'       => trim($request->title),
                            'description' => trim($request->description),
                        ]);
                    break;
                case 'edit':
                        $data = Data::find($request->get('id'));
                        if(!empty($data)){
                            $data->fill([
                                'title'       => trim($request->get('title')),
                                'description' => trim($request->get('description')),
                             ])->save();
                        }
                    break;
                case 'del':
                    $data = Data::find($request->get('id'));
                    if( $data ){
                        $data->delete();
                    }
                    break;

            }
        }

        return response()->json(['ok' => 1]);

    }


    public function deleteData($id){

        return response()->json(['ok' => 1]);
    }


}
