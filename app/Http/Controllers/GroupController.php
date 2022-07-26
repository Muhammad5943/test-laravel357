<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    private $groupCreated = "Berhasil membuat group baru";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // try {
            $getAllGroup = Group::orderBy('created_at','desc')->get();
            if (count($getAllGroup) == 0) {
                return response([
                    'message' => "Group not found"
                ], 404);
            }

            return apiReturn($getAllGroup);
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        // try {
            $createGroup = new Group;
            $createGroup->namagroup = $request->namagroup;
            $createGroup->kota = $request->kota;
            $createGroup->save();

            return apiCreated($createGroup, $this->groupCreated);
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($group_id)
    {
        // try {
            $getGroupById = Group::where('id', $group_id)->first();
            if ($getGroupById == null) {
                return response([
                    'message' => "Group not found"
                ], 404);
            }
    
            return $getGroupById;
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMemberInGroup($group_id)
    {
        // try {
            $getGroupById = Group::where('id', $group_id)->first();
            if ($getGroupById == null) {
                return response([
                    'message' => "Group not found"
                ], 404);
            }
            
            $getMemberInGroup = Member::where('group_id', $group_id)
                                    ->orderBy('created_at','desc')
                                    ->get();
            if (count($getMemberInGroup) == 0) {
                return response([
                    'message' => "Member not found"
                ], 404);
            }
            return $getMemberInGroup;
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGroupById(GroupRequest $request, $group_id)
    {
        // try {
            $findGroupById = Group::where('id', $group_id)->first();
            if ($findGroupById == null) {
                return response([
                    'message' => "Group not found"
                ], 404);
            }
            
            $findGroupById->namagroup = $request->namagroup ? $request->namagroup : $findGroupById->namagroup;
            $findGroupById->kota = $request->kota ? $request->kota : $findGroupById->kota;
            $findGroupById->update();

            return apiUpdated($findGroupById);
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group_id)
    {
        // try {
            $findGroupById = Group::where('id', $group_id)->first();
            if ($findGroupById == null) {
                return response([
                    'message' => "Group not found"
                ], 404);
            }

            $findGroupById->delete();
    
            return apiReturn($findGroupById);
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }
}
