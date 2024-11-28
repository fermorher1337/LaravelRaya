<?php

namespace App\Http\Controllers;

use App\Models\Resultado;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    public function inicio()
    {
        
        return view('juego.inicio');
    }

    public function mostrarHistorial()
    {
    
        $resultados = Resultado::orderBy('fecha', 'desc')->get();
    
        return view('juego.historial', compact('resultados'));
    }
    public function guardarResultado(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

       
        $resultado = Resultado::create([
            'ganador' => $request->nombre,
            'fecha' => now(),
        ]);

        
        return response()->json(['message' => 'Resultado guardado con éxito.']);
    }
    
    public function compruebaGanador($tablero)
    {
      
        if ($this->verificarHorizontal($tablero) || $this->verificarVertical($tablero) || $this->verificarDiagonal($tablero)) {
            return true;
        }
        
        return false;
    }

    private function verificarHorizontal($tablero)
    {
        
        return false;
    }

    private function verificarVertical($tablero)
    {
        
        return false;
    }

    private function verificarDiagonal($tablero)
    {
    
        return false;
    }
}