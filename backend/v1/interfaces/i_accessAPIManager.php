<?php

namespace Interfaces;

interface I_AccessAPIManager
{

    public function AccessAPI();    // APIにアクセスする

    // クエリの設定
    // 例: SetOptionQueries('isbn=9780000000000');
    public function SetOptionQueries(string $query);
    public function GetApiResponse(): string;    // APIのレスポンスを取得
    public function GetApiResponseBody(): array;    // APIのレスポンスボディを取得
}
