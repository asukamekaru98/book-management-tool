<?php
class ConfigLoader
{
    public static function loadConfig(string $configFile): array
    {
        // 設定ファイルをパースするロジック
        return parse_ini_file($configFile, true);
    }
}
