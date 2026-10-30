<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Read all: mengambil semua data genre.
     * GET /api/genres
     */
    public function index(): JsonResponse
    {
        $genres = Genre::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data genre',
            'data'    => $genres,
        ], 200);
    }

    /**
     * Create: menyimpan data genre baru.
     * POST /api/genres
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:genres,name',
            'description' => 'nullable|string',
        ]);

        $genre = Genre::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil dibuat',
            'data'    => $genre,
        ], 201);
    }
}
