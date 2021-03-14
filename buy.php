<?php

include "functions.php";

generateHeader ("CompMTL Home Page");

generateBody();

echo '<br>';
buy($errors);

validateForm();

generateFooter();
?>