<?php
/* RFC 9110 */

# 情報レスポンス
define('CONTINUE_100', 100); // リクエストを継続してください
define('SWITCHING_PROTOCOLS_101', 101); // プロトコルの切り替えを行う
define('PROCESSING_102', 102); // 処理中
define('EARLY_HINTS_103', 103); // 早期のヒント

# 成功レスポンス
define('OK_200', 200); // リクエスト成功
define('CREATED_201', 201); // 新しいリソースを作成した
define('ACCEPTED_202', 202); // リクエストを受理したが、処理は完了していない
define('NON_AUTH_INFO_203', 203); // 信頼できない情報
define('NO_CONTENT_204', 204); // コンテンツなし
define('RESET_CONTENT_205', 205); // 表示をリセット
define('PARTIAL_CONTENT_206', 206); // 部分的なコンテンツを返す
define('MULTI_STATUS_207', 207); // 複数のステータス
define('ALREADY_REPORTED_208', 208); // 既に報告済み
define('IM_USED_226', 226); // IM（インスタントメッセージ）使用

# リダイレクトメッセージ
define('MULTIPLE_CHOICES_300', 300); // 複数の選択肢がある
define('MOVED_PERMANENTLY_301', 301); // 永久に移動した
define('FOUND_302', 302); // 一時的に移動した
define('SEE_OTHER_303', 303); // 他を参照せよ
define('NOT_MODIFIED_304', 304); // 更新されていない
//define('USE_PROXY_305', 305); // 廃止されたステータスコード
//define('_306', 306); // 現在未使用
define('TEMPORARY_REDIRECT_307', 307); // 一時的なリダイレクト
define('PERMANENT_REDIRECT_308', 308); // 永続的なリダイレクト

# クライアントエラーレスポンス
define('BAD_REQUEST_400', 400); // リクエストが不正
define('UNAUTHORIZED_401', 401); // 認証が必要
//define('PAYMENT_REQUIRED_402', 402); // 予約
define('FORBIDDEN_403', 403); // アクセス禁止
define('NOT_FOUND_404', 404); // リソースが見つからない
define('METHOD_NOT_ALLOWED_405', 405); // 許可されていないメソッド
define('NOT_ACCEPTABLE_406', 406); // 受理できない内容
define('PROXY_AUTH_REQUIRED_407', 407); // プロキシ認証が必要
define('REQUEST_TIMEOUT_408', 408); // リクエストタイムアウト
define('CONFLICT_409', 409); // リクエストの競合
define('GONE_410', 410); // リソースが消滅した
define('LENGTH_REQUIRED_411', 411); // Content-Lengthが必要
define('PRECONDITION_FAILED_412', 412); // 前提条件が失敗
define('PAYLOAD_TOO_LARGE_413', 413); // ペイロードが大きすぎる
define('URI_TOO_LONG_414', 414); // URIが長すぎる
define('UNSUPPORTED_MEDIA_TYPE_415', 415); // サポートされていないメディアタイプ
define('RANGE_NOT_SATISFIABLE_416', 416); // リクエストしたレンジが範囲外
define('EXPECTATION_FAILED_417', 417); // Expectヘッダの要求に応えられない
define('IM_A_TEAPOT_418', 418); // エイプリルフールのジョーク（ティーポット）
define('MISDIRECTED_REQUEST_421', 421); // 誤ったサーバーへのリクエスト
define('UNPROCESSABLE_CONTENT_422', 422); // 処理不可なエンティティ
define('LOCKED_423', 423); // ロックされている
define('FAILED_DEPENDENCY_424', 424); // 依存関係の失敗
define('TOO_EARLY_425', 425); // 早すぎるリクエスト
define('UPGRADE_REQUIRED_426', 426); // プロトコルのアップグレードが必要
define('PRECONDITION_REQUIRED_428', 428); // 前提条件が必要
define('TOO_MANY_REQUESTS_429', 429); // リクエストが多すぎる
define('REQUEST_HEADER_FIELDS_TOO_LARGE_431', 431); // ヘッダーフィールドが大きすぎる
define('UNAVAILABLE_FOR_LEGAL_REASONS_451', 451); // 法的理由により利用不可

# サーバーエラーレスポンス
define('INTERNAL_SERVER_ERROR_500', 500); // サーバー内部エラー
define('NOT_IMPLEMENTED_501', 501); // 未実装の機能
define('BAD_GATEWAY_502', 502); // 不正なゲートウェイ
define('SERVICE_UNAVAILABLE_503', 503); // サービス利用不可
define('GATEWAY_TIMEOUT_504', 504); // ゲートウェイタイムアウト
define('HTTP_VERSION_NOT_SUPPORTED_505', 505); // HTTPバージョンがサポートされていない
define('VARIANT_ALSO_NEGOTIATES_506', 506); // サーバーが適切な応答を生成できない（内部サーバーエラー）
define('INSUFFICIENT_STORAGE_507', 507); // ストレージ容量不足
define('LOOP_DETECTED_508', 508); // 無限ループを検出
//define('BANDWIDTH_LIMIT_EXCEEDED_509', 509); // 非公式のステータスコード
define('NOT_EXTENDED_510', 510); // リクエストの拡張が必要
define('NETWORK_AUTH_REQUIRED_511', 511); // ネットワーク認証が必要