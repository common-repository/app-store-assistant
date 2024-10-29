<?php
$showSaveChangesButton = false;
?>
<h1>Beta Utilities Testing Ground</h1>


<div class="wrap">
<div id='loading'>LOADING!</div>
<div id='helloworld'></div>

<?php
$appdata = array(
  'itemID' => '123456789012345678901234567890',
  'itemType' => 'Music' 
);

$asaItem = new ASAitem( $appdata );
echo "[".$asaItem->get_excerpt()."]";






?>



</div>