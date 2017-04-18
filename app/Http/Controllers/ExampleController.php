<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{

    /**
     * This example shows the current Lumen version.
     *
     * @return \Response
     */
    public function version()
    {
        return response()->json([
            'version' => app()->version()
        ]);
    }

}
