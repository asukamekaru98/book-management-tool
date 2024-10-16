<?php

namespace Interfaces;

interface I_SQLManager
{

    // SQLクエリの設定
    //public function SetSqlQuery(string $sqlQuery);

    // クエリの実行
    public function ExecuteSqlQuery(I_SqlQueryBuilder $sqlQueryBuilder);

    // HTTPレスポンスコードの取得
    public function GetHttpResponseCode();

    // HTTPレスポンスボディの取得
    //public function GetResponseBody(): array;
}
