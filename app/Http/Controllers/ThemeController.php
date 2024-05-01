<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function setTheme(Request $request): JsonResponse
    {
        $theme = $request->input('theme');
        $request->session()->put('theme', $theme);

        return response()->json(['message' => 'Theme preference saved.']);
    }

    public function getTheme(Request $request): JsonResponse
    {
        $theme = $request->session()->get('theme', 'light');

        return response()->json(['theme' => $theme]);
    }

}
