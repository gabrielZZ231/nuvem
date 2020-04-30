<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Container;
use Illuminate\Support\Facades\Auth;
use App\Models\InstanciaContainer;

class ContainersController extends Controller
{
    public function instanceIndex()
    {
        $containers =  InstanciaContainer::where('user_id', Auth::user()->id)->get();
        return view('pages/my-containers/my_containers', ['mycontainers' => $containers]);
    }

    public function index()
    {
        $data = ['containers' => Container::all(),
                 'isAdmin' => Auth::user()->isAdmin(),
                 'user_id' => Auth::user()->id
        ];

        return view('pages/containers/containers',$data);
    }

    public function create()
    {
        return view('pages/containers/containers_new');
    }

    public function store(Request $request)
    {
        $this->validar($request);
        $container = null;

        if( Auth::user()->isAdmin()){
            $container = Container::create($request->all());
        }

        return redirect()->route('containers.index')->with('success', 'Container created!!!');
    }

    public function show($id)
    {
        return view('containers.show',['container' => Container::firstWhere('id', $id)]);
    }

    public function edit($id)
    {
        return view('pages/containers/containers_edit',['container' => Container::firstWhere('id', $id)]);   
    }

    public function update(Request $request, $id)
    {
        $this->validar($request);
        if(Auth::user()->isAdmin()){
            $container = Container::firstWhere('id', $id);
            $container->update($request->all());
        }
        return redirect()->route('containers.index')->with('success', 'Container updated!!!');
    }

    public function destroy($id)
    {
        $container = Container::firstWhere('id', $id);

        $container->delete();
        return redirect()->route('containers.index')->with('success', 'Container deleted!!!');
    }

    private function validar(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required '],
            'command_pull' => ['required'],
            'command_run' => ['required'],
        ]);
    }
}
