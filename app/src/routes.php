<?php
// global Routes // module specifice routes should be defigned in module's routes.php file.
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Modular '/' route");
});
