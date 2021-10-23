<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkerController extends Controller
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
     * @return Response
     */
    public function update(Request $request, Worker $worker)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Worker $worker
     * @return Response
     */
    public function destroy(Worker $worker)
    {

    }
}
