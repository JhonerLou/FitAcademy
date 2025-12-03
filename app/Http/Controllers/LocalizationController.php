<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
class LocalizationController extends Controller
{
     public function switch($locale): RedirectResponse
    {
        // Validate the locale to ensure it's supported
        if (in_array($locale, ['en', 'id'])) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
