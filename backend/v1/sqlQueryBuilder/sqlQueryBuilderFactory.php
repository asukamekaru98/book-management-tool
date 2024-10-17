<?php

namespace SqlQueryBuilder;

use Interfaces\I_SqlQueryBuilder;

require_once('sqlQueryBuilder_Insert_BookInfo.php');
require_once('sqlQueryBuilder_Insert_BookShelf.php');

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
