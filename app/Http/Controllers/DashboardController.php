<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $users = User::count();
        $todayUsers = User::query()->where('created_at', '>=', Carbon::today()->startOfDay())->count();

        $newUsers = null;
        if ($users > 0 && $todayUsers > 0) {
            $newUsers = ceil($todayUsers / $users * 100);
        }

        $orders = Order::count();
        $todayOrders = Order::query()->where('created_at', '>=', Carbon::today()->startOfDay())->count();
        $newOrders = null;

        if ($orders > 0 && $newOrders > 0) {
            $newOrders = ceil($todayOrders / $orders * 100);
        }

        $data = [
            'users' => $users,
            'new_users' => $newUsers,
            'orders' => $orders,
            'new_orders' => $newOrders,
        ];

        return view('pages.dashboard', $data);
    }


}
