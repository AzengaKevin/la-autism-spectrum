<?php

namespace App\Http\Controllers\Expert;

use App\Models\Screening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ScreeningController extends Controller
{
    public function __construct() {

        $this->middleware('auth:sanctum');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $screenings = $request->user()->screenings;

        return view('expert.screenings.index', compact('screenings'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function show(Screening $screening)
    {
        return view('expert.screenings.show', compact('screening'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function opinionShow(Screening $screening)
    {
        return view('expert.screenings.opinion', compact('screening'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function opinionSend(Request $request, Screening $screening)
    {
        $data = $request->validate([
            'content' => ['required', 'string']
        ]);

        Mail::to($screening->email)
            ->send(new \App\Mail\ScreeningResponse($data['content'], $screening));

        $request->session()->flash('success_message', 'Responce sent successfully');

        return redirect()->route('expert.screenings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screening  $screening
     * @return \Illuminate\Http\Response
     */
    public function destroy(Screening $screening)
    {
        $screening->delete();

        return redirect()->route('expert.screenings.index');
    }
}
