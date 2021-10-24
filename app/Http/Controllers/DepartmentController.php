<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    private function getRules()
    {
        return ['name' => 'required|min:2|max:100'];
    }

    private function getJsonData(Department $department)
    {
        $workers = $department->workers()->get(['worker.id', 'worker.name', 'worker.surname'])->toArray();

        return array_merge(['Info' =>$department], array('Workers' => $workers));
    }

    public function index()
    {
        $json_result = [];

        foreach (Department::all() as $department){
            $json_result[] = $this->getJsonData($department);
        }

        return response()->json($json_result);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getRules());

        if ($validator->fails()) {
            return response()->json(array_merge(['Result' => 'Error'], array('Errors' => $validator->errors()->all())));
        }

        $department = new Department($request->toArray());
        $department->save();

        return response()->json(array('Result' => 'Good'));
    }

    public function show(Department $department)
    {
        return response()->json($this->getJsonData($department));
    }

    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), $this->getRules());

        if ($validator->fails()) {
            return response()->json(array_merge(['Result' => 'Error'], array('Errors' => $validator->errors()->all())));
        }

        $department->name = $request['name'];
        $department->save();

        return response()->json(array('Result' => 'Good'));
    }

    public function destroy(Department $department)
    {
        if ($department->workers_count > 0)
        {
            return response()->json(array_merge(['Result' =>'Error'],
                array('Errors' => array("You can't delete department with workers"))));

        }else{

            $department->delete();
            return response()->json(array('Result' => 'Good'));
        }
    }
}
