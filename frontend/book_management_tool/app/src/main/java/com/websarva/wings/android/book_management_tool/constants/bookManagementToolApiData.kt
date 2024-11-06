package com.websarva.wings.android.book_management_tool.constants


data class BookInfo(
	var bookIsbn: String = "",                   // ISBN
	var bookTitle: String = "",                  // タイトル
	var bookSubtitle: String = "",               // サブタイトル
	var bookAuthor: String = "",                 // 著者
	var bookDescription: String = "",            // 説明
	var bookImageUrl: String = "",               // 画像URL
	var bookPublisher: String = "",              // 出版社
	var bookContent: String = "",                // 内容

	var userInfoIndustryImportant: String = "",     // 会社での重要度
	var userInfoWorkImportant: String = "",         // 業界での重要度
	var userInfoUserImportant: String = "",         // ユーザでの重要度
	var userInfoPriority: String = "",               // 優先度
	var userInfoPurchasedFlag: String = "",         // 購入フラグ
	var userInfoViewedFlag: String = "",            // 閲覧フラグ

	var bookInfoPurchased: String = "",              // 購入日
	var bookInfoMemo: String = "",                   // メモ

	var readHistoriesViewStart: String = "",        // 閲覧開始日時
	var readHistoriesViewEnd: String = "",          // 閲覧終了日時
	var readHistoriesImpression: String = "",        // 感想
	var readHistoriesMemo: String = "",              // メモ
	var readHistoriesUnderstanding: String = "",     // 理解度

	var wishListMemo: String = ""                    // メモ
)

data class BookManagementToolApiData(
	var responseCode: Int = 0,                        		// レスポンスコード
	var message: String = "",                         		// メッセージ
	var bookList: MutableList<BookInfo> = mutableListOf()	// 書籍リスト
)

// APIパラメータ名
object BookManagementToolApiParameterName
{
	//booksテーブル
	const val DB_BOOKS_TB_NAME				= "books";
	const val DB_BOOKS_ISBN					= "isbn";
	const val DB_BOOKS_TITLE				= "title";
	const val DB_BOOKS_SUB_TITLE			= "sub_title";
	const val DB_BOOKS_AUTHOR				= "author";
	const val DB_BOOKS_DESCRIPTION			= "description";
	const val DB_BOOKS_IMAGE_URL			= "image_url";
	const val DB_BOOKS_PUBLISHED_DATE		= "published_date";
	const val DB_BOOKS_CONTENT				= "content";
	const val DB_BOOKS_INDUSTRY_IMPORTANT	= "industry_important";
	const val DB_BOOKS_WORK_IMPORTANT		= "work_important";
	const val DB_BOOKS_USER_IMPORTANT		= "user_important";
	const val DB_BOOKS_PRIORITY				= "priority";
	const val DB_BOOKS_PURCHASED_FLAG		= "purchased_flag";
	const val DB_BOOKS_VIEWED_FLAG			= "viewed_flag";
	const val DB_BOOKS_CREATE_TIME			= "created_time";

	//books_shelfテーブル
	const val DB_BOOKS_SHELF_TB_NAME		= "books_shelf";
	const val DB_BOOKS_SHELF_ISBN			= "isbn";
	const val DB_BOOKS_SHELF_PURCHASED		= "purchased";
	const val DB_BOOKS_SHELF_MEMO			= "memo";

	//read_historiesテーブル
	const val DB_READ_HISTORIES_TB_NAME			= "read_histories";
	const val DB_READ_HISTORIES_ISBN			= "isbn";
	const val DB_READ_HISTORIES_VIEW_START		= "view_start";
	const val DB_READ_HISTORIES_VIEW_END		= "view_end";
	const val DB_READ_HISTORIES_IMPRESSION		= "impression";
	const val DB_READ_HISTORIES_MEMO			= "memo";
	const val DB_READ_HISTORIES_UNDERSTANDING	= "understanding";

	//wish_listsテーブル
	const val DB_WISH_LISTS_TB_NAME			= "wish_lists";
	const val DB_WISH_LISTS_ISBN			= "isbn";
	const val DB_WISH_LISTS_MEMO			= "memo";
}

// API BookManagementTookのURI
object BookManagementToolApiUri {
	const val API_URI                   = "http://192.168.1.64"
	const val API_VERSION               = "v1"
	const val API_FUNC_BOOK_SHELF       = "book-shelf"
	const val API_FUNC_READ_HISTORIES   = "read-histories"
	const val API_FUNC_WISH_LIST        = "wish-list"
}