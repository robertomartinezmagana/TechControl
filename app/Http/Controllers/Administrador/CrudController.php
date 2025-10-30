<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CrudController extends Controller
{
    private function resolveModelClass($resource)
    {
        $map = [
            'equipos' => \App\Models\Equipo::class,
            'software' => \App\Models\Software::class,
            'mantenimientos' => \App\Models\Mantenimiento::class,
            'notificaciones' => \App\Models\Notificacion::class,
            'reportes' => \App\Models\Reporte::class,
            'incidencias' => \App\Models\Incidencia::class,
        ];

        return $map[$resource] ?? abort(404, "Modelo no definido para '$resource'");
    }

    public function index($resource)
    {
        $modelClass = $this->resolveModelClass($resource);
        $items = $modelClass::all();

        return view('admin.crud.index', [
            'modelName' => ucfirst($resource),
            'routePrefix' => 'admin.' . $resource,
            'items' => $items,
        ]);
    }

    public function create($resource)
    {
        return view('admin.crud.form', [
            'modelName' => ucfirst($resource),
            'routePrefix' => 'admin.' . $resource . 's',
            'action' => 'create',
        ]);
    }

    public function store(Request $request, $resource)
    {
        $modelClass = 'App\Models\\' . ucfirst($resource);
        $modelClass::create($request->all());

        return redirect()->route('admin.' . $resource . 's.index');
    }

    public function edit($resource, $id)
    {
        $modelClass = 'App\Models\\' . ucfirst($resource);
        $item = $modelClass::findOrFail($id);

        return view('admin.crud.form', [
            'modelName' => ucfirst($resource),
            'routePrefix' => 'admin.' . $resource . 's',
            'action' => 'edit',
            'item' => $item,
        ]);
    }

    public function update(Request $request, $resource, $id)
    {
        $modelClass = 'App\Models\\' . ucfirst($resource);
        $item = $modelClass::findOrFail($id);
        $validatedData = $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'estado' => 'required|string',
        ]);
        $item->update($request->all());

        return redirect()->route('admin.' . $resource . 's.index');
    }

    public function destroy($resource, $id)
    {
        $modelClass = 'App\Models\\' . ucfirst($resource);
        $item = $modelClass::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.' . $resource . 's.index');
    }
}
