<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Book;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBook = Book::count();
        $totalCustomer = Customer::count();
        $totalUser = User::count();
        return view('backend.content.dashboard', compact('totalBook','totalCustomer','totalUser'));
    }

    public function profile()
    {
        $id = Auth::guard('user')->user()->id;
        $user = User::findOrFail($id);
        return view('backend.content.profile',compact('user'));
    }

    public function resetPassword()
    {
        return view('backend.content.resetPassword');
    }

    public function prosesResetPassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'c_new_password' => 'required_with:new_password|same:new_password|min:6',
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $id = Auth::guard('user')->user()->id;
        $user = User::findOrFail($id);

        if (Hash::check($old_password, $user->password)) {
            $user->password = bcrypt($new_password);

            try {
                $user->save();
                return redirect(route('dashboard.resetPassword'))->with('pesan', ['success', 'Selamat anda berhasil mengubah password, Silakan logout!']);
            } catch (\Exception $e) {
                return redirect(route('dashboard.resetPassword'))->with('pesan', ['danger','Maaf anda gagal mengubah password']);
            }
        } else {
            return redirect(route('dashboard.resetPassword'))->with('pesan', ['danger','Maaf password lama yang anda masukan salah']);
        }
    }
}
