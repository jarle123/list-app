<?php


function getListItem($itemNo, $listItemId, $itemName)
{
    $name = htmlspecialchars($itemName, ENT_HTML5);

   return <<< HTML
    <li class="li-container">
        <label for="list-item-$itemNo">
            <input type="checkbox" id="list-item-$itemNo"  name="list-item-$itemNo" value="$listItemId">
            $name
            <span class="closeX"></span>
        </label>
    
    </li>
    
    HTML;
}