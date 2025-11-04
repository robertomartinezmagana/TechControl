<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CrudController extends Controller
{
    // Pasar la clase correcta del Modelo según su nombre
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

    // Pasar el nombre correcto del label de filter
    private function formatFilterLabel(string $field): string
    {
        $customLabels = [
            'licencia' => 'Todas las Licencias',
            'prioridad' => 'Todas las Prioridades',
            'leida' => 'Leída/No Leída'
        ];
        return $customLabels[$field] ?? 'Todos los ' . ucfirst(Str::plural(str_replace('_', ' ', $field)));
    }

    // Acciones acorde al contexto de configuración de cada modelo
    private function hydrateSelectModelFields(array $formFields): array
    {
        foreach ($formFields as $name => &$field) {
            if (($field['type'] ?? null) === 'select-model' && isset($field['model'])) {
                $relatedModel = $field['model'];
                $field['options'] = $relatedModel::all()->map(function ($item) use ($field) {
                    $label = $item->{$field['display']};
                    $subtext = $field['subtext'] ?? null;
                    if ($subtext && isset($item->$subtext)) {
                        $label .= ' (' . $item->$subtext . ')';
                    }
                    return [
                        'value' => $item->getKey(),
                        'label' => $label,
                    ];
                })->toArray();
            }
        }
        unset($field);
        return $formFields;
    }

    // Acción CRUD de vista (READ ALL)
    public function index($resource, Request $request)
    {
        $modelClass = $this->resolveModelClass($resource);
        $config = $modelClass::config();
        $query = $modelClass::query();

        // Filtros
        foreach ($config['filters'] as $field => $type) {
            if (request()->filled($field)) {
                $query->where($field, 'like', '%' . request($field) . '%');
            }
        }

        $filterLabels = collect($config['filters'])->mapWithKeys(fn($type, $field) => [
            $field => $this->formatFilterLabel($field)
        ])->toArray();

        $items = $query->paginate(10); // 10 por página

        return view('admin.crud.index', [
            'modelName' => $config['name'],
            'modelPlural' => $config['plural'],
            'routePrefix' => 'admin.' . $resource,
            'items' => $items,
            'fields' => $config['fields'],
            'filters' => $config['filters'],
            'filterLabels' => $filterLabels,
        ]);
    }

    // Acción CRUD creación (CREATE)
    public function create($resource)
    {
        $modelClass = $this->resolveModelClass($resource);
        $config = $modelClass::config();
        $formFields = $this->hydrateSelectModelFields($config['form']);

        return view('admin.crud.form', [
            'modelName' => $config['name'],
            'modelPlural' => $config['plural'],
            'routePrefix' => 'admin.' . $resource,
            'action' => 'create',
            'formFields' => $formFields,
        ]);
    }

    // Acción CRUD de guardar (posterior a guardar) (SAVE)
    public function store(Request $request, $resource)
    {
        $modelClass = $this->resolveModelClass($resource);
        $modelClass::create($request->all());

        return redirect()->route('admin.' . $resource . '.index');
    }

    // Acción CRUD de editar (EDIT)
    public function edit($resource, $id)
    {
        $modelClass = $this->resolveModelClass($resource);
        $config = $modelClass::config();
        $item = $modelClass::findOrFail($id);
        $formFields = $this->hydrateSelectModelFields($config['form']);

        return view('admin.crud.form', [
            'modelName' => $config['name'],
            'modelPlural' => $config['plural'],
            'routePrefix' => 'admin.' . $resource,
            'action' => 'edit',
            'item' => $item,
            'formFields' => $formFields,
        ]);
    }

    // Acción CRUD de guardar (posterior a editar) (EDIT)
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

    // Acción CRUD de eliminación (DELETE)
    public function destroy($resource, $id)
    {
        $modelClass = $this->resolveModelClass($resource);
        $item = $modelClass::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.' . $resource . '.index');
    }
}
