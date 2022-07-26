<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Group;
use App\Models\Member;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    private $memberUpdated = "Berhasil mengupdate member";
    private $memberDeleted = "Berhasil menghapus member";
    private $memberCreated = "Berhasil memasukan member baru";
    private $memberEmpty = "Tidak ada member di group ini";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($group_id)
    {
        try {
            $getAllMember = Member::where('group_id', $group_id)
                                        ->orderBy('created_at','desc')
                                        ->get();

            if (count($getAllMember) == 0) {
                return redirect()
                        ->route('group')
                        ->with('deleted', $this->memberEmpty);
            }
    
            return view('member.index', [
                'members' => $getAllMember
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create($group_id)
    {
        return view('member.create', [
            'group_id' => $group_id
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        try {
            if ($profilePic = $request->file('profile_pic'))
            {
                $time = filter_var(microtime(true), FILTER_SANITIZE_NUMBER_INT);
                $fileName = $time . '.' . $profilePic->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/photo');
                $profilePic->move($destinationPath, $fileName);
            }

            $createMember = new Member;
            $createMember->group_id = $request->group_id;
            $createMember->nama = $request->nama;
            $createMember->email = $request->email;
            $createMember->alamat = $request->alamat;
            $createMember->hp = $request->hp;
            $createMember->profile_pic = $fileName;
            $createMember->save();

            return redirect()
                    ->route('group.member', $request->group_id)
                    ->with('success', $this->memberCreated);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMemberById($member_id)
    {
        try {
            $getMemberById = Member::where('id', $member_id)->first();
            if ($getMemberById == null) {
                return redirect()->back();
            }

            $groupMember = Group::where('id', $getMemberById->group_id)->first();
            if ($groupMember == null) {
                return redirect()->back();
            }

            return view('member.edit', [
                'member' => $getMemberById,
                'group_id' => $groupMember
            ]);
        } catch (\Throwable $th) {
            throw $th;
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
            $getMemberInGroup = Member::where('group_id', $group_id)
                                    ->orderBy('created_at','desc')
                                    ->get();
            if ($getMemberInGroup == null) {
                return redirect()->back();
            }

            return view('member.index', [
                'members' => $getMemberInGroup
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMemberById(MemberRequest $request, $member_id)
    {
        try {
            $memberById = Member::where('id', $member_id)->first();
            if ($memberById == null) {
                return redirect()->back();
            }

            if ($request->hasFile('profile_pic')) {
                $oldPhoto = $memberById->profile_pic;
                $oldImage = storage_path("app/public/images/photo/{$oldPhoto}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            if ($image = $request->file('profile_pic')) {
                $time = filter_var(microtime(true), FILTER_SANITIZE_NUMBER_INT);
                $fileName = $time . '.' . $image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/photo');
                $image->move($destinationPath, $fileName);
            }

            $memberById->group_id = $request->group_id?$request->group_id:$memberById->group_id;
            $memberById->nama = $request->nama?$request->nama:$memberById->nama;
            $memberById->email = $request->email?$request->email:$memberById->email;
            $memberById->alamat = $request->alamat?$request->alamat:$memberById->alamat;
            $memberById->hp = $request->hp?$request->hp:$memberById->hp;
            $memberById->profile_pic = $request->file('profile_pic')?$fileName:$memberById->profile_pic;
            $memberById->update();

            $memberGroup = Group::where('id', $memberById->group_id)->first();
            if ($memberGroup == null) {
                return redirect()->back();
            }

            return redirect()
                    ->route('group.member', $memberGroup->id)
                    ->with('success', $this->memberUpdated);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($member_id)
    {
        try {
            $deleteMember = Member::where('id', $member_id)->first();
            if ($deleteMember == null) {
                return response([
                    'message' => "Member not found"
                ], 404);
            }

            $deleteMember->delete();
            
            return redirect()
                ->back()
                ->with('delete', $this->memberDeleted);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
