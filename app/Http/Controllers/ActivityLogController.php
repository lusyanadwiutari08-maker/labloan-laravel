<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Menampilkan seluruh log aktivitas sistem (khusus admin).
     */
    public function index(Request $request)
    {
        // Semua baris dimuat; cari/filter/sort/paginasi ditangani DataTables (client-side)
        $logs = ActivityLog::with('user')->latest()->get();

        // Daftar jenis aksi yang ada untuk mengisi dropdown filter
        $actions = ActivityLog::query()
            ->select('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return view('dashboard.activity_logs.index', compact('logs', 'actions'));
    }
}
