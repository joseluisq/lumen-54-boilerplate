<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    use RESTActions;

    /**
     * This example shows the current Lumen version.
     *
     * @return \Illuminate\Http\Response
     */
    public function version()
    {
        return $this->respond(['version' => app()->version()]);
    }

}
