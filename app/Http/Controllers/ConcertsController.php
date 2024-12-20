<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Concerts,
    App\Models\Location,
    App\Models\Show;
class ConcertsController extends Controller
{
    public function index(): JsonResponse
    {
        $concerts = Concerts::with(['location', 'shows'])
            ->get()
            ->map(function ($concert) {
                return [
                    'id' => $concert->id,
                    'artist' => $concert->artist,
                    'location' => [
                        'id' => $concert->location->id,
                        'name' => $concert->location->name
                    ],
                    'shows' => $concert->shows->map(function ($show) {
                        return [
                            'id' => $show->id,
                            'start' => $show->start,
                            'end' => $show->end
                        ];
                    })
                ];
            });

        return response()->json([
            'concerts' => $concerts
        ]);
    }

    public function show($id): JsonResponse
    {
        try {
            $concert = Concerts::with(['location', 'shows' => function($query) {
                $query->orderBy('start', 'asc');
            }])->findOrFail($id);

            return response()->json([
                'concert' => [
                    'id' => $concert->id,
                    'artist' => $concert->artist,
                    'location' => [
                        'id' => $concert->location->id,
                        'name' => $concert->location->name
                    ],
                    'shows' => $concert->shows->map(function ($show) {
                        return [
                            'id' => $show->id,
                            'start' => $show->start,
                            'end' => $show->end
                        ];
                    })
                ]
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'A concert with this ID does not exist'
            ], Response::HTTP_NOT_FOUND);
        }
    }    
}
