<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use App\Models\SysUser;
use App\Models\MstBooks;
use App\Models\TrxPinjam;


class DashboardController extends Controller
{
    use ApiResponses;

    public function index()
    {
        try {
            $data['users'] = SysUser::where('level', 0)->count();
            $data['books'] = MstBooks::count();
            $data['pinjams'] = TrxPinjam::where('status', 0)->count();
            return $this->successResponse($data, 200);
        } catch (Exception $e) {
            return $this->errorResponse($data, 200);
        }
    }
}
