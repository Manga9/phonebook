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

    public function getData()
    {
        return Phonebook::orderBy('name', 'ASC')->get();
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

    public function update (Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|max:11|min:11',
            'email' => 'required|unique:phonebooks,email,' . $request->id
        ]);

        $pb = Phonebook::find($id);

        $pb->name = $request->name;
        $pb->phone = $request->phone;
        $pb->email = $request->email;

        $pb->save();
    }


}
