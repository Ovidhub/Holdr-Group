<?php

namespace App\Http\Controllers\Admin;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Response;

class ImportController extends Controller
{
    public function fileImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls',
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));
            return redirect()->back()->with('success', 'Leads Successfully imported!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('message', 'Unable to import file: ' . $e->getMessage());
        }
    }

    public function downloadDoc()
    {
        $download_path = public_path() . '/storage/leads.xlsx';
        if (file_exists($download_path)) {
            return Response::download($download_path);
        }

        $csvContent = "name,email,phone,country\nJohn Doe,john@example.com,+1555010999,United States\n";
        return response($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="leads.csv"',
        ]);
    }
}
