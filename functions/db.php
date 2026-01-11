<?php
$dbh = new PDO('mysql:host=localhost;dbname=microblog', 'microblog', 'password');
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);