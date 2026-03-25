<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Show Register Form
    public function showRegister()
    {
        return view("auth.registation");
    }

    // Register User
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Registered Successfully!');
    }

    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login User
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid Credentials');
    }

    // Dashboard
    public function dashboard()
    {

        $productCount = Product::count();

        $productsSold = Order::sum('quantity');

        $totalOrders = Order::count();

        $totalRevenue = Order::whereIn('status', ['confirmed', 'shipped', 'delivered'])
            ->sum('total_price');

        $pendingOrders = Order::where('status', 'pending')->count();

        $latestOrders = Order::latest()->take(10)->get();

        $recentProducts = Product::latest()->take(5)->get();

        // Monthly Sales (simple version)
        $monthlySales = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month');

        $startDate = Carbon::now()->subDays(6); // last 7 days

        $dailyRevenue = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->whereIn('status', ['confirmed', 'shipped', 'delivered'])
            ->whereDate('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format for chart
        $dates = [];
        $revenues = [];

        foreach ($dailyRevenue as $row) {
            $dates[] = Carbon::parse($row->date)->format('d M');
            $revenues[] = $row->total;
        }


        $categoryData = DB::table('categories')
            ->leftJoin('products', function ($join) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->where('products.status', 'published'); // only active products
            })
            ->select(
                'categories.id',
                'categories.name',
                DB::raw('COUNT(products.id) as total')
            )
            ->groupBy('categories.id', 'categories.name')
            ->get();

        $categoryLabels = $categoryData->pluck('name');
        $categoryCounts = $categoryData->pluck('total');
        return view('admin.dashboard.dashboard', compact(
            'productCount',
            'productsSold',
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'latestOrders',
            'recentProducts',
            'monthlySales',
            'dates',
            'revenues',
            'categoryLabels',
            'categoryCounts'

        ));

    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
