<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    private function getRules()
    {
        return [
            'name' => 'required|min:2|max:100'
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

        $department = new Department($request->toArray());
        $department->save();

        return response()->json(array('Result' => 'Good'));
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return JsonResponse
     */
    public function show(Department $department)
    {
        $workers = $department->workers()->get(['worker.id', 'worker.surname', 'worker.name',
            'worker.patronymic', 'worker.salary'])->toArray();

        $info_array = array('Info' => array($department));
        $workers_array = array('Workers' => $workers);

        return response()->json(array_merge($info_array, $workers_array));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return JsonResponse
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return JsonResponse
     */
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
