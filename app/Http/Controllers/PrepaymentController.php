<?php

namespace App\Http\Controllers;

use App\Models\prepayment;
use Illuminate\Http\Request;
use App\Repositories\TodoInterfaceWork\PrepaymentInterface;
class PrepaymentController extends Controller
{

    private $prepay;

    public function __construct(PrepaymentInterface $prepay)
    {
        $this->prepay = $prepay;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->prepay->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\prepayment  $prepayment
     * @return \Illuminate\Http\Response
     */
    public function show(prepayment $prepayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\prepayment  $prepayment
     * @return \Illuminate\Http\Response
     */
    public function edit(prepayment $prepayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\prepayment  $prepayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, prepayment $prepayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\prepayment  $prepayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(prepayment $prepayment)
    {
        //
    }

    public function checkPrepay(Request $request)
    {
        return $this->prepay->checkPrepay($request);
    }

    public function loadPrepayment(Request $request)
    {
        return $this->prepay->loadPrepayment($request);
    }

    public function editStatus($id)
    {
        return $this->prepay->editStatus($id);
    }

    public function listAll(Request $request)
    {
        return $this->prepay->listAll($request);
    }
}
