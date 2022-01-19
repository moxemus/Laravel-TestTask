<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkerCollection;
use App\Http\Resources\WorkerResource;
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

    public function index()
    {
        return new WorkerCollection(Worker::paginate());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getRules());

        if ($validator->fails())
            return response()->json(['result' => 'error'], ['errors' => $validator->errors()->all()]);

        $worker = new Worker($request->toArray());
        $worker->save();

        return response()->json(['result' => 'good']);
    }

    public function show(Worker $worker)
    {
        return new WorkerResource($worker);
    }

    public function update(Request $request, Worker $worker)
    {
        $validator = Validator::make($request->all(), $this->getRules());

        if ($validator->fails())
            return response()->json(['result' => 'error'], ['errors' => $validator->errors()->all()]);

        foreach ($request['departments'] as $department_id)
            if (!Department::all()->has($department_id))
                return response()->json(['result' => 'error'], ['errors' => "Department id = $department_id not found"]);

        $worker->departments()->distinct()->detach();

        foreach ($request['departments'] as $department_id)
            $worker->departments()->attach($department_id);

        $worker->name = $request['name'];
        $worker->surname = $request['surname'];
        $worker->patronymic = $request['patronymic'];
        $worker->gender = $request['gender'];
        $worker->salary = $request['salary'];

        $worker->save();

        return response()->json(['result' => 'good']);
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();
        return response()->json(['result' => 'good']);
    }
}
