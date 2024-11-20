package com.websarva.wings.android.book_management_tool.api

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIHandler
import com.websarva.wings.android.book_management_tool.apiResponseParser.BookManagementToolApiResponseParser
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData as BMTApiData
import com.websarva.wings.android.book_management_tool.http.HTTPGetRequestHandler
import com.websarva.wings.android.book_management_tool.uri.UriFetcher
import okhttp3.Response

class BookManagementToolAPIManager {


	/**
	 * 本棚に本を1冊追加する
	 * @return AbstractAPIHandler
	 */
	suspend fun AddOneBookShelf() {

	}

	/**
	 * 本棚の情報を全て取得する
	 * @return AbstractAPIHandler
	 */
	suspend fun getAllBookShelf(/*bookInfo: BookInfo*/): BMTApiData {
		val uri = UriFetcher().bmtAPIBookShelf()

		// APIリクエストを送信、レスポンスを取得
		val response = HTTPGetRequestHandler(uri).execute()

		// レスポンスを解析、返却
		return BookManagementToolApiResponseParser().apply {
			parseResponse(response)
		}.getResponseResult()
	}
	/*
		/**
		 * 本棚の情報を1つ取得する
		 * @return AbstractAPIHandler
		 */
		suspend fun GetOneBookShelf(): BookManagementToolApiData
		{
			return BmtApiGetOneBookShelf()
		}

		/**
		 * 本棚の情報を1つ修正する
		 * @return AbstractAPIHandler
		 */
		suspend fun UpdateOneBookShelf(): BookManagementToolApiData
		{
			return BmtApiUpdateOneBookShelf()
		}

		/**
		 * 本棚から本を1冊削除する
		 * @return AbstractAPIHandler
		 */
		suspend fun DeleteOneBookShelf(): BookManagementToolApiData
		{
			return BmtApiDeleteOneBookShelf()
		}

		/**
		 * 読書履歴に本を1冊追加する
		 * @return AbstractAPIHandler
		 */
		suspend fun AddOneReadHistory(): BookManagementToolApiData
		{
			return BmtApiAddOneReadHistory()
		}
*/

		/**
		 * 読書履歴の情報を全て取得する
		 * @return AbstractAPIHandler
		 */
		suspend fun getAllReadHistories(): BMTApiData
		{
			val uri = UriFetcher().bmtAPIReadHistories()

			// APIリクエストを送信、レスポンスを取得
			val response = HTTPGetRequestHandler(uri).execute()

			// レスポンスを解析、返却
			return BookManagementToolApiResponseParser().apply {
				parseResponse(response)
			}.getResponseResult()
		}

/*
		/**
		 * 読書履歴の情報を1つ取得する
		 * @return AbstractAPIHandler
		 */
		suspend fun GetOneReadHistory(): BookManagementToolApiData
		{
			return BmtApiGetOneReadHistory()
		}

		/**
		 * 読み終えた本の読書履歴を取得する
		 * @return AbstractAPIHandler
		 */
		suspend fun GetReadHistoryOfReadBooks(): BookManagementToolApiData
		{
			return BmtApiGetReadHistoryOfReadBooks()
		}

		/**
		 * 途中で読みかけの本の読書履歴を取得する
		 * @return AbstractAPIHandler
		 */
		suspend fun GetReadHistoryOfReadingBooks(): BookManagementToolApiData
		{
			return BmtApiGetReadHistoryOfReadingBooks()
		}

		/**
		 * 読書履歴から本を1冊削除する
		 * @return AbstractAPIHandler
		 */
		suspend fun DeleteOneReadHistory(): BookManagementToolApiData
		{
			return BmtApiDeleteOneReadHistory()
		}

		/**
		 * 読書履歴の情報を全て削除する
		 * @return AbstractAPIHandler
		 */
		suspend fun DeleteAllReadHistories(): BookManagementToolApiData{
			return BmtApiDeleteAllReadHistories()
		}
*/
		/**
		 * ほしいものリストに本を1冊追加する
		 * @return AbstractAPIHandler
		 */
		suspend fun AddOneWishList(isbn:String): BMTApiData{
			val uri = UriFetcher().bmtAPIWishList()

			val response = object:HTTPGetRequestHandler(uri){
				override fun createRequestQuery(): Map<String, String> {
					return mapOf("isbn" to isbn)
				}
			}.execute()

			// レスポンスを解析、返却
			return BookManagementToolApiResponseParser().apply {
				parseResponse(response)
			}.getResponseResult()
		}

		/**
		 * ほしいものリストの情報を全て取得する
		 * @return AbstractAPIHandler
		 */
		suspend fun getAllWishLists(): BMTApiData
		{
			val uri = UriFetcher().bmtAPIWishList()

			// APIリクエストを送信、レスポンスを取得
			val response = HTTPGetRequestHandler(uri).execute()

			// レスポンスを解析、返却
			return BookManagementToolApiResponseParser().apply {
				parseResponse(response)
			}.getResponseResult()
		}
/*
		/**
		 * ほしいものリストの情報を1つ取得する
		 * @return AbstractAPIHandler
		 */
		suspend fun GetOneWishList(): BookManagementToolApiData{
			return BmtApiGetOneWishList()
		}

		/**
		 * ほしいものリストの情報を1つ修正する
		 * @return AbstractAPIHandler
		 */
		suspend fun UpdateOneWishList(): BookManagementToolApiData{
			return BmtApiUpdateOneWishList()
		}

		/**
		 * ほしいものリストから本を1冊削除する
		 * @return AbstractAPIHandler
		 */
		suspend fun DeleteOneWishList(): BookManagementToolApiData{
			return BmtApiDeleteOneWishList()
		}

		/**
		 * ほしいものリストの情報を全て削除する
		 * @return AbstractAPIHandler
		 */
		suspend fun DeleteAllWishLists(): BookManagementToolApiData{
			return BmtApiDeleteAllWishLists()
		}

	*/

}