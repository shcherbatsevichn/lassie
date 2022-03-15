<?
function dump($var, $die = false, $all = true){
    global $USER;
    if($USER->IsAdmin() || ($all == true))
    {
    ?>
    <font style="text-align: left; font-size: 10px"><pre><?var_dump($var)?></pre></font><br>
    <?
    }
    if($die){
    die;
    }
}
?>
