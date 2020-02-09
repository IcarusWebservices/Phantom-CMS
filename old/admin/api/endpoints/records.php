<?php
/**
 * Endpoint for everything related to projects
 */
class Api_Endpoint_Records extends PH_Endpoint {

    public function getRecordListing($parameters) {
        if(session()->is_logged_in) {

            $project    = $parameters["project"];
            $type       = $parameters["dataType"];

            $records = PH_Query::get_record_listing_by_datatype($project, $type);

            // var_dump($records);

            $object = [];

            foreach ($records as $record) {
                $r = [
                    "id" => $record->id,
                    "title" => $record->title,
                    "content" => [
                        "parsed" => $record->parsed_content,
                        "unparsed" => $record->unparsed_content
                    ],
                    "slug" => $record->slug,
                    "created_at" => $record->created_at
                ];

                array_push($object, $r);
            }

            json_response(false, $object);

        } else {
            json_response(true, null, "auth:not_logged_in");
        }
    }

    public function updateRecord($parameters) {
        if(session()->is_logged_in) {

            if(ph_fp_set("exportData")) {

                $ed = ph_fp_get("exportData");

                $json = json_decode($ed);

                if($json) {
                    $o = new PH_JSON(null, $ed);
                } else {
                    json_response(true, null, "Parameter 'exportData' is not in JSON format");
                }

            } else {
                json_response(true, null, "Missing required form parameter 'exportData'");
            }

        } else {
            json_response(true, null, "auth:not_logged_in");
        }
    }

}


ph_register("@api", "endpoints", "records", [
    "class" => "Api_Endpoint_Records",
    "routes" => [
        "/:project/:dataType/list" => "getRecordListing",
        "/update/:id" => "updateRecord"
    ]
]);
