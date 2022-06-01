<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model\Persons;
use Illuminate\Support\Facades\Validator;



class PersonsController extends Controller
{
    public function index() {


        $persons = Persons::select('persons.*')->get()->toArray();

        return response()->json($persons);
    }



    public function store(Request $request) {

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:persons|max:255',
            'address' => 'nullable|max:255',
            'age' => 'required|numeric',

        ]);
        if ($validator->fails()) {
            return response()->json([
            'ok' => false, 'error' => $validator -> messages(),
        ]);
    }

    try {
        Persons::create($input);
        return response()->json([
            'ok' => true, 'message' => 'Person created successfully'
        ]);
    }

    catch (\Exception $ex) {
        return response()->json([
            'ok' => false, 'error' => $ex -> getMessage(), ]);

            }
        }

        public function show($id) {
            $persons = Persons::select('persons.*')->where('persons.id', $id)->first();
            return response()->json([
                'ok' => true, 'data' => $persons]);
        }

        public function update(Request $request, $id) {

            $input = $request->all();
            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'address' => 'nullable|max:255',
                'age' => 'required|numeric',
            ]);
            if($validator->fails()) {
                return response()->json([
                    'ok' => false, 'error' => $validator -> messages(),
                ]);
        } try {

         $persons = Persons::find($id);
         if($persons == false) {
             return response()->json([
                 'ok' => false, 'error' => 'Person not found'

                ]);
        }

    $persons->update($input);
    return response()->json([
        'ok' => true, 'message' => 'Person updated successfully'
    ]);
    } catch (\Exception $ex) {

        return response()->json([
            'ok' => false, 'error' => $ex -> getMessage(), ]);
    }

        }


        public function destroy($id) {

            try {
                $persons = Persons::find($id);
                if($persons == false) {
                    return response()->json([
                        'ok' => false, 'error' => 'Person not found'
                    ]);
                }

                $persons->delete([]);
                return response()->json([
                    'ok' => true, 'message' => 'Person deleted successfully'
                ]);
        } catch (\Exception $ex) {
            return response()->json([
                'ok' => false, 'error' => $ex -> getMessage(), ]);
        }


  }
}
