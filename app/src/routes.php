<?php
// global Routes // module specifice routes should be defigned in module's routes.php file.
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-HMVC '/' route");
    echo "App successfully installed. This msg is coming form ./app/src/routes.php";
    echo "<br/>";
    echo "There is an example module in ./app/modules/ folder. Study it and you'll have the idea how to create new ones";
    echo "<br/>";
    echo "all Models and Controllers should extend AmitKhareSlimHMVC\Model and AmitKhareSlimHMVC\Controller respectively.";
    echo "<br/>";
    echo "You will find base Model and Controller from ./app/hmvc/abstract/ folder.";
    echo "<br/>";
    echo "This project is in very early stage so you can expect bugs.";
    echo "<br/>";
    echo "Follow me <a href='https://twitter.com/amitkhare' target='_BLANK'>@amitkhare</a>";
});
