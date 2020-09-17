<?php
session_start();
echo $_SESSION['key'];
session_write_close();
return;
