<?php

namespace SqlQueryBuilder;

use Interfaces\I_SqlQueryBuilder;

class SqlQueryBuilderFactory
{
    public static function createBookInfoQueryBuilder(string $isbn, array $data,): SqlQueryBuilder_BookInfo
    {
        return new SqlQueryBuilder_BookInfo($isbn, $data);
    }
}
