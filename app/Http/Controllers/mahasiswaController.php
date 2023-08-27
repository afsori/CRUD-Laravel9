<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Session;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahBaris = 4;
        if(strlen($katakunci)){
            $data = mahasiswa::where('nim', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('jurusan', 'like', "%$katakunci%")
                ->paginate($jumlahBaris);
        }else{
            $data = mahasiswa::orderBy('nim', 'desc')-> paginate($jumlahBaris);
        }
        return view('mahasiswa.index')->with('listDataMahasiswa', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // menyimpan isian di inputan tetap ada saat klik button save
        // dan import use session
        Session::flash('nim', $request->nim);
        Session::flash('nama', $request->nama);
        Session::flash('jurusan', $request->jurusan);
        // validation form
        $request->validate([
            'nim'=> 'required|numeric|unique:mahasiswa,nim',
            'nama'=> 'required',
            'jurusan'=> 'required',
        ], 
        [
            'nim.required' => 'NIM tidak boleh kosong',
            'nim.numeric' => 'NIM harus berupa numeric',
            'nim.unique' => 'NIM sudah ada di database',
            'nama.required' => 'Nama tidak boleh kosong',
            'jurusan.required' => 'Jurusan tidak boleh kosong',
        ]);

        // declare column in table mahasiswa
        $data = [
            'nim' => $request -> nim, //nim get from name in input html
            'nama' => $request -> nama, //nama get from name in input html
            'jurusan' => $request -> jurusan //jurusan get from name in input html
        ];
        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // cara console.log ketik ini 'HI'. $id;
        // return 'HI'. $id;

        $data = mahasiswa::where('nim', $id)->first();
        return view('mahasiswa.edit')->with('dataEdit', $data);
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
        // validation form
        $request->validate([
            'nama'=> 'required',
            'jurusan'=> 'required',
        ], 
        [
            'nama.required' => 'Nama tidak boleh kosong',
            'jurusan.required' => 'Jurusan tidak boleh kosong',
        ]);

        // declare column in table mahasiswa
        $data = [
            'nama' => $request -> nama, //nama get from name in input html
            'jurusan' => $request -> jurusan //jurusan get from name in input html
        ];
        mahasiswa::where('nim', $id)->update($data);
        return redirect()->to('mahasiswa')->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('success', 'Berhasil menghapus data');
    }
}
