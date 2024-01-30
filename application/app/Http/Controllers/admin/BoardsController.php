<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
//additional_namespaces//
use App\Models\Boards;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class BoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function delete_all(){
    $request_all=request()->all();

    if(isset($request_all['id']) and is_array($request_all['id'])){
        Boards::query()->whereIn("id",$request_all['id'])->delete();
        return back();
    }



    }

    public function index()
{
    //
    $request_all=request()->all();



    $boards=Boards::query()->where(function($query) use ($request_all){
        if(isset($request_all['enable']) and $request_all['enable']==1){
            $query->where("enable",1);
        }
        if(isset($request_all['enable']) and $request_all['enable']==2){
            $query->where("enable",0);
        }

        if(isset($request_all['data_type']) and $request_all['data_type']==1 and isset($request_all['date_create_from'])){
            $query->where('created_at', '>=', date('Y-m-d',strtotime($request_all['date_create_from'])).' 00:00:00');
            $query->where('created_at', '<=', date('Y-m-d',strtotime($request_all['date_create_from'])).' 23:59:00');

        }

        if(isset($request_all['data_type']) and $request_all['data_type']==3 and isset($request_all['date_create_from'])  and isset($request_all['date_create_to'])){
            $query->where('created_at', '>=', date('Y-m-d',strtotime($request_all['date_create_from'])).' 00:00:00');
            $query->where('created_at', '<=', date('Y-m-d',strtotime($request_all['date_create_to'])).' 23:59:00');

        }


    });
    if(isset($request_all['orderby']) and $request_all['orderby']=="desc"){
        $boards = $boards->orderByDesc("sort");
    }else {
        $request_all['orderby']="asc";
        $boards = $boards->orderBy("sort");
    }

    $boards=$boards->paginate(10)->appends(request()->query());

    $data=array();
    $data['boards']=$boards;
    $data['request_all']=$request_all;

    return view('admin.boards.index', $data)
        ->with('i', (request()->input('page', 1) - 1) * 5);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data_create=array();
        //data_create//
        return view('admin.boards.create',$data_create);
    }

    public function  clone_object($id){
    $boards=Boards::query()->find($id);
    if(!isset($boards)){
        return back()->withErrors(["Не найден обьект для клона"]);
    }
    $new_obj=$boards->replicate();
    $new_obj->save();
    $new_obj->sort=$new_obj->id;
    $new_obj->save();

    return back()->with("success","Клонирование прошло успешно!");
}
    public function change_position(){

    $all=request()->all();


    if(!(isset($all['current']) and isset($all['replace']) and is_numeric($all['current']) and is_numeric($all['replace']))){
        return 0;
    }
    $current=Boards::query()->where("sort",$all['current'])->first();
    $replace=Boards::query()->where("sort",$all['replace'])->first();
    if(!$current){
        return 0;
    }
    $current->sort=$all['replace'];
    $current->save();
    if($replace){
        $replace->sort=$all['current'];
        $replace->save();
    }
    return 1;
}
    public function toogle($id){
    $boards=Boards::query()->find($id);
    $value=request()->get("val");
    if(!$value){
        $value=0;
    }
    if($boards){
        $boards->enable=$value;
        $boards->save();
    }
    return  $boards->enable;

}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // custom error
        //  return response()->json(['errors' => ['email' => ['The email is invalid.']]], 422);
        $validated=$request->validate([
             'title' => ['required','max:200',],
             'alias' => ['unique:App\Models\Boards,alias','required','max:200',],

        ]);

        $boards=new Boards();
         if(count($validated)>0){
             foreach($validated as $name_field=>$val){
                 $boards->$name_field=$val;
             }
        }

        $boards->sort=$boards->id;


         $boards->description=request()->post('description');

$boards->save();

          $after_save=request()->post("after_save");
        if(isset($after_save) and $after_save=="edit"){

            return array('link'=>route('admin.boards.edit', $boards->id));
        }else {
            return array('link'=>route('admin.boards.index'));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Boards  $boards
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boards=Boards::query()->find($id);
        if(!$boards){
            return abort(404);
        }
        //
        $data=array();
        $data['boards']=$boards;
        return view('admin.boards.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Boards  $boards
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boards=Boards::query()->find($id);
        if(!$boards){
            return abort(404);
        }
        //
        $data_edit=array();
        $data_edit['boards']=$boards;
        //data_edit//
        return view('admin.boards.edit', $data_edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Boards  $boards
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $boards=Boards::query()->find($id);
        if(!$boards){
            return abort(404);
        }
        $request=request();
        //
        // custom error
        //  return response()->json(['errors' => ['email' => ['The email is invalid.']]], 422);
        $validated=$request->validate([
            'title' => ['required','max:200',],
            'alias' => ['required','max:200',Rule::unique('boards')->ignore($id)],


        ]);
        $boards->update($validated);
         $boards->description=request()->post('description');

$boards->save();


        $after_save=request()->post("after_save");
        if(isset($after_save) and $after_save=="edit"){

            return array('link'=>route('admin.boards.edit', $boards->id));
        }else {
            return array('link'=>route('admin.boards.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Boards  $boards
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boards=Boards::query()->find($id);
        if(!$boards){
            return abort(404);
        }
        //
        $boards->delete();

        return redirect()->route('admin.boards.index')
            ->with('success', 'Document deleted successfully');
    }
}
