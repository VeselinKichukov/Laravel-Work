<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\orders;
use DB;
use App\Http;
use App\Providers;
use Illuminate\Support\Facades\Gate;
use DateTime;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    use ValidatesRequests;

    protected $order_id;

    public function index(){
        // using Equolent
        $orders = orders::all()->where('user_id', Auth::user()->id);

        return view('orders', compact('orders'));
    }

    public function create(){

        return view('new');
    }

    public function create_post(Request $requests){
        $id = Auth::user()->id;
        //return $id;


        DB::table('orders')->insert(['title' => $requests->title, 'description' => $requests->description, 'user_id' => $id, 'created_at' => new DateTime, 'updated_at' => new DateTime, ]);

        return redirect('orders');
    }

    public function edit($id){
        $order = orders::find($id);
        //$this.$this->order_id = $order;

        return view('edit_order', compact('order'));
    }

    public function update(Request $request, orders $orders)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $orders = orders::where([['id','=', $request->id],['user_id','=', Auth::user()->id]]) -> get()->first();
        //$orders->update($request->all());
        //$orders->update(['title' => $request->title, 'Description' => $request->description]);
        $orders->title = $request->title;
        $orders->Description = $request->description;
        $orders->update();
        return redirect('/orders');
    }


    public function delete($id){
        //$orders = $request -> all();
        //$x = $request->all();
        $model = orders::where([['id','=', $id],['user_id','=', Auth::user()->id]])->get()->first();
        //echo($model);
        if(Gate::allows('update-post', $model)){

            $model->delete();
            return redirect('/orders');
        } else
            return redirect('orders');
    }
}
