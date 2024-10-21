<?php

namespace SqlQueryBuilder;

class SqlQueryBuilderFactory
{
    ### BookInfo ###
    public static function InsertBookInfo(string $isbn, array $data): Sql_Insert_BookInfo
    {
        require_once('sql_Insert_BookInfo.php');

        return new Sql_Insert_BookInfo($isbn, $data);
    }

    ### BookShelf ###
    public static function SelectBookShelf(string $isbn, array $data): Sql_Select_BookShelf
    {
        require_once('sql_Select_BookShelf.php');

        return new Sql_Select_BookShelf($isbn, $data);
    }

    public static function SelectAllBookShelf(string $isbn, array $data): Sql_Select_All_BookShelf
    {
        require_once('sql_Select_All_BookShelf.php');

        return new Sql_Select_All_BookShelf($isbn, $data);
    }

    public static function InsertBookShelf(string $isbn, array $data): Sql_Insert_BookShelf
    {
        require_once('sql_Insert_BookShelf.php');

        return new Sql_Insert_BookShelf($isbn, $data);
    }

    public static function UpdateBookShelf(string $isbn, array $data): Sql_Update_BookShelf
    {
        require_once('sql_Update_BookInfo.php');

        return new Sql_Update_BookShelf($isbn, $data);
    }

    public static function DeleteBookShelf(string $isbn, array $data): Sql_Delete_BookShelf
    {
        require_once('sql_Delete_BookShelf.php');

        return new Sql_Delete_BookShelf($isbn, $data);
    }

    ### WishList ###
    public static function SelectWishList(string $isbn, array $data): Sql_Select_WishList
    {
        require_once('sql_Select_WishList.php');

        return new Sql_Select_WishList($isbn, $data);
    }

    public static function SelectAllWishList(string $isbn, array $data): Sql_Select_All_WishList
    {
        require_once('sql_Select_All_WishList.php');

        return new Sql_Select_All_WishList($isbn, $data);
    }

    public static function InsertWishList(string $isbn, array $data): SqlInsertWishList
    {
        require_once('sql_Insert_WishList.php');

        return new SqlInsertWishList($isbn, $data);
    }

    public static function UpdateWishList(string $isbn, array $data): SqlUpdateWishList
    {
        require_once('sql_Update_WishList.php');

        return new SqlUpdateWishList($isbn, $data);
    }

    public static function DeleteWishList(string $isbn, array $data): SqlDeleteWishList
    {
        require_once('sql_Delete_WishList.php');

        return new SqlDeleteWishList($isbn, $data);
    }

    // ISBNコードが重複しているかどうかを確認する
    public static function IsIsbnCodeDuplicate(string $isbn, array $data): Sql_IsIsbnCodeDuplicate
    {
        require_once('sql_IsIsbnCodeDuplicate.php');

        return new Sql_IsIsbnCodeDuplicate($isbn, $data);
    }
}
