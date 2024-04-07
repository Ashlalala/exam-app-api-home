<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQAGroupRequest;
use App\Http\Requests\UpdateQAGroupRequest;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\QACollection;
use App\Models\QA;
use App\Models\QAGroup;

class QAGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQAGroupRequest $request)
    {
        $request->validate([
            'exam_id' => 'nullable', //change this to required
        ]);

        //add exam_id from the html link prop

        return QAGroup::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(QAGroup $qAGroup)
    {
        $qas = QA::where('type', '=', 'part')
            ->where('group_id', '=', $qAGroup->id)->get();

        return $qas;

        $output = [
            'id' => $qAGroup->id,
            'exam_id' => $qAGroup->exam_id,
            'type' => 'match',
            'qas' => []
        ];

        foreach ($qas as $qa) {
            array_push($output['qas'], $qa);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QAGroup $qAGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQAGroupRequest $request, QAGroup $qAGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QAGroup $qAGroup)
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @param int $examId
     *
     */
    public function indexWithQAs($examId)
    {
        $groupsArr = QAGroup::where('exam_id', '=', $examId)->get();

        $arr = [];

        foreach ($groupsArr as $g) {
            array_push($arr, QA::where('id', '=', $g['qa_1'])->first());
            array_push($arr, QA::where('id', '=', $g['qa_2'])->first());
            if ($g['qa_3']) array_push($arr, QA::where('id', '=', $g['qa_3'])->first());
            if ($g['qa_4']) array_push($arr, QA::where('id', '=', $g['qa_4'])->first());
            $g['qas'] = new QACollection($arr);
        }

        return new GroupCollection($groupsArr);

        // return $groupsArr;
    }
}
