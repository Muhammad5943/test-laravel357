<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;
use App\Models\Member;
use Error;
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
        try {
            $getAllGroup = Group::with('members')->orderBy('created_at','desc')->paginate(10);
            if (count($getAllGroup) == 0) {
                return view('group.index');
            }

            return view('group.index', [
                'groups' => $getAllGroup
            ]);
        } catch (\Throwable $th) {
            throw new Error($th);
        }
    }

    public function create()
    {
        return view('group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        try {
            $createGroup = new Group;
            $createGroup->namagroup = $request->namagroup;
            $createGroup->kota = $request->kota;
            $createGroup->save();

            return redirect()->route('group')->with('success', 'Membuat group '.$createGroup->namagroup);
        } catch (\Throwable $th) {
            throw new Error($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($group_id)
    {
        try {
            $getGroupById = Group::where('id', $group_id)->first();
            if ($getGroupById == null) {
                return response([
                    'message' => "Group not found"
                ], 404);
            }
    
            return view('group.edit',[
                'getGroupById' => $getGroupById
            ]);
        } catch (\Throwable $th) {
            throw new Error($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMemberInGroup($group_id)
    {
        try {
            $getGroupById = Group::where('id', $group_id)->first();
            if ($getGroupById == null) {
                return response([
                    'message' => "Group not found"
                ], 404);
            }
            
            $getMemberInGroup = Member::where('group_id', $group_id)
                                    ->orderBy('created_at','desc')
                                    ->paginate(10);

            // if (count($getMemberInGroup) == 0) {
            //     return redirect()->route('group.member', [
            //         'group_id' => $group_id
            //     ])->with('delete', 'Member group '.$getGroupById->namagroup.' telah kosong');
            // }

            return view('member.index', [
                'members' => $getMemberInGroup,
                'group_id' => $group_id
            ]);
        } catch (\Throwable $th) {
            throw new Error($th);
        }
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
        try {
            $findGroupById = Group::where('id', $group_id)->first();
            if ($findGroupById == null) {
                return redirect()->route('group.member', $group_id)->with('success', 'Berhasil mengupdate group '. $findGroupById->namagroup);
            }
            
            $findGroupById->namagroup = $request->namagroup ? $request->namagroup : $findGroupById->namagroup;
            $findGroupById->kota = $request->kota ? $request->kota : $findGroupById->kota;
            $findGroupById->update();

            return redirect()->route('group')->with('success', 'Berhasil mengupdate group '. $findGroupById->namagroup);
        } catch (\Throwable $th) {
            throw new Error($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group_id)
    {
        try {
            $findGroupById = Group::where('id', $group_id)->first();
            if ($findGroupById == null) {
                return response([
                    'message' => "Group not found"
                ], 404);
            }

            $findGroupById->delete();
    
            return redirect()->route('group')->with('delete', 'Berhasil menghapus group '. $findGroupById->namagroup);
        } catch (\Throwable $th) {
            throw new Error($th);
        }
    }
}
