<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Read all: mengambil semua data author.
     * GET /api/authors
     */
    public function index(): JsonResponse
    {
        $authors = Author::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar data author',
            'data'    => $authors,
        ], 200);
    }

    /**
     * Create: menyimpan data author baru.
     * POST /api/authors
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|unique:authors,email',
            'bio'   => 'nullable|string',
        ]);

        $author = Author::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Author berhasil dibuat',
            'data'    => $author,
        ], 201);
    }
}
