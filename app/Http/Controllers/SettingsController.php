<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function toggleFeature(Request $request)
    {
        $request->validate([
            'feature_enabled' => 'required|boolean',
        ]);

        // Get or create the settings record
        $setting = Setting::firstOrCreate([], ['feature_enabled' => false]);
        $setting->feature_enabled = $request->feature_enabled;
        $setting->save();

        return response()->json(['data' => $setting]);
    }
    public function getSettings() {
        $setting = Setting::firstOrCreate([], ['feature_enabled' => false]);
        return response()->json($setting);
    }
}
