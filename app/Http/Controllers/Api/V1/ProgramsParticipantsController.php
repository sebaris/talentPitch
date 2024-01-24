<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProgramsParticipants as V1ProgramsParticipants;
use App\Models\ProgramsParticipants;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProgramsParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $page = $request->query('page');
        $items = $request->query('items') ?? 10;
        $programs_participants = ProgramsParticipants::paginate($items, ['*'], 'page', $page);
        return V1ProgramsParticipants::collection($programs_participants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        try {
            if (ProgramsParticipants::validateEntities($request)) {
                $data = ProgramsParticipants::create($request->all());
                return new V1ProgramsParticipants($data);
            } else {
                throw new Exception('Data no saved!', 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(int $id)
    {
        try {
            $challenge = ProgramsParticipants::find($id);
            return new V1ProgramsParticipants($challenge);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Challenge not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
    {
        try {
            $challenge = ProgramsParticipants::find($id);
            if ($challenge && ProgramsParticipants::validateEntities($request)) {
                $challenge->update($request->all());
                return new V1ProgramsParticipants($challenge);
            }
        } catch (\Throwable $th) {
        }

        return response()->json([
            'message' => 'Not update challenge'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            $challenge = ProgramsParticipants::find($id);
            if (isset($challenge) && $challenge->delete()) {
                return response()->json([
                    'message' => 'Deleted successfully'
                ], 200);
            }
        } catch (\Throwable $th) {
        }

        return response()->json([
            'message' => 'Not found'
        ]);
    }
}
