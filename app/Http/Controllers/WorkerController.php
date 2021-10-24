<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\JsonResponse;
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

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
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

    /**
     * Display the specified resource.
     *
     * @param Worker $worker
     * @return JsonResponse
     */
    public function show(Worker $worker)
    {
        $departments = $worker->departments()->get(['department.id', 'department.name'])->toArray();

        $worker_info = array('Info' => $worker);
        $departments = array('Departments' => $departments);

        return response()->json(array_merge($worker_info, $departments));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Worker $worker
     * @return JsonResponse
     */
    public function update(Request $request, Worker $worker)
    {
        $validator = Validator::make($request->all(), $this->getRules());

        if ($validator->fails()) {
            return response()->json(array_merge(['Result' => 'Error'], array('Errors' => $validator->errors()->all())));
        }

        $worker->name = $request['name'];
        $worker->surname = $request['surname'];
        $worker->patronymic = $request['patronymic'];
        $worker->gender = $request['gender'];
        $worker->salary = $request['salary'];

        $worker->save();

        return response()->json(array('Result' => 'Good'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Worker $worker
     * @return JsonResponse
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return response()->json(array('Result' => 'Good'));
    }
}
