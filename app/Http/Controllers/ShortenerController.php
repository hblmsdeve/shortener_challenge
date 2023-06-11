<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use App\Models\Shortener;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreShortenerRequest;
use App\Http\Requests\UpdateShortenerRequest;

class ShortenerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $urls = Shortener::where('user_id', $user_id)->latest()->get();
        return response()->json($urls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShortenerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShortenerRequest $request)
    {
        $request->validated();

        $lastRecord = Shortener::latest()->first();
        if($lastRecord){
            $id = $lastRecord->id;
        }else{
            $id = 1;
        }

        $hashids = new Hashids('', 5);
        $shortener = $hashids->encode($id+1);

        $url = Shortener::create([
            'long_url' => $request->input('long_url'),
            'short_url' => $shortener,
            'user_id' => $request->input('user_id'),
            'clicks' => 0,
        ]);

        return response()->json(['url' => $url]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shortener  $shortener
     * @return \Illuminate\Http\Response
     */
    public function show($short)
    {
        $shortener = Shortener::where('short_url', $short)->first();
        $shortener->increment('clicks');
        return redirect($shortener->long_url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shortener  $shortener
     * @return \Illuminate\Http\Response
     */
    public function edit(Shortener $shortener)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShortenerRequest  $request
     * @param  \App\Models\Shortener  $shortener
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShortenerRequest $request, Shortener $shortener)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shortener  $shortener
     * @return \Illuminate\Http\Response
     */
    public function destroy($url_id)
    {
        $shortener = Shortener::find($url_id);
        $shortener->delete();
        return response()->json('delete');
    }
}
