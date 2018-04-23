<?php
  if (isset($_POST['type'])) {
    // clearstatcache();
    $output = shell_exec('/home/movietellerdb/miniconda3/bin/python main.py '.$_POST['type'].' "'.$_POST['y_value'].'" '.$_POST['generation'].' '.$_POST['genre'].'');
    sleep(1);
    echo '<img src="'.$output.'" alt="development" height="100%" width="100%">';
  }

?>
