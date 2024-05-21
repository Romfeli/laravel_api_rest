<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{

public function index() {

        $participants = Participant::all(); 

        if ($participants->isEmpty()) {
            

            $data = [
                'message' => 'no hay participantes registrados',
                'status' => 200
            ];

            return response()->json([$data],404);
        }

        return response()->json($participants,200);

        }

public function store(Request $request) {


    $validator = Validator::make($request->all(),[
        'dni' => 'required',
        'name_and_last_name' => 'required|max:255',
        'email' => 'required|email|unique:participant',
        'phone_number' => 'required',


    ]);

    if ($validator->fails()) {
        $data = [
            'message' => 'datos no validos',
            'errors' => $validator->errors(),
            'status' => 404
        ];
         return response()->json($data, 404);
    }


    $participant = Participant::create([


        'dni' => $request->dni,
        'name_and_last_name' => $request->name_and_last_name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,


    ]);
    
    if (!$participant) {
        $data =[
            'message' => 'error al crear el  participante',
            'status' => 500
        ];
         return response()->json($data, 500);
    
    }
        $data =[
            'participant' => $participant,
            'status' => 201
        ];
        return response()->json($data, 201);


        }






public function show($id){
        $participant = Participant::find($id);

        if (!$participant) {
            $data = [
                'message' => 'Participante no encontrado',
                'status' => 404
            ];
             return response()->json($data, 404);
        }

        $data = [
            'participant' => $participant,
            'status' => 200
        ];

        return response()->json($data, 200);




        }


        public function destroy($id){

            $participant = Participant::Find($id);

            if (!$participant) {
                $data = [
                    'message' => 'Participante no encontrado',
                    'status' => 404
                ];
                 return response()->json($data, 404);
            }

            $participant ->delete();

            $data = [
                'participant' => 'participante eliminado',
                'status' => 200
            ];
    
            return response()->json($data, 200);

        }



public function update(Request $request, $id){

            $participant = Participant::Find($id);

            if (!$participant) {
                $data = [
                    'message' => 'Participante no encontrado',
                    'status' => 404
                ];
                 return response()->json($data, 404);
            }


            $validator = Validator::make($request->all(),[
                'dni' => 'required',
                'name_and_last_name' => 'required|max:255',
                'email' => 'required|email|unique:participant',
                'phone_number' => 'required',
        
        
            ]);
        
            if ($validator->fails()) {
                $data = [
                    'message' => 'datos no validos',
                    'errors' => $validator->errors(),
                    'status' => 404
                ];
                 return response()->json($data, 404);
            }

            $participant->dni =$request->dni;
            $participant->name_and_last_name = $request->name_and_last_name;
            $participant->email = $request->email;
            $participant->phone_number = $request->phone_number;

            $participant->save();


        $data = [
                'participant' => 'participante actualizado correctamente',
                'status' => 200
            ];
    
            return response()->json($data, 200);


        }



public function updatePartials(Request $request, $id){

    $participant = Participant::find($id);

    $validator = Validator::make($request->all(),[
        'dni' => 'numeric',
        'name_and_last_name' => 'max:255',
        'email' => 'email|unique:participant',
        'phone_number' => 'numeric',


    ]);
    if ($validator->fails()) {
        $data = [
            'message' => 'datos no validos',
            'errors' => $validator->errors(),
            'status' => 404
        ];
        return response()->json($data, 404);
    }


    if ($request->has('dni')) {

        $participant->dni = $request->dni;

    }

    if ($request->has('name_and_last_name')) {

        $participant->name_and_last_name = $request->name_and_last_name;
        
    }

    if ($request->has('emil')) {

        $participant->emil = $request->emil;
        
    }

    if ($request->has('phone_number')) {

        $participant->phone_number = $request->phone_number;
        
    }


    $participant -> save();

    $data = [

        'message' => ' perticipante actualizado',
        'participant' => $participant,
        'status' => 200,


    ];

    return response()->json($data, 200);

}


}