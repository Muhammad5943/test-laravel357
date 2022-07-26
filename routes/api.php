<?php

use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('members/group_id={group_id}', [MemberController::class, 'index'])->name('members');
Route::post('member', [MemberController::class, 'store'])->name('createMember');
Route::get('member/member_id={member_id}', [MemberController::class, 'getMemberById'])->name('showMember');
Route::get('member/group_id={group_id}', [MemberController::class, 'getMemberInGroup'])->name('memberInGroup');
Route::put('member/member_id={member_id}', [MemberController::class, 'updateMemberById'])->name('updateMember');
Route::delete('member/member_id={member_id}', [MemberController::class, 'destroy'])->name('destroyMember');