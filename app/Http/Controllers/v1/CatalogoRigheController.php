<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\CategoriaModel;
use App\Models\CategoriaTraduzioneModel;
use App\Models\VcategorieLocandineModel;
use Illuminate\Http\Request;

class CatalogoRigheController extends Controller
{
    public function index(Request $request)
    {
        $lingua = strval($request->query('lingua', 'it'));
        $tipo = strval($request->query('tipo', 'film_serie'));

        $limit = (int)($request->query('limit', 4));
        if ($limit < 1) $limit = 4;
        if ($limit > 20) $limit = 20;

        $offset = (int)($request->query('offset', 0));
        if ($offset < 0) $offset = 0;

        $idLingua = ($lingua === 'it') ? 1 : 2;

        $categorie = CategoriaModel::orderBy('id_categoria', 'asc')
            ->skip($offset)
            ->take($limit)
            ->get(['id_categoria', 'codice']);

        $idsCategorie = $categorie->pluck('id_categoria')->map(fn($x) => (string)$x)->all();

        $mappaNome = [];
        if (count($idsCategorie)) {
            $traduzioni = CategoriaTraduzioneModel::whereIn('id_categoria', $idsCategorie)
                ->where('id_lingua', $idLingua)
                ->get(['id_categoria', 'nome']);

            foreach ($traduzioni as $tr) {
                $mappaNome[(string)$tr->id_categoria] = (string)$tr->nome;
            }
        }

        $mappaLocandine = [];
        if (count($idsCategorie)) {
            $qLoc = VcategorieLocandineModel::whereIn('id_categoria', $idsCategorie)
                ->where('lingua', $lingua)
                ->orderBy('id_categoria')
                ->orderBy('tipo')
                ->orderBy('id_contenuto');

            if ($tipo !== 'film_serie') {
                $qLoc->where('tipo', $tipo);
            }

            $locandine = $qLoc->get(['id_categoria', 'tipo', 'id_contenuto', 'slug', 'lingua', 'sottotitolo']);

            foreach ($locandine as $r) {
                $idCat = (string)$r->id_categoria;
                if (!isset($mappaLocandine[$idCat])) $mappaLocandine[$idCat] = [];
                $mappaLocandine[$idCat][] = [
                    'src' => "assets/locandine_{$lingua}/locandina_{$lingua}_" . $r->slug . ".webp",
                    'sottotitolo' => (string)($r->sottotitolo ?? ''),
                ];
            }
        }

        $items = [];
        foreach ($categorie as $cat) {
            $idCat = (string)$cat->id_categoria;
            $nome = $mappaNome[$idCat] ?? (string)$cat->codice;

            $items[] = [
                'idCategoria' => $idCat,
                'category' => $nome,
                'locandine' => $mappaLocandine[$idCat] ?? [],
            ];
        }

        return response()->json([
            'data' => [
                'items' => $items,
            ],
        ]);
    }
}
