 <?php

namespace App\Http\Controllers\Caja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistorialController extends Controller
{
    public function index(){
    	return view('Caja.Historial.index');
    }
}
