<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Type;
use Carbon\Carbon;

class StatsController extends Controller {

    public function getJSONStatsData() {
        /*
         *   Wykres 1 - Wydatki z podziałem na użytkowników
         */
        $data = Budget::selectRaw("sum(value) as sum, user_id")
            ->where("type_id", Type::EXPENDITURE)
            ->with(["user" => function($query) {
                $query->select("id", "name");
            }])
            ->groupBy("user_id")
            ->get();

        $js_data[0] = [
            "title" => trans("general.expenditures_by_users"),
            "div_id" => "#stat",
            "js_chart_data" => []
        ];

        foreach($data as $record) {
            $js_data[0]["js_chart_data"] += array_merge($js_data[0]["js_chart_data"], [[$record->user->name, (float)$record->sum]]);
        }

        /*
         *   Wykres 2 - Wydatki z podziałem na źródła
         */
        $data2 = Budget::selectRaw("sum(value) as sum, source_id")
            ->where("type_id", Type::EXPENDITURE)
            ->with(["source" => function($query) {
                $query->select("id", "name");
            }])
            ->groupBy("source_id")
            ->get();

        $js_data[1] = [
            "title" => trans("general.expenditures_by_sources"),
            "div_id" => "#stat-2",
            "js_chart_data" => []
        ];

        foreach($data2 as $record) {
            $js_data[1]["js_chart_data"] += array_merge($js_data[1]["js_chart_data"], [[$record->source->name, (float)$record->sum]]);
        }

        /*
         *   Wykres 3 - Wykres podsumowujący oszczędności
         */
        $data3 = Budget::selectRaw("sum(value) as sum, type_id")
            ->with(["type" => function($query) {
                $query->select("id", "name");
            }])
            ->where("date", ">=", Carbon::now()->startOfMonth())
            ->groupBy("type_id")
            ->get();

        $js_data[2] = [
            "title" => trans("general.savings_current_month"),
            "div_id" => "#stat-3",
            "js_chart_data" => []
        ];

        if(isset($data3[0]) && isset($data3[1])) {
            $js_data[2]["js_chart_data"] += array_merge($js_data[2]["js_chart_data"], [[trans("general.savings"), (float)($data3[0]->sum - $data3[1]->sum)]]);

            $js_data[2]["js_chart_data"] += array_merge($js_data[2]["js_chart_data"], [[trans("general.Expenditures"), (float)$data3[1]->sum]]);
        } elseif(isset($data3[0])) {
            $js_data[2]["js_chart_data"] += array_merge($js_data[2]["js_chart_data"], [[trans("general.savings"), (float)$data3[0]->sum]]);
        }

        /*
         *   Wykres 4 - Przychody z podziałem na źródła
         */
        $data4 = Budget::selectRaw("sum(value) as sum, source_id")
            ->where("type_id", Type::INCOME)
            ->with(["source" => function($query) {
                $query->select("id", "name");
            }])
            ->groupBy("source_id")
            ->get();

        $js_data[3] = [
            "title" => trans("general.incomes_by_sources"),
            "div_id" => "#stat-4",
            "js_chart_data" => []
        ];

        foreach($data4 as $record) {
            $js_data[3]["js_chart_data"] += array_merge($js_data[3]["js_chart_data"], [[$record->source->name, (float)$record->sum]]);
        }

        return response()->json($js_data);
    }

    public function index() {
        // Nie wchodź, jeśli nie ma żadnych przychodów/wydatków w budżecie
        $count_expenditures = Budget::count("id");

        if($count_expenditures === 0) {
            return Controller::returnBack([
                "message" => trans("general.no_budget_records"),
                "alert-class" => "alert-info"
            ]);
        }

        $title = trans("general.statistics");

        $no_data_message = trans("general.stats_no_data");

        return view("stats", ["title" => $title, "no_data_message" => $no_data_message]);
    }

    public function getJSON() {
        /*
         *   Wykres 1 - Wydatki z podziałem na użytkowników
         */
        $data = Budget::selectRaw("sum(value) as sum, user_id")
            ->where("type_id", Type::EXPENDITURE)
            ->with(["user" => function($query) {
                $query->select("id", "name");
            }])
            ->groupBy("user_id")
            ->get();

        $js_data[0] = [
            "title" => trans("general.expenditures_by_users"),
            "div_id" => "#stat",
            "js_chart_data" => []
        ];

        foreach($data as $record) {
            $js_data[0]["js_chart_data"] += array_merge($js_data[0]["js_chart_data"], [[$record->user->name, (float)$record->sum]]);
        }

        /*
         *   Wykres 2 - Wydatki z podziałem na źródła
         */
        $data2 = Budget::selectRaw("sum(value) as sum, source_id")
            ->where("type_id", Type::EXPENDITURE)
            ->with(["source" => function($query) {
                $query->select("id", "name");
            }])
            ->groupBy("source_id")
            ->get();

        $js_data[1] = [
            "title" => trans("general.expenditures_by_sources"),
            "div_id" => "#stat-2",
            "js_chart_data" => []
        ];

        foreach($data2 as $record) {
            $js_data[1]["js_chart_data"] += array_merge($js_data[1]["js_chart_data"], [[$record->source->name, (float)$record->sum]]);
        }

        return response()->json($js_data);


        //return response()->json(["result" => getJSONStatsData()]);
    }
}
