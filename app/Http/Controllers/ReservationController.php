<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Reservations,
    App\Models\Tickets,
    App\Models\Seats,
    App\Models\Concerts;
class ReservationController extends Controller
{
    public function store(Request $request, $concertId, $showId): JsonResponse
    {
        try {
            $validated = $request->validate([
                'reservation_token' => 'required|string',
                'name' => 'required|string',
                'address' => 'required|string',
                'city' => 'required|string',
                'zip' => 'required|string',
                'country' => 'required|string',
            ]);

            $concert = Concerts::findOrFail($concertId);
            $show = $concert->shows()->findOrFail($showId);

            $reservation = Reservations::where('token', $validated['reservation_token'])
                ->where(column: 'show_id', value: $showId)
                ->first();

            if (!$reservation) {
                return response()->json([
                    'error' => 'Unauthorized'
                ], Response::HTTP_UNAUTHORIZED);
            }

            $tickets = [];
            foreach ($reservation->seats as $seat) {
                $ticket = Tickets::create([
                    'code' => strtoupper(Str::random(10)),
                    'name' => $validated['name'],
                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'zip' => $validated['zip'],
                    'country' => $validated['country'],
                    'show_id' => $showId,
                    'row_id' => $seat->row_id,
                    'seat_number' => $seat->number,
                    'booking_id' => Str::uuid(),
                ]);

                $tickets[] = [
                    'id' => $ticket->id,
                    'code' => $ticket->code,
                    'name' => $ticket->name,
                    'created_at' => $ticket->created_at->toIso8601String(),
                    'row' => [
                        'id' => $seat->row->id,
                        'name' => $seat->row->name,
                    ],
                    'seat' => $seat->number,
                    'show' => [
                        'id' => $show->id,
                        'start' => $show->start,
                        'end' => $show->end,
                        'concert' => [
                            'id' => $concert->id,
                            'artist' => $concert->artist,
                            'location' => [
                                'id' => $concert->location->id,
                                'name' => $concert->location->name
                            ]
                        ]
                    ]
                ];
            }

            usort($tickets, function($a, $b) {
                if ($a['row']['id'] === $b['row']['id']) {
                    return $a['seat'] <=> $b['seat'];
                }
                return $a['row']['id'] <=> $b['row']['id'];
            });

            $reservation->delete();

            return response()->json([
                'tickets' => $tickets
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'fields' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'A concert or show with this ID does not exist'
            ], Response::HTTP_NOT_FOUND);
        }
    }

}
