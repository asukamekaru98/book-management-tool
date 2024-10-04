<?php
/* RFC 9110 */

# 情報レスポンス
const CONTINUE_100 = 100;                         // リクエストを継続してください
const SWITCHING_PROTOCOLS_101 = 101;              // プロトコルの切り替えを行う
const PROCESSING_102 = 102;                       // 処理中
const EARLY_HINTS_103 = 103;                      // 早期のヒント

# 成功レスポンス
const OK_200 = 200;                               // リクエスト成功
const CREATED_201 = 201;                          // 新しいリソースを作成した
const ACCEPTED_202 = 202;                         // リクエストを受理したが、処理は完了していない
const NON_AUTH_INFO_203 = 203;                    // 信頼できない情報
const NO_CONTENT_204 = 204;                       // レスポンスにデータを含まないときに使う。たとえばDELETEメソッドが成功したとき
const RESET_CONTENT_205 = 205;                    // 表示をリセット
const PARTIAL_CONTENT_206 = 206;                  // 部分的なコンテンツを返す
const MULTI_STATUS_207 = 207;                     // 複数のステータス
const ALREADY_REPORTED_208 = 208;                 // 既に報告済み
const IM_USED_226 = 226;                          // IM（インスタントメッセージ）使用

# リダイレクトメッセージ
const MULTIPLE_CHOICES_300 = 300;                 // 複数の選択肢がある
const MOVED_PERMANENTLY_301 = 301;                // 永久に移動した
const FOUND_302 = 302;                            // 一時的に移動した
const SEE_OTHER_303 = 303;                        // 他を参照せよ
const NOT_MODIFIED_304 = 304;                     // 更新されていない
const TEMPORARY_REDIRECT_307 = 307;               // 一時的なリダイレクト
const PERMANENT_REDIRECT_308 = 308;               // 永続的なリダイレクト

# クライアントエラーレスポンス
const BAD_REQUEST_400 = 400;                      // リクエストが不正
const UNAUTHORIZED_401 = 401;                     // 認証が必要、あなたが誰か分からない
const FORBIDDEN_403 = 403;                        // アクセス禁止、許可がない
const NOT_FOUND_404 = 404;                        // リソースが見つからない
const METHOD_NOT_ALLOWED_405 = 405;               // 許可されていないメソッド
const NOT_ACCEPTABLE_406 = 406;                   // クライアントが指定したデータ形式にAPIが対応していないときに使う、例えばJSONのみ対応なのにXMLを指定した場合など。
const PROXY_AUTH_REQUIRED_407 = 407;              // プロキシ認証が必要
const REQUEST_TIMEOUT_408 = 408;                  // リクエストタイムアウト
const CONFLICT_409 = 409;                         // リクエストの競合や、リソースの競合があったとき。
const GONE_410 = 410;                             // リソースが消滅した
const LENGTH_REQUIRED_411 = 411;                  // Content-Lengthが必要
const PRECONDITION_FAILED_412 = 412;              // 前提条件が失敗
const PAYLOAD_TOO_LARGE_413 = 413;                // リクエストボディ、リクエストヘッダが長すぎる
const URI_TOO_LONG_414 = 414;                     // URIが長すぎる
const UNSUPPORTED_MEDIA_TYPE_415 = 415;           // サポートされていないメディアタイプ
const RANGE_NOT_SATISFIABLE_416 = 416;            // リクエストしたレンジが範囲外
const EXPECTATION_FAILED_417 = 417;               // Expectヘッダの要求に応えられない
const IM_A_TEAPOT_418 = 418;                      // エイプリルフールのジョーク（ティーポット）
const MISDIRECTED_REQUEST_421 = 421;              // 誤ったサーバーへのリクエスト
const UNPROCESSABLE_CONTENT_422 = 422;            // 処理不可なエンティティ
const LOCKED_423 = 423;                           // ロックされている
const FAILED_DEPENDENCY_424 = 424;                // 依存関係の失敗
const TOO_EARLY_425 = 425;                        // 早すぎるリクエスト
const UPGRADE_REQUIRED_426 = 426;                 // プロトコルのアップグレードが必要
const PRECONDITION_REQUIRED_428 = 428;            // 前提条件が必要
const TOO_MANY_REQUESTS_429 = 429;                // リクエストが多すぎる
const REQUEST_HEADER_FIELDS_TOO_LARGE_431 = 431;  // ヘッダーフィールドが大きすぎる
const UNAVAILABLE_FOR_LEGAL_REASONS_451 = 451;    // 法的理由により利用不可

# サーバーエラーレスポンス
const INTERNAL_SERVER_ERROR_500 = 500;            // サーバー内部エラー
const NOT_IMPLEMENTED_501 = 501;                  // 未実装の機能
const BAD_GATEWAY_502 = 502;                      // 不正なゲートウェイ
const SERVICE_UNAVAILABLE_503 = 503;              // サービス利用不可
const GATEWAY_TIMEOUT_504 = 504;                  // ゲートウェイタイムアウト
const HTTP_VERSION_NOT_SUPPORTED_505 = 505;       // HTTPバージョンがサポートされていない
const VARIANT_ALSO_NEGOTIATES_506 = 506;          // サーバーが適切な応答を生成できない（内部サーバーエラー）
const INSUFFICIENT_STORAGE_507 = 507;             // ストレージ容量不足
const LOOP_DETECTED_508 = 508;                    // 無限ループを検出
const NOT_EXTENDED_510 = 510;                     // リクエストの拡張が必要
const NETWORK_AUTH_REQUIRED_511 = 511;            // ネットワーク認証が必要
