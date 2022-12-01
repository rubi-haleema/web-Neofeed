<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NeoController extends Controller
{

    public function getneobydate()
    {
        return view('select_date');
    }
    public function getapidata(Request $request)
    {
        $fromdate = $request->fromDate;
        $todate = $request->toDate;
        $request->validate([
            'fromDate' => 'required',
            'toDate' => 'required',
        ]);
        $url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=$fromdate&end_date=$todate&api_key=dWsJ86d0uFn8oUgJlhNUkFUeB6ZaUxVhNJuquAp7";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $neo_api_data = json_decode($output, true);
        $neo_data_by_date = [];
        $neo_by_array = [];
        $E = [];
        $neo_velocity_kmph = [];
        $neo_distance_km = [];
        $neo_diameter_km = [];
        $neo_count_by_date = [];
        foreach ($neo_api_data['near_earth_objects'] as $key => $value) {
            $neo_data_by_date[$key] = $value;
            foreach ($neo_data_by_date[$key] as $data_by_date) {
                $neo_by_array[] = $data_by_date;

            }
        }

        foreach ($neo_by_array as $neo) {
            $E[] = $neo;

            foreach ($neo['estimated_diameter'] as $estemetd_diameterkey => $value) {
                if ($estemetd_diameterkey == 'kilometers') {
                    $neo_diameter_km[] = $value;
                }
            }
            foreach ($neo['close_approach_data'] as $specification) {
                foreach ($specification['relative_velocity'] as $relative_velocitykey => $value) {
                    if ($relative_velocitykey == 'kilometers_per_hour') {
                        $neo_velocity_kmph[] = $value;
                    }
                }
                foreach ($specification['miss_distance'] as $miss_distancekey => $value) {
                    if ($miss_distancekey == 'kilometers') {
                        $neo_distance_km[] = $value;
                    }
                }
            }
        }

        $neo_data_by_date_arrkeys = array_keys($neo_data_by_date);

        foreach ($neo_data_by_date_arrkeys as $key => $value) {
            $neo_count_by_date[$value] = count($neo_data_by_date[$value]);
        }
        arsort($neo_velocity_kmph);
        echo "Fastest Asteroid Id & Speed(in KM/Hour)" . "<br>";
        $fastestAseroid = Arr::first($neo_velocity_kmph);
        $fastestAseroidkey = array_key_first($neo_velocity_kmph);
        $fastestAseroidId = $neo_by_array[$fastestAseroidkey]['id'];
        echo $fastestAseroidId . "=" . $fastestAseroid;
        echo "<br>";
        echo "Closest Asteroid Id & Distance(in KM)" . "<br>";
        asort($neo_distance_km);
        $closestAseroid = Arr::first($neo_distance_km);
        $closestAseroidkey = array_key_first($neo_velocity_kmph);
        $closestAseroidId = $neo_by_array[$closestAseroidkey]['id'];
        echo $closestAseroidId . "=" . $closestAseroid;

        $neo_count_by_date_arry_keys = array_keys($neo_count_by_date);
        $neo_count_by_date_arry_values = array_values($neo_count_by_date);
        return view('details', compact('neo_count_by_date_arry_keys', 'neo_count_by_date_arry_values'));
    }
}
