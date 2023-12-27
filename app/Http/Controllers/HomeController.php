<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PharIo\Manifest\Email;

class HomeController extends Controller
{

    public function index()
    {
        $data = User::get();
        return view('index', compact('data'));
    }
    public function dashboard()
    {
        return view('dashboard');
    }
    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email'  => 'required|email',
            'nama'   => 'required',
            'password' => 'required',
            'profil' => 'required|image',
        ]);


        $profil   = $request->file('profil');
        $filename = date('Y-m-d') . $profil->getClientOriginalName();
        $path = 'profil-user';

        $res = Storage::disk('public')->putFileAs($path, $profil, $filename);


        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['password'] = Hash::make($request->password);
        $data['profil'] = Storage::url($res);

        User::create($data);

        return redirect()->route('index');
    }
    public function edit(request $request, $id)
    {
        $data = collect(User::where('id', $id)->first());
        $data['filename'] =  File::name($data['profil']) . '.' . File::extension($data['profil']);

        return view('edit', compact('data'));
    }
    public function update(request $request, $id)
    {

        $request->validate([
            'email'  => 'required|email',
            'nama'   => 'required',
            'password' => 'required',
            'profil' => 'required|image',
        ]);



        $profil   = $request->file('profil');
        $filename = date('Y-m-d') . $profil->getClientOriginalName();
        $path = 'profil-user';

        $res = Storage::disk('public')->putFileAs($path, $profil, $filename);

        $data['email'] = $request->email;
        $data['name'] = $request->nama;
        $data['profil'] = Storage::url($res);
        $data['password']  = Hash::make($request->password);

        User::whereid($id)->update($data);

        return redirect()->route('index');
    }
    public function delete(Request $request, $id)
    {
        $data = User::find($id);
        if ($data) {
            $data->delete();
        }
        return redirect()->route('index');
    }
}
