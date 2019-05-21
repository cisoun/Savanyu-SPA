<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    private const FILENAME = 'welcome';

    public function index(Request $request)
    {
        $data = (array)DB::table('welcome')->first();
        return array_merge($data, ['image' => Storage::url(self::FILENAME)]);
    }

    public function update(Request $request)
    {
        $text = $request->input('text');

        if ($request->hasFile('image'))
        {
            $request->image->storeAs('public', self::FILENAME);
        }
        else
        {
            //Storage::disk('public')->exists(self::FILENAME);
            //torage::disk('public')->delete(self::FILENAME);
        }

        DB::table('welcome')->update([
            'text' => $text,
            'updated_at' => DB::raw('date("now")')
        ]);

        return $this->index($request);
    }
}
