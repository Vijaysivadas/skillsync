<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function dashboard(){
        $user = User::where('id','=',auth()->user()->id)->first();

        return view('user.dashboard', ['user' => $user]);
    }

    function profileSetup(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf|max:2048', // Ensures the file is a PDF and limits size to 2MB
            'category' => 'required',
        ]);

        if ($request->hasFile('resume') && $request->file('resume')->isValid()) {
            $pdfPath = $request->file('resume')->store('resume', 'public');

            $user = User::where('id','=',auth()->user()->id)->first();

            if ($user) {
                $user->resume = $pdfPath;
                $user->categories = $request->input('category');
                $user->save();

                return back()->with('success', 'PDF uploaded successfully!');
            } else {
                return back()->withErrors(['user' => 'User not found.']);
            }
        }

        return back()->withErrors(['resume' => 'Failed to upload PDF.']);
    }
}
