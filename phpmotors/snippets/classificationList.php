<?php  
    $selectList = "<select id='classificationId' name='classificationId'>";
    foreach ($classificationsList as $selectItem) {
        $selectList .= "<option value='$selectItem[classificationId]'>$selectItem[classificationName]</option>";
    }
    $selectList .= "</select>";
?>