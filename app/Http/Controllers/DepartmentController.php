<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Worker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return JsonResponse
     */
    public function show(Department $department)
    {
        $worker_departments = $department->workers()->get(['worker.id', 'worker.name', 'worker.salary'])->toArray();

        $department_array = $department->toArray();
        $department_array += ["workers_count" => count($worker_departments)];
        $department_array += ["max_salary" => max($worker_departments)['salary']];

        $department_info = array('Info' => $department_array);
        $workers = array('Workers' => $worker_departments);

        return response()->json(array_merge($department_info, $workers));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Department $department
     * @return Response
     */
    public function update(Request $request, Department $department)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return Response
     */
    public function destroy(Department $department)
    {

    }
}
