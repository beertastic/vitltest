<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Vusers extends Model
{
    protected $guarded = [];

    /**
     * Look up users
     *
     * look up DB for users based on search term. Account for de-duping if required
     *
     * @param string $term, string $dupes
     * @return DB Results Object
     */
    public static function getVusers($term, $dupes) {

        $query = self::select('name_last','name_first')
            ->where('name_last', $term)
            ->orderBy('name_first');

        if ($dupes == 'true') {
            return $query->groupBy('name_last')
                        ->groupBy('name_first');
        }

        return $query->get();
    }

}
