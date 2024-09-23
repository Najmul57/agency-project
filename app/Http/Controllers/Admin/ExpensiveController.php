<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expensive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensiveController extends Controller
{
    protected $expensive;

    public function __construct(Expensive $expensive)
    {
        $this->expensive = $expensive;
    } // end constructor

    public function index()
    {
        $data = $this->expensive->latest()->get();
        return view('admin.expensive.index', compact('data'));
    } // end method index

    public function create()
    {
        return view('admin.expensive.create');
    } // end method create

    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:1,2',
            'amount' => 'required|numeric',
        ]);
        $this->expensive->create([
            'auth_id' => Auth::id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        $notification = [
            'message' => 'Expensive Insert Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.expensive')->with($notification);
    } // end method store

    public function show($id)
    {
        $data = $this->expensive->find($id);
        return view('admin.expensive.show', compact('data'));
    }

    public function edit($id)
    {
        $data = $this->expensive->find($id);
        return view('admin.expensive.edit', compact('data'));
    } // end method edit

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:1,2',
            'amount' => 'required|numeric',
        ]);

        $expensive = $this->expensive->find($id);
        if ($expensive) {
            $expensive->update([
                'auth_id' => Auth::id(),
                'title' => $request->title,
                'type' => $request->type,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            $notification = [
                'message' => 'Expensive Update Success!',
                'alert-type' => 'success',
            ];
            return redirect()->route('admin.expensive')->with($notification);
        } else {
            $notification = [
                'message' => 'Expensive not found!',
                'alert-type' => 'error',
            ];
            return redirect()->route('admin.expensive')->with($notification);
        }
    }

    public function destroy($id)
    {
        $this->expensive->find($id)->delete();
        $notification = [
            'message' => 'Expensive Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.expensive')->with($notification);
    }
}
