<?php

namespace SqlQueryBuilder;

use Interfaces\I_SqlQueryBuilder;

require_once('sql_Select_BookShelf.php');
require_once('sql_Select_All_BookShelf.php');
require_once('sql_Insert_BookInfo.php');
require_once('sql_Update_BookInfo.php');
require_once('sql_Delete_BookShelf.php');
require_once('sql_Insert_BookShelf.php');
require_once('sql_IsIsbnCodeDuplicate.php');

class SqlQueryBuilderFactory
{
    ### BookInfo ###
    public static function InsertBookInfo(string $isbn, array $data): Sql_Insert_BookInfo
    {
        return new Sql_Insert_BookInfo($isbn, $data);
    }

    ### BookShelf ###
    public static function SelectBookShelf(string $isbn, array $data): Sql_Select_BookShelf
    {
        return new Sql_Select_BookShelf($isbn, $data);
    }

    public static function SelectAllBookShelf(string $isbn, array $data): Sql_Select_All_BookShelf
    {
        return new Sql_Select_All_BookShelf($isbn, $data);
    }

    public static function InsertBookShelf(string $isbn, array $data): Sql_Insert_BookShelf
    {
        return new Sql_Insert_BookShelf($isbn, $data);
    }

    public static function UpdateBookShelf(string $isbn, array $data): Sql_Update_BookShelf
    {
        return new Sql_Update_BookShelf($isbn, $data);
    }

    public static function DeleteBookShelf(string $isbn, array $data): Sql_Delete_BookShelf
    {
        return new Sql_Delete_BookShelf($isbn, $data);
    }

    // ISBNコードが重複しているかどうかを確認する
    public static function IsIsbnCodeDuplicate(string $isbn, array $data): Sql_IsIsbnCodeDuplicate
    {
        return new Sql_IsIsbnCodeDuplicate($isbn, $data);
    }
}
