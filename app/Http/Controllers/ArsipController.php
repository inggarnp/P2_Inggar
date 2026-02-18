<?php

namespace App\Http\Controllers;

use App\Models\DocumentLog;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $logs = DocumentLog::orderByDesc('created_at')->get();

        return view('pages.surat.arsip', compact('logs'));
    }
}