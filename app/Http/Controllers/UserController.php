<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\delete;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // paginate untuk ngatur jumlah maximal di tampilkan
        $users = DB::table('users')
        ->when($request->input('name'), function($query, $name){
            return $query->where('name', 'like', '%' . $name . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('pages.users.index', compact('users'));
        // compact user itu buat jadi variable user ini bisa di panggil di view / di folder
    }

    public function create()
    {
        return view('pages.users.create');
       
    }
    public function store(Request $request)
    {

        // dd($request->all());
        // validate untuk memvalidasi jadi semua yang di validate wajib di isi
       $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
        'role' => 'required',
       ]);

       $data = ([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'phone' => $request->phone,
       ]);


       User::create($data);

       return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
      $user = User::findOrFail($id);
      return view('pages.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
      $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required',
      ]);

      $data = ([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'phone' => $request->phone,
       ]);

       if($request->password){
        $data['password'] = Hash::make($request->password);
       }
       $user->update($data);

       return redirect()->route('user.index')->with('succes', 'User update succesfully');
    }

    public function destroy(User $user)
    {
      $user->delete();

      return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
