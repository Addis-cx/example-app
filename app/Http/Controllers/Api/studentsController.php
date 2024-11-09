<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Models\Student;
use App\Models\Teacher;
use Exception;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\throwException;

class studentsController extends Controller
{
    public function index()
    {
        $students = Student::all();

        $data = [
            'students' => $students,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
    public function store(StoreStudentRequest $request)
    {
        try {
            $teacher = Teacher::find($request->teacher_id);
            if ($teacher->language !== $request->language) {
                throw new Exception('El lenguaje del profe y el estudiante no coinciden');
            }
            $students = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'language' => $request->language,
                'teacher_id' => $request->teacher_id
            ]);

            if (!$students) {
                throw new Exception('Error al crear el estudiante');
            }

            $data = [
                'students' => $students,
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
            $students = Student::find($id);
            if (!$students) {
                throw new Exception('Estudiante no encontrado');
            }
            $data = [
                'students' => $students,
                'status' => 200
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
    public function destroy($id)
    {
        try {
            $students = Student::find($id);
            if (!$students) {
                throw new Exception('Estudiante no encontrado');
            }
            $students->delete();
            $data = [
                'students' => $students,
                'status' => 200
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
    public function update(UpdateStudentRequest $request, $id)
    {
        try {
            $teacher = Teacher::find($request->teacher_id);
            if ($teacher->language !== $request->language) {
                throw new Exception('El lenguaje del profe y el estudiante no coinciden');
            }
            $students = Student::find($id);
            if (!$students) {
                throw new Exception('Estudiante no encontrado');
            }
            $students->name = $request->name;
            $students->email = $request->email;
            $students->phone = $request->phone;
            $students->language = $request->language;
            $students->teacher_id = $request->teacher_id;
    
            $students->save();
            $data = [
                'students' => $students,
                'status' => 200
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    public function updatePartial(UpdateStudentRequest $request, $id)
    {
        try {
            $teacher = Teacher::find($request->teacher_id);
            if ($teacher->language !== $request->language) {
                throw new Exception('El lenguaje del profe y el estudiante no coinciden');
            }
            $students = Student::find($id);
            if (!$students) {
                throw new Exception('Estudiante no encontrado');
            }
            if ($request->has('name')) {
                $students->name = $request->name;
            }
            if ($request->has('email')) {
                $students->email = $request->email;
            }
            if ($request->has('phone')) {
                $students->phone = $request->phone;
            }
            if ($request->has('language')) {
                $students->language = $request->language;
            }
    
            $students->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
