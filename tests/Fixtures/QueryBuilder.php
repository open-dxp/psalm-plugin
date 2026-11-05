<?php

use OpenDxp\Db;

function queryBuilder(): void
{
    $condition = 'id = ' . $_GET['id'];

    Db::get()->createQueryBuilder()->where($condition);
    Db::get()->createQueryBuilder()->andWhere($condition);
    Db::get()->createQueryBuilder()->orWhere($condition);
    Db::get()->createQueryBuilder()->having($condition);
    Db::get()->createQueryBuilder()->andHaving($condition);
    Db::get()->createQueryBuilder()->orHaving($condition);
}
