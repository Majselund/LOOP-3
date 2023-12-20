<?php
// hver gang man bruger en session skal man bruge session_start
session_start();
session_destroy();
//redirecter til index siden
header("Location: ../index.php");
exit;
// vi behøver ikke closing tag fordi vi kun bruger php 
