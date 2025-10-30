<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    private function resolveModelName($resource)
    {
        $names = [
            'equipos' => 'Equipo',
            'software' => 'Software',
            'mantenimientos' => 'Mantenimiento',
            'notificaciones' => 'Notificación',
            'reportes' => 'Reporte',
            'incidencias' => 'Incidencia',
        ];

        return $names[$resource] ?? ucfirst($resource);
    }

    public function index($resource, Request $request)
    {
        $modelClass = $this->resolveModelClass($resource);
        $query = $modelClass::query();

        // Filtro por búsqueda
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('marca', 'like', "%$search%")
                  ->orWhere('modelo', 'like', "%$search%")
                  ->orWhere('estado', 'like', "%$search%");
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->input('estado'));
        }

        $items = $query->paginate(10); // 10 por página

        return view('admin.crud.index', [
            'modelName' => $this->resolveModelName($resource),
            'routePrefix' => 'admin.' . $resource,
            'items' => $items,
            'search' => $request->search,
            'estado' => $request->estado,
        ]);
    }

    public function create($resource)
    {
        return view('admin.crud.form', [
            'modelName' => $this->resolveModelName($resource),
            'routePrefix' => 'admin.' . $resource,
            'action' => 'create',
        ]);
    }

    public function store(Request $request, $resource)
    {
        $modelClass = $this->resolveModelClass($resource);
        $modelClass::create($request->all());

        return redirect()->route('admin.' . $resource . '.index');
    }

    public function edit($resource, $id)
    {
        $modelClass = $this->resolveModelClass($resource);
        $item = $modelClass::findOrFail($id);

        return view('admin.crud.form', [
            'modelName' => $this->resolveModelName($resource),
            'routePrefix' => 'admin.' . $resource,
            'action' => 'edit',
            'item' => $item,
        ]);
    }

    public function update(Request $request, $resource, $id)
    {
        $modelClass = $this->resolveModelClass($resource);
        $item = $modelClass::findOrFail($id);

        $validatedData = $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'estado' => 'required|string',
        ]);

        $item->update($validatedData);

        return redirect()->route('admin.' . $resource . '.index');
    }

    public function destroy($resource, $id)
    {
        $modelClass = $this->resolveModelClass($resource);
        $item = $modelClass::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.' . $resource . '.index');
    }
}
