<?php

$mysqli = mysqli_connect("localhost", "rigassembly_admin", "jiajunc2", "rigassembly_main");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

 ?>