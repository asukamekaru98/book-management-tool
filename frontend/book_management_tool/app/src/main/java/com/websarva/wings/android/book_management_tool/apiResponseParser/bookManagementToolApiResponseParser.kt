package com.websarva.wings.android.book_management_tool.apiResponseParser

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIResponseParser
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiParameterName as API_PARAM
import org.json.JSONArray
import org.json.JSONObject

class BookManagementToolApiResponseParser : AbstractAPIResponseParser() {

	private val bookList: MutableList<BookInfo> = mutableListOf()
	private var message: String = "error"
	private var code: Int = -1

	override fun parseResponse(response: String) {
		// 本棚のAPIレスポンスを解析

		//this.code = response.code
		//val body = response


		// レスポンスコードを解析
		/*
				try {
					ApiResponseCodeParser(this.code).parse()

					body?.use { responseBody ->
						parseBody(responseBody.string())
					} ?: throw IOException("Response body is null")

				} catch (e: Exception) {
					throw e
				}

		 */
		try {
			//ApiResponseCodeParser(this.code).parse()
			parseBody(response)
		} catch (e: Exception) {
			throw e
		}
	}

	fun getResponseResult(): BookManagementToolApiData {
		return BookManagementToolApiData(
			responseCode = code,
			message = this.message,
			bookList = this.bookList
		)
	}

	/**
	 * レスポンスメッセージを取得
	 * @return レスポンスメッセージ
	 */
	override fun parseJSONObject(jsonObject: JSONObject) {
		val jsonArray = jsonObject.optJSONArray("data") ?: JSONArray()

		for (i in 0 until jsonArray.length()) {
			val bookInfo = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_BOOKS) ?: JSONObject()
			val userInfo = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_USER_INFO) ?: JSONObject()
			val bookShelf = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_BOOKS_SHELF) ?: JSONObject()
			val readHistories = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_READ_HISTORIES) ?: JSONObject()
			val wishList = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_WISH_LIST) ?: JSONObject()

			val book = BookInfo(
				bookIsbn = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_ISBN, "データ無し"),
				bookTitle = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_TITLE, "データ無し"),
				bookSubtitle = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_SUB_TITLE, "データ無し"),
				bookAuthor = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_AUTHOR, "データ無し"),
				bookDescription = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_DESCRIPTION, "データ無し"),
				bookImageUrl = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_IMAGE_URL, "データ無し"),
				bookPublisher = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_PUBLISHED_DATE, "データ無し"),
				bookContent = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_CONTENT, "データ無し"),

				userInfoIndustryImportant = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_INDUSTRY_IMPORTANT, "データ無し"),
				userInfoWorkImportant = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_WORK_IMPORTANT, "データ無し"),
				userInfoUserImportant = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_USER_IMPORTANT, "データ無し"),
				userInfoPriority = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_PRIORITY, "データ無し"),
				userInfoPurchasedFlag = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_PURCHASED_FLAG, "データ無し"),
				userInfoViewedFlag = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_VIEWED_FLAG, "データ無し"),

				bookInfoPurchased = bookShelf.optString(API_PARAM.API_PARAM_BOOKS_SHELF_PURCHASED, "データ無し"),
				bookInfoMemo = bookShelf.optString(API_PARAM.API_PARAM_BOOKS_SHELF_MEMO, "データ無し"),

				readHistoriesViewStart = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_VIEW_START, "データ無し"),
				readHistoriesViewEnd = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_VIEW_END, "データ無し"),
				readHistoriesImpression = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_IMPRESSION, "データ無し"),
				readHistoriesMemo = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_MEMO, "データ無し"),
				readHistoriesUnderstanding = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_UNDERSTANDING, "データ無し"),

				wishListMemo = wishList.optString(API_PARAM.API_PARAM_WISH_LIST_MEMO, "データ無し")
			)
			this.bookList.add(book)
		}
	}

	/**
	 * レスポンスメッセージを取得
	 * @return レスポンスメッセージ
	 */
	override fun parseJSONArray(jsonArray: JSONArray) {
		for (i in 0 until jsonArray.length()) {
			val bookInfo = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_BOOKS) ?: JSONObject()
			val userInfo = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_USER_INFO) ?: JSONObject()
			val bookShelf = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_BOOKS_SHELF) ?: JSONObject()
			val readHistories = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_READ_HISTORIES) ?: JSONObject()
			val wishList = jsonArray.optJSONObject(i)?.optJSONObject(API_PARAM.API_PARAM_WISH_LIST) ?: JSONObject()

			val book = BookInfo(
				bookIsbn = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_ISBN, "データ無し"),
				bookTitle = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_TITLE, "データ無し"),
				bookSubtitle = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_SUB_TITLE, "データ無し"),
				bookAuthor = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_AUTHOR, "データ無し"),
				bookDescription = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_DESCRIPTION, "データ無し"),
				bookImageUrl = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_IMAGE_URL, "データ無し"),
				bookPublisher = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_PUBLISHED_DATE, "データ無し"),
				bookContent = bookInfo.optString(API_PARAM.API_PARAM_BOOKS_CONTENT, "データ無し"),

				userInfoIndustryImportant = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_INDUSTRY_IMPORTANT, "データ無し"),
				userInfoWorkImportant = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_WORK_IMPORTANT, "データ無し"),
				userInfoUserImportant = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_USER_IMPORTANT, "データ無し"),
				userInfoPriority = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_PRIORITY, "データ無し"),
				userInfoPurchasedFlag = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_PURCHASED_FLAG, "データ無し"),
				userInfoViewedFlag = userInfo.optString(API_PARAM.API_PARAM_USER_INFO_VIEWED_FLAG, "データ無し"),

				bookInfoPurchased = bookShelf.optString(API_PARAM.API_PARAM_BOOKS_SHELF_PURCHASED, "データ無し"),
				bookInfoMemo = bookShelf.optString(API_PARAM.API_PARAM_BOOKS_SHELF_MEMO, "データ無し"),

				readHistoriesViewStart = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_VIEW_START, "データ無し"),
				readHistoriesViewEnd = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_VIEW_END, "データ無し"),
				readHistoriesImpression = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_IMPRESSION, "データ無し"),
				readHistoriesMemo = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_MEMO, "データ無し"),
				readHistoriesUnderstanding = readHistories.optString(API_PARAM.API_PARAM_READ_HISTORIES_UNDERSTANDING, "データ無し"),

				wishListMemo = wishList.optString(API_PARAM.API_PARAM_WISH_LIST_MEMO, "データ無し")
			)
			this.bookList.add(book)
		}
	}
}