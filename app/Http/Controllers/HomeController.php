<?php

namespace App\Http\Controllers;
use App\User;
use App\Game;
use Carbon\Carbon;
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
     * @return \Illuminate\Http\Response
     */
    public function player()
    {

        $users = User::whitcount('games')->orderBy('games_count', 'desc')->take(10)->get();

    //    dd($product);


        return view('player')->with([

            'users' => $users,

        ]);
    }

      public function player($date1,$date2,$name)
    {

    
        $from = date($date1);
        $to = date($date2);

            $users =        User::whereBetween('fechaRegistro', [$from, $to])->where('name', 'LIKE', $name.'%')->count();

            
            $total= User::all()->count();
            $porcentaje=$users*100/$total;

            return view('porcentaje')->with([

            'porcentaje' => $porcentaje,

        ]);
    }


     public function points($disfraz)
    {

    


            $users =        User::select('users.*')->where('idDisfraz', $disfraz)->join('games','user.id','=','game.idJugador')->groupBy('user.id')->orderByRaw('SUM(game.puntos) DESC')->take(10)->get();



              return view('points')->with([

            'users' => $users,

        ]);
    }


    public function time()
    {

    


            $users =        User::select('users.*')->join('games','user.id','=','game.idJugador')->groupBy('user.id')->avg(Carbon::parse('game.fechaInicio')->diffInMinutes(Carbon::parse('fechaFin')))->get();



              return view('time')->with([

            'users' => $users,

        ]);
    }


}
