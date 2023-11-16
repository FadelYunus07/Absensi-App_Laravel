<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use App\Models\Master_kelas;
use App\Models\Member_kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMember_kelasRequest;
use App\Http\Requests\UpdateMember_kelasRequest;

class MemberKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $members = Member_kelas::where('master_id', $id)->with('master', 'siswa')->paginate(5);
        $siswas = Siswa::all();
        $masters = Master_kelas::all();
        $mstr = Master_kelas::find($id);
        // dd($mstr);
        return view('admin.memberkls', compact('members','siswas','masters','mstr'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'master_id' => 'required',
            // 'thn_ajaran' => 'required',
        ]);

        Member_kelas::create([
            'master_id' => $request->master_id,
            'siswa_id' => $request->siswa_id,
            // 'thn_ajaran' => $request->thn_ajaran,
        ]);

        return redirect()->back()->with('success', 'Data member_kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member_kelas  $member_kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Member_kelas $member_kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member_kelas  $member_kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Member_kelas $member_kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMember_kelasRequest  $request
     * @param  \App\Models\Member_kelas  $member_kelas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMember_kelasRequest $request, Member_kelas $member_kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member_kelas  $member_kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member_kelas::all()->find($id);
        $member->delete();
        return redirect()->back()->with('success', 'Data member_kelas berhasil ditambahkan.');
    }
}
