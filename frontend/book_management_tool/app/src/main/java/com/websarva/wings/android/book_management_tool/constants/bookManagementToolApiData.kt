package com.websarva.wings.android.book_management_tool.constants
/*data class BookInfo(
	val isbn: String,                   // ISBN
	val title: String,                  // タイトル
	val subTitle: String,               // サブタイトル
	val author: String,                 // 著者
	val description: String,            // 説明
	val imageURL: String,                // 画像URL
	val publisher: String,              // 出版社
	val content: String,                // 内容
)

data class UserInfo(
	val industry_important: String,     // 会社での重要度
	val work_important: String,         // 業界での重要度
	val user_important: String,         // ユーザでの重要度
	val priority: String,               // 優先度
	val purchased_flag: String,         // 購入フラグ
	val viewed_flag: String,            // 閲覧フラグ
)

data class BookShelf(
	val purchased:String,               // 購入日
	val memo:String,                    // メモ
)

data class ReadHistories(
	val view_start:String,              // 閲覧開始日時
	val view_end:String,                // 閲覧終了日時
	val impression:String,              // 感想
	val memo:String,                    // メモ
	val understanding:String,           // 理解度
)

data class WishList(
	val memo: String,                   // メモ
)

data class Book(
	val bookInfo: BookInfo,            // 書籍情報
	val userInfo: UserInfo,            // ユーザ情報
	val bookShelf: BookShelf,          // 本棚情報
	val readHistories: ReadHistories,  // 閲覧履歴
	val wishList: WishList,            // 欲しいものリスト
)
 */

data class BookInfo(
	var book_isbn: String = "",                   // ISBN
	var book_title: String = "",                  // タイトル
	var book_subTitle: String = "",               // サブタイトル
	var book_author: String = "",                 // 著者
	var book_description: String = "",            // 説明
	var book_imageURL: String = "",               // 画像URL
	var book_publisher: String = "",              // 出版社
	var book_content: String = "",                // 内容

	var userInfo_industry_important: String = "",     // 会社での重要度
	var userInfo_work_important: String = "",         // 業界での重要度
	var userInfo_user_important: String = "",         // ユーザでの重要度
	var userInfo_priority: String = "",               // 優先度
	var userInfo_purchased_flag: String = "",         // 購入フラグ
	var userInfo_viewed_flag: String = "",            // 閲覧フラグ

	var bookInfo_purchased: String = "",              // 購入日
	var bookInfo_memo: String = "",                   // メモ

	var readHistories_view_start: String = "",        // 閲覧開始日時
	var readHistories_view_end: String = "",          // 閲覧終了日時
	var readHistories_impression: String = "",        // 感想
	var readHistories_memo: String = "",              // メモ
	var readHistories_understanding: String = "",     // 理解度

	var wishList_memo: String = ""                    // メモ
)

data class BookManagementToolApiData(
	var responseCode: Int = 0,                        		// レスポンスコード
	var message: String = "",                         		// メッセージ
	var bookList: MutableList<BookInfo> = mutableListOf()	// 書籍リスト
)