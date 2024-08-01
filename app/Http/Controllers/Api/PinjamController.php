<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PinjamRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponses;
use App\Models\TrxPinjam;
use App\Models\MstBooks;

class PinjamController extends Controller
{
    use ApiResponses;

    public function index(): JsonResponse
    {
        //get all pinjams
        $pinjams = TrxPinjam::with(['user', 'book'])->get();

        //return collection of pinjams
        return $this->successResponse($pinjams, 200);
    }

    public function show($id): JsonResponse
    {
        //find pinjam by ID
        $pinjam = TrxPinjam::find($id);

        //return single pinjam
        return $this->successResponse($pinjam, 200);
    }

    public function store(PinjamRequest $request): JsonResponse
    {
        //create pinjam
        $pinjam = TrxPinjam::create([
            'user_id'         => $request->user_id,
            'book_id'      => $request->book_id,
            'date_pinjam'       => date('Y-m-d h:i:s', strtotime($request->date_pinjam)),
        ]);

        $book = MstBooks::find($request->book_id);
        //update stok buku
        $book->update([
            'stok'         => $book->stok - 1,
        ]);

        //return response
        return $this->successResponse($pinjam, 200);
    }

    public function update(PinjamRequest $request, $id): JsonResponse
    {
        //find pinjam by ID
        $pinjam = TrxPinjam::find($id);
        $book = MstBooks::find($request->book_id);
        
        if($pinjam->status == 'Belum Dikembalikan' && $request->status == 1){
            $book->update([
                'stok'         => $book->stok + 1,
            ]);
        }

        if($pinjam->status == 'Dikembalikan' && $request->status == 0){
            $book->update([
                'stok'         => $book->stok - 1,
            ]);
        }

        //update pinjam with new data
        $pinjam->update([
            'user_id'         => $request->user_id,
            'book_id'      => $request->book_id,
            'date_pinjam'       => date('Y-m-d h:i:s', strtotime($request->date_pinjam)),
            'date_retur'        => ($request->date_retur) ? date('Y-m-d h:i:s', strtotime($request->date_retur)) : null,
            'status'            => $request->status,
        ]);


        //return response
        return $this->successResponse($pinjam, 200);
    }

    public function destroy($id)
    {

        //find pinjam by ID
        $pinjam = TrxPinjam::find($id);

        //delete pinjam
        $pinjam->delete();

        //return response
        return $this->successResponse(null, 200);
    }

}
