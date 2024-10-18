<?php

namespace SqlQueryBuilder;

use Interfaces\I_SqlQueryBuilder;

require_once('sqlQueryBuilder_Insert_BookInfo.php');
require_once('sqlQueryBuilder_Insert_BookShelf.php');
require_once('sqlQueryBuilder_Select_ISBN.php');

class SqlQueryBuilderFactory
{
    public static function InsertBookInfo(string $isbn, array $data): SqlQueryBuilder_Insert_BookInfo
    {
        return new SqlQueryBuilder_Insert_BookInfo($isbn, $data);
    }

    public static function InsertBookShelf(string $isbn, array $data): SqlQueryBuilder_Insert_BookShelf
    {
        return new SqlQueryBuilder_Insert_BookShelf($isbn, $data);
    }

    public static function IsIsbnCodeDuplicate(string $isbn, array $data): SqlQueryBuilder_IsIsbnCodeDuplicate
    {
        return new SqlQueryBuilder_IsIsbnCodeDuplicate($isbn, $data);
    }
}
