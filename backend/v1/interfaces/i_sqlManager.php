<?php

namespace Interfaces;

interface I_SQLManager
{

    // SQLクエリの設定
    //public function SetSqlQuery(string $sqlQuery);

    // クエリの実行
    public function ExecuteSqlQuery(string $sqlQuery);

    // HTTPレスポンスコードの取得
    public function GetHttpResponseCode(): int;

    // HTTPレスポンスボディの取得
    public function GetResponseBody(): array;
}
