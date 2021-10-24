<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    private function getRules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z]+$/u|min:2|max:100', //For only letters
            'surname' => 'required|regex:/^[a-zA-Z]+$/u|min:2|max:100',
            'patronymic' => 'required|regex:/^[a-zA-Z]+$/u|min:2|max:100',
            'gender' => 'required|boolean',
            'salary' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/' //For only 2 digits after decimal point
        ];
    }

    private function getJsonData(Worker $worker)
    {
        $departments = $worker->departments()->get(['department.id', 'department.name'])->toArray();

        return array_merge(['Info' => $worker], array('Departments' => $departments));
    }

    public function index()
    {
        $json_result = [];

        foreach (Worker::all() as $worker){
            $json_result[] = $this->getJsonData($worker);
        }

        return response()->json($json_result);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getRules());

        if ($validator->fails()) {
            return response()->json(array_merge(['Result' => 'Error'], array('Errors' => $validator->errors()->all())));
        }

        $worker = new Worker($request->toArray());
        $worker->save();

        return response()->json(array('Result' => 'Good'));
    }

    public function show(Worker $worker)
    {
        return response()->json($this->getJsonData($worker));
    }

    public function update(Request $request, Worker $worker)
    {
        $validator = Validator::make($request->all(), $this->getRules());

        if ($validator->fails()) {
            return response()->json(array_merge(['Result' => 'Error'], array('Errors' => $validator->errors()->all())));
        }

        //Validation for existing departments
        foreach ($request['departments'] as $department_id) {
            if (!Department::all()->has($department_id)) {
                return response()->json(array_merge(['Result' => 'Error'],
                    array('Errors' => "Department id = $department_id not found")));
            }
        }

        //If all validations pass
        //Delete old departments
        $worker->departments()->distinct()->detach();

        //Add new departments
        foreach ($request['departments'] as $department_id) {
            $worker->departments()->attach($department_id);
        }

        //Save worker info
        $worker->name = $request['name'];
        $worker->surname = $request['surname'];
        $worker->patronymic = $request['patronymic'];
        $worker->gender = $request['gender'];
        $worker->salary = $request['salary'];

        $worker->save();

        return response()->json(array('Result' => 'Good'));
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();
        return response()->json(array('Result' => 'Good'));
    }
}
