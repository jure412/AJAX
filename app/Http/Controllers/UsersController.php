<?php

namespace App\Http\Controllers;

use App\People;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::all();
        $types = Type::all();
        return view('welcome', compact('types', 'people'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $people = People::all();
        // return response()->json($people);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $insert = new People;
            $insert->name = $request->name;
            $insert->robot = $request->check;
            $insert->rating = $request->rating;
            $insert->age = $request->age;
            $insert->save();
            $types = $request->types;
            if(count($types) > 0) {
                // $type = $types[0];
                foreach($types as $type) {
                    $insert->types()->attach($type);
                }
            }


            $people = People::all();
            return response()->json($people);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = Type::all();
        $person = People::find($id);
        $selected = DB::table('people_type')->where('people_id', $id)->get();
        return response()->json([ 'person' => $person,  'types' => $types, 'selected' => $selected]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $person = People::find($id);
        $person->name = $request->name;
        $person->robot = $request->check;
        $person->age = $request->age;
        $person->save();
        $types = $request->types;
        // if(count($types) > 0) {
            $person->types()->sync($types);
        // }

        $people = People::all();
        return response()->json($people);
    }

    public function delete(Request $request, $id)
    {

        $person = People::find($id);
        $person->types()->detach();
        $person->delete();

        $people = People::all();
        return response()->json($people);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
