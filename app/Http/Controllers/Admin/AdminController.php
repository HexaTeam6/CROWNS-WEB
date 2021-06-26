<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsumen;
use App\Models\Pembayaran;
use App\Models\Penjahit;
use App\Models\Pesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        $total_penjahit = Penjahit::all(['id'])->count();
        $total_pembeli = Konsumen::all(['id'])->count();
        $total_transaksi = Pembayaran::all(['id'])->count();
        $pesanan_diterima = Pesanan::whereHas('pembayaran', function (Builder $query) {
                                $query->where('status_pembayaran', '=', '4');
                            })->get();
        $total_pendapatan = $pesanan_diterima->sum('biaya_total');
        $new_users = $this->getNewUserCount();
        $statistics = $this->getStatistics($pesanan_diterima);
        $my_labels = $this->getSevenDates('m/d');
        return view('dashboard', compact(['total_penjahit', 'total_pembeli', 'total_transaksi', 'total_pendapatan', 'statistics', 'my_labels', 'new_users']));
    }

    public function table() {
        $user = User::all();
        return view('accounts.index', ['users' => $user]);
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function getStatistics($pesanan_diterima) {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d').' 00:00:00';
        $today = Carbon::today()->format('Y-m-d').' 00:00:00';
        $today_subs = [
            Carbon::now()->subDays(1)->format('Y-m-d').' 00:00:00',
            Carbon::now()->subDays(2)->format('Y-m-d').' 00:00:00',
            Carbon::now()->subDays(3)->format('Y-m-d').' 00:00:00',
            Carbon::now()->subDays(4)->format('Y-m-d').' 00:00:00',
            Carbon::now()->subDays(5)->format('Y-m-d').' 00:00:00',
            Carbon::now()->subDays(6)->format('Y-m-d').' 00:00:00'
        ];
        $statistics = [
            $pesanan_diterima->whereBetween('updated_at', [$today, $tomorrow])->sum('biaya_total'),
            $pesanan_diterima->whereBetween('updated_at', [$today_subs[0], $today])->sum('biaya_total'),
        ];
        for($i=1; $i<6; $i++) {
            $statistics[$i+1] = $pesanan_diterima->whereBetween('updated_at', [$today_subs[$i], $today_subs[$i-1]])->sum('biaya_total');
        }

        return $statistics;
    }

    /* get 7 last days */
    public function getSevenDates($format) {
        $today_subs = [
            Carbon::now()->format($format),
            Carbon::now()->subDays(1)->format($format),
            Carbon::now()->subDays(2)->format($format),
            Carbon::now()->subDays(3)->format($format),
            Carbon::now()->subDays(4)->format($format),
            Carbon::now()->subDays(5)->format($format),
            Carbon::now()->subDays(6)->format($format)
        ];
        return $today_subs;
    }

    /* get new user 7 last days */
    public function getNewUserCount() {
        $users = User::where('created_at', '>', Carbon::now()->subDays(6))->get();
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $today_subs = $this->getSevenDates('Y-m-d');
        $new_users_count = [
            $users->whereBetween('created_at', [$today_subs[0], $tomorrow])->count(),
            $users->whereBetween('created_at', [$today_subs[1], $today_subs[0]])->count(),
            $users->whereBetween('created_at', [$today_subs[2], $today_subs[1]])->count(),
            $users->whereBetween('created_at', [$today_subs[3], $today_subs[2]])->count(),
            $users->whereBetween('created_at', [$today_subs[4], $today_subs[3]])->count(),
            $users->whereBetween('created_at', [$today_subs[5], $today_subs[4]])->count(),
            $users->whereBetween('created_at', [$today_subs[6], $today_subs[5]])->count()
        ];
        return $new_users_count;
    }
}
