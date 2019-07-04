<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Phonebook;

class phonebookController extends Controller
{
    public function index() {
        return view('phonebook');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|max:11|min:11',
            'email' => 'required|unique:phonebooks,email,'. $request->id
        ]);

        $pb = new Phonebook;

        $pb->name = $request->name;
        $pb->phone = $request->phone;
        $pb->email = $request->email;

        $pb->save();
    }

    public function getData() {
        return Phonebook::orderby('name','ASC')->get();
    }
}
