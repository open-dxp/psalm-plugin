<?php

use OpenDxp\Model\DataObject\Listing;

function listing(Listing $listing): void
{
    $listing->setCondition('id = ' . $_GET['id']);
    $listing->addConditionParam('id = ' . $_GET['id']);
}
