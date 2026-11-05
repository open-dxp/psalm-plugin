<?php

use OpenDxp\Db;
use OpenDxp\Model\DataObject\Listing;

function parameters(Listing $listing): void
{
    $listing->setCondition('id = ?', [$_GET['id']]);
    $listing->addConditionParam('id = ?', $_GET['id']);
    Db::get()->fetchAllAssociative('SELECT * FROM objects WHERE id = ?', [$_GET['id']]);
    Db::get()->createQueryBuilder()->where('id = :id')->setParameter('id', $_GET['id']);
}
