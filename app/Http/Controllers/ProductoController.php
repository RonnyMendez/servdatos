<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Listar todos los productos
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return response()->json($productos);
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        // Validar los datos que vienen en la solicitud
        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:255',
            'idcategoria' => 'required|exists:categorias,idcategoria',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'estado' => 'required|integer',
        ]);

        // Crear el producto con los datos validados
        $producto = Producto::create($validatedData);

        return response()->json($producto, 201);
    }

    // Actualizar un producto existente
    public function update(Request $request, $id)
    {
        // Validar los datos que vienen en la solicitud
        $validatedData = $request->validate([
            'descripcion' => 'required|string|max:255',
            'idcategoria' => 'required|exists:categorias,idcategoria',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'estado' => 'required|integer',
        ]);

        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);

        // Actualizar los datos del producto
        $producto->update($validatedData);

        return response()->json($producto, 200);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json(null, 204);
    }
}
