<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function about()
    {
//        $name = 'Shulha <span style="color: red;">Dmytro</span>';
//        return view('pages.about')->with('name', $name);
        /*
                return view('pages.about')->with([
                    'first' => 'Shulha',
                    'last' => 'Dmytro'
                ]);
        */

        /*
           $data = [];
           $data['first'] = 'Douglas';
           $data['last'] = 'Quaid';

           return view('pages.about', $data);
        */

        $first = 'Fox';
        $last = 'Mulder';

        return view('pages.about', compact('first', 'last'));

    }

    public function contact()
    {
        return view('pages.contact');
    }


}
