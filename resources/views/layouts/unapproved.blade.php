<?php
$unapproved = DB::table('absences')
->where('status', 1)
->count();

echo $unapproved;
?>