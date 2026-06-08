<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cp_transaction;
use App\Models\Settings;
use App\Models\Wdmethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SettingsController extends Controller
{
    /**
     * Persist only the request keys that map to real columns on the table.
     * Keeps these legacy admin endpoints safe from mass-assignment surprises.
     */
    protected function updateExistingColumns(string $table, array $data): array
    {
        $columns = Schema::getColumnListing($table);

        return array_intersect_key($data, array_flip($columns));
    }

    /**
     * Update general system settings (row id = 1).
     */
    public function updatesettings(Request $request)
    {
        $data = $this->updateExistingColumns(
            'settings',
            $request->except(['_token', '_method'])
        );

        if (! empty($data)) {
            Settings::where('id', 1)->update($data);
        }

        return redirect()->back()->with('success', 'Settings saved successfully');
    }

    /**
     * Update a crypto asset. The assets table is not part of the current
     * schema, so guard against its absence instead of failing.
     */
    public function updateasset(Request $request)
    {
        if (! Schema::hasTable('assets')) {
            return redirect()->back()->with('error', 'Asset management is not available.');
        }

        $data = $this->updateExistingColumns(
            'assets',
            $request->except(['_token', '_method'])
        );

        if ($request->filled('id') && ! empty($data)) {
            \App\Models\Asset::where('id', $request->id)->update($data);
        }

        return redirect()->back()->with('success', 'Asset updated successfully');
    }

    /**
     * Update market data. No markets model/table exists in the current
     * schema, so this is a safe no-op redirect.
     */
    public function updatemarket(Request $request)
    {
        return redirect()->back()->with('error', 'Market management is not available.');
    }

    /**
     * Update the crypto payment fee record (row id = 1).
     */
    public function updatefee(Request $request)
    {
        $data = $this->updateExistingColumns(
            'cp_transactions',
            $request->except(['_token', '_method'])
        );

        if (! empty($data)) {
            Cp_transaction::where('id', 1)->update($data);
        }

        return redirect()->back()->with('success', 'Fee updated successfully');
    }

    /**
     * Delete a withdrawal method.
     */
    public function deletewdmethod($id)
    {
        Wdmethod::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Withdrawal method deleted successfully');
    }
}
