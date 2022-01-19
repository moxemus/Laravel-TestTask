<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentCollection;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    private function getRules()
    {
        return ['name' => 'required|min:2|max:100'];
    }

    public function index()
    {
        return new DepartmentCollection(Department::paginate());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getRules());

        if ($validator->fails())
            return response()->json(['result' => 'error'], ['errors' => $validator->errors()->all()]);

        $department = new Department($request->toArray());
        $department->save();

        return response()->json(['result' => 'good']);
    }

    public function show(Department $department)
    {
        return new DepartmentResource($department);
    }

    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), $this->getRules());

        if ($validator->fails())
            return response()->json(['result' => 'error'], ['errors' => $validator->errors()->all()]);

        $department->name = $request['name'];
        $department->save();

        return response()->json(['result' => 'good']);
    }

    public function destroy(Department $department)
    {
        if ($department->workers_count > 0) {
            return response()->json(['result' => 'error'], ['errors' => ["You can't delete department with workers"]]);

        } else {

            $department->delete();
            return response()->json(['result' => 'good']);
        }
    }
}
