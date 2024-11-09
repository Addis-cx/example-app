<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Validator;

class teachersController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        $data = [
            'teachers' => $teachers,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(TeacherRequest $request)
    {
        try {
            $teachers = Teacher::create([
                'name' => $request->name,
                'email' => $request->email,
                'language' => $request->language
            ]);
            if (isset($teachers)) {
                throw new Exception('Error al crear al Profe');
            }
            $data = [
                'message' => $teachers,
                'status' => 201
            ];
            return response()->json($data, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $teachers = Teacher::find($id);
            if (!$teachers) {
                throw new Exception('Profe no encontrado');
            }
            $data = [
                'teacher' => $teachers,
                'status' => 200
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $teachers = Teacher::find($id);
            if (!$teachers) {
                throw new Exception('Profe no encontrado');
            }
            $data = [
                'teacher' => $teachers,
                'status' => 200
            ];
            return response()->json($data, 200);
            $teachers->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(TeacherRequest $request, $id)
    {
        try {
            $teachers = Teacher::find($id);
            if (!$teachers) {
                throw new Exception('Profe no encontrado');
            }
            $teachers->name = $request->name;
            $teachers->email = $request->email;
            $teachers->language = $request->language;

            $teachers->save();

            $data = [
                'message' => 'Profe actualizado',
                'status' => 200,
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'messge' => $e->getMessage()
            ], 404);
        }
    }

    public function updatePartial(TeacherRequest $request, $id)
    {
        try {
            $teachers = Teacher::find($id);
            if (!$teachers) {
                throw new Exception('Profe no encontrado');
            }
            if ($request->has('name')) {
            $teachers->name = $request->name;
        }
        if ($request->has('email')) {
            $teachers->email = $request->email;
        }
        if ($request->has('language')) {
            $teachers->language = $request->language;
        }

        $teachers->save();

        $data = [
            'message' => 'Estudiante actualizado',
            'student' => $teachers,
            'status' => 200
        ];
        return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'messge' => $e->getMessage()
            ], 404);
        }
    }
}
