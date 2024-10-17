<?php

namespace SqlQueryBuilder;

use Interfaces\I_SqlQueryBuilder;

class SqlQueryBuilderFactory
{
    public static function CreateBookInfoBuilder(string $isbn, array $data): SqlQueryBuilder_Insert_BookInfo
    {
        return new SqlQueryBuilder_Insert_BookInfo($isbn, $data);
    }

    public static function CreateBookShelfBuilder(string $isbn, array $data): SqlQueryBuilder_Insert_BookShelf
    {
        return new SqlQueryBuilder_Insert_BookShelf($isbn, $data);
    }
}
