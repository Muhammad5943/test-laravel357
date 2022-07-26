<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * member
 */
Route::prefix('/member')->group(function () {
    Route::get('/group_id={group_id}', [MemberController::class, 'index'])->name('members');
    Route::post('/', [MemberController::class, 'store'])->name('createMember');
    Route::get('/member_id={member_id}', [MemberController::class, 'getMemberById'])->name('showMember');
    Route::get('/group_id={group_id}', [MemberController::class, 'getMemberInGroup'])->name('memberInGroup');
    Route::put('/member_id={member_id}', [MemberController::class, 'updateMemberById'])->name('updateMember');
    Route::delete('/member_id={member_id}', [MemberController::class, 'destroy'])->name('destroyMember');
});

/**
 * group
 */
Route::prefix('/group')->group(function () {
    Route::get('/', [GroupController::class, 'index'])->name('group');
    Route::post('/', [GroupController::class, 'store'])->name('createGroup');
    Route::get('/group_id={group_id}', [GroupController::class, 'show'])->name('showGroup');
    Route::get('/group_id={group_id}/member', [GroupController::class, 'getMemberInGroup'])->name('memberInGroup');
    Route::put('/group_id={group_id}', [GroupController::class, 'updateGroupById'])->name('updateGroup');
    Route::delete('/group_id={group_id}', [GroupController::class, 'destroy'])->name('destroyGroup');
});