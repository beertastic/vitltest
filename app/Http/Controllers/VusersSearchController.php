<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Vusers;
use App\Http\Models\Vhistory;

class VusersSearchController extends Controller
{
    /**
     * Load the 'form'
     *
     * Simply load the form view file
     *
     * @param NA
     * @return view
     */
    public function index()
    {
        return view('search');
    }

    /**
     * Initial function called via the web.php routes file
     *
     * Extract required post data (Could have used GET for ease of copy paste URLS?)
     *
     * @param Request $request
     * @return json string (via another function)
     */
    public function fetchUserData (Request $request)
    {
        $term = $request->input('terms');
        $dupes = $request->input('dupes');

        if (($term == null) || ($term == '')) {
            $return = ['error' => 'No search term was provided'];
            return $this->returnJsonResults($return);
        }

        try {
            $return['results'] = $this->runSearch($term, $dupes);
        } catch (Exception $e) {
            report($e);
            $return = ['error' => 'An error occurred'];
            return $this->returnJsonResults($return);
        }
        return $this->returnJsonResults($return);


    }

    /**
     * Look up data via Model
     *
     * Send search requirements to Model. Log a transaction in the histories table.
     *
     * @param string $term, string $dupes
     * @return Object
     */
    private function runSearch($term, $dupes)
    {
        $results = Vusers::getVusers($term, $dupes);

        // Save search in history table for future use/housekeeping
        $history = new Vhistory;
        $history->terms = $term;
        $history->dupes = ($dupes == 'true' ? 1 : 0);
        $history->count = count($results);
        $history->save();

        return $results;
    }

    /**
     * format data to be Ajax compatible
     *
     * Take data provided from Class/DB and format to required json structure for front end.
     *
     * @param array $getData
     * @return string (in form of json) ECHO, not return.
     */
    private function returnJsonResults($getData = [])
    {
        $returnArray = ['results'   => 0,
                        'error'     => null,
        ];

        if (isset($getData['error']))
        {
            $returnArray['error'] = $getData['error'];
        }

        if (isset($getData['results']))
        {
            $returnArray['results'] = $getData['results'];
        }

        echo json_encode($returnArray);

    }
}
