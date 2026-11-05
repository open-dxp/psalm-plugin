<?php

use OpenDxp\Db;

function connection(): void
{
    $sql = 'SELECT * FROM objects WHERE id = ' . $_GET['id'];

    Db::get()->executeQuery($sql);
    Db::get()->fetchAssociative($sql);
    Db::get()->fetchNumeric($sql);
    Db::get()->fetchOne($sql);
    Db::get()->fetchAllNumeric($sql);
    Db::get()->fetchAllAssociative($sql);
    Db::get()->fetchAllKeyValue($sql);
    Db::get()->fetchAllAssociativeIndexed($sql);
    Db::get()->fetchFirstColumn($sql);
}
