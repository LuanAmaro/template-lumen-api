<?php

$router->get("/", function () {
    return response()->json([
        "message" => "Template Lumen - API"
    ]);
});
