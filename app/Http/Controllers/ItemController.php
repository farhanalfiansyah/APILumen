<?php
namespace App\Http\Controllers;
use App\Models\Checklist;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    // list all items in given checklist
    public function getChecklist($checklistId,$itemsId)
    {
        $item = Item::with(['checklist'])
            ->where('items.checklist_id',$checklistId)
            ->get();

            return response()->json([
                'data'=>[
                    'type' => $item->type,
                    'id' => $item->id,
                    'attributes' => [
                        'description' => $item->description,
                        'is_completed' => $item->is_completed,
                        'completed_at' => $item->completed_at,
                        'due' => $item->due,
                        'urgency' => $item->urgency,
                        'updated_by' => $item->updated_by,
                        'created_by' => $item->checklist->created_by,
                        'checklist_id' =>$item->checklist_id,
                        'assignee_id' => $item->checklist->assignee_id,
                        'task_id' => $item->checklist->task_id,
                        'deleted_at' => $item->checklist->deleted_at,
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at
                    ],
                    'links' => [
                        'self' => $item->self
                    ]
                ]
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$checklistId)
    {
        $this->validate($request,[
            'description' =>'required',
            
        ]);
        $request['type'] = 'checklist';
        $request['is_completed'] = false;
        $getSelf  = Checklist::where('id',$checklistId)->get();
        $item = Item::create($request->all());
        
        
        return response()->json([
            'data'=>[
                'type' => $request->type,
                'id' => $item->id,
                'attributes' => [
                    'description' => $item->description,
                    'is_completed' => $item->is_completed,
                    'completed_at' => $item->completed_at,
                    'due' => $item->due,
                    'urgency' =>$item->urgency,
                    'updated_by' => $item->updated_by,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ],
                'links' => [
                    'self' => $getSelf->self
                ]
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}