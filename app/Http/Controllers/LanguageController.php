<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    
    public function change(Request $request)
    {
        $lang = $request->lang;

        if (!in_array($lang, ['en', 'de'])) {
            abort(400);
        }

        Session::put('locale', $lang);

        return redirect()->back();
    }
}
