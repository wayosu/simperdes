<?php

namespace App\Http\Controllers;

use App\Models\DesaKelurahan;
use App\Models\JenisPeraturan;
use App\Models\KabupatenKota;
use App\Models\Kecamatan;
use App\Models\LogPeraturanDesa;
use App\Models\LogReviewPeraturanDesa;
use App\Models\PeraturanDesa;
use App\Models\Provinsi;
use App\Models\ReviewPeraturanDesa;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'superadmin') {
            $rpd = ReviewPeraturanDesa::count();
            $log_rpd = LogReviewPeraturanDesa::count();
            $total_rpd = $rpd + $log_rpd;
            return view('home', [
                'title' => 'Dashboard',
                'subtitle' => '',
                'active' => 'dashboard',
                'total_provinsi' => Provinsi::count(),
                'total_kabkota' => KabupatenKota::count(),
                'total_kecamatan' => Kecamatan::count(),
                'total_desakel' => DesaKelurahan::count(),
                'total_jpd' => JenisPeraturan::count(),
                'total_user' => User::count(),
                'total_pd' => PeraturanDesa::count(),
                'total_rpd' => $total_rpd,
            ]);
        } else if (auth()->user()->role == 'admin_kabkota' || auth()->user()->role == 'admin_kecamatan' || auth()->user()->role == 'mitra') {      
            $review = ReviewPeraturanDesa::where('user_id', auth()->user()->id)->count();
            $log_review = LogReviewPeraturanDesa::where('user_id', auth()->user()->id)->count();
            $total_review = $review + $log_review;

            $user = auth()->user();
            $role = $user->role;

            if ($role === 'admin_kabkota') {
                $adminField = 'admin_kabkota_id';
                $adminFieldStatus = 'status_admin_kabkota';
            } elseif ($role === 'admin_kecamatan') {
                $adminField = 'admin_kecamatan_id';
                $adminFieldStatus = 'status_admin_kecamatan';
            } elseif ($role === 'mitra') {
                $adminField = 'admin_mitra_id';
                $adminFieldStatus = 'status_admin_mitra';
            } else {
                $adminField = null; // Handle other roles or provide a default value
            }

            if ($adminField !== null) {
                $total_perdes = PeraturanDesa::where($adminField, $user->id)->count();
                $total_review_perdes_selesai = PeraturanDesa::where($adminField, $user->id)->where($adminFieldStatus, 4)->count();
            } else {
                $total_perdes = 0;
            }

            return view('home', [
                'title' => 'Dashboard',
                'subtitle' => '',
                'active' => 'dashboard',
                'total_review' => $total_review,
                'total_perdes'=> $total_perdes,
                'total_review_perdes_selesai' => $total_review_perdes_selesai,
            ]);
        } else if (auth()->user()->role == 'admin_desakel') {
            $get_perdes = PeraturanDesa::where('user_id', auth()->user()->id)->get();
            $total_perdes = $get_perdes->count(); // Count the records in the collection
            $total_perdes_selesai = $get_perdes->where('status_admin_kabkota', 4)
                ->where('status_admin_kecamatan', 4)
                ->where('status_admin_mitra', 4)
                ->count();
            $total_review_perdes = ReviewPeraturanDesa::whereIn('peraturan_desa_id', $get_perdes->pluck('id'))->count();
            $total_log_review_perdes = LogReviewPeraturanDesa::whereIn('peraturan_desa_id', $get_perdes->pluck('id'))->count();
            $total_rpd = $total_review_perdes + $total_log_review_perdes;


            return view('home', [
                'title' => 'Dashboard',
                'subtitle' => '',
                'active' => 'dashboard',
                'total_perdes'=> $total_perdes,
                'total_perdes_selesai' => $total_perdes_selesai,
                'total_review_perdes' => $total_rpd,
            ]);
        } else {
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses.');
        }
    }
}
