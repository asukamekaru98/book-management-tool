package com.websarva.wings.android.book_management_tool.apiResponseParser

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIResponseParser
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData
import okhttp3.Response
import org.json.JSONArray
import org.json.JSONObject

class BookManagementToolApiResponseParser : AbstractAPIResponseParser() {

	private val bookList: MutableList<BookInfo> = mutableListOf()
	private var message: String = "error"
	private var code: Int = -1

	override fun parseResponse(response: Response) {
		// 本棚のAPIレスポンスを解析

		//val responseBody = apiResponse.getResponseBody()
		//Log.d("ResponseBody", responseBody) // デバッグログを追加

		this.code = response.code

		// レスポンスコードを解析
		try{
			ApiResponseCodeParser(this.code).parse()
			parseBody(response.body!!.string())
		}catch (e: Exception){
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

	override fun parseJSONObject(jsonObject: JSONObject) {
		this.message = jsonObject.getString("message")


		for (i in 0 until jsonObject.length()) {
			if (jsonObject.has("bookList")) {
				val bookInfo = jsonObject.getJSONArray("bookInfo").getJSONObject(i)
				val userInfo = jsonObject.getJSONArray("userInfo").getJSONObject(i)
				val bookShelf = jsonObject.getJSONArray("userInfo").getJSONObject(i)
				val readHistories = jsonObject.getJSONArray("readHistories").getJSONObject(i)
				val wishList = jsonObject.getJSONArray("wishList").getJSONObject(i)

				val book = BookInfo(
					bookIsbn = bookInfo.getString("isbn"),
					bookTitle = bookInfo.getString("title"),
					bookSubtitle = bookInfo.getString("subTitle"),
					bookAuthor = bookInfo.getString("author"),
					bookDescription = bookInfo.getString("description"),
					bookImageUrl = bookInfo.getString("imageURL"),
					bookPublisher = bookInfo.getString("publisher"),
					bookContent = bookInfo.getString("content"),

					userInfoIndustryImportant = userInfo.getString("industry_important"),
					userInfoWorkImportant = userInfo.getString("work_important"),
					userInfoUserImportant = userInfo.getString("user_important"),
					userInfoPriority = userInfo.getString("priority"),
					userInfoPurchasedFlag = userInfo.getString("purchased_flag"),
					userInfoViewedFlag = userInfo.getString("viewed_flag"),

					bookInfoPurchased = bookShelf.getString("purchased"),
					bookInfoMemo = bookShelf.getString("memo"),

					readHistoriesViewStart = readHistories.getString("view_start"),
					readHistoriesViewEnd = readHistories.getString("view_end"),
					readHistoriesImpression = readHistories.getString("impression"),
					readHistoriesMemo = readHistories.getString("memo"),
					readHistoriesUnderstanding = readHistories.getString("understanding"),

					wishListMemo = wishList.getString("wishList_memo")

				)
				this.bookList.add(book)
			}
		}
	}

	override fun parseJSONArray(jsonArray: JSONArray) {
		for (i in 0 until jsonArray.length()) {
			val bookInfo = jsonArray.getJSONObject(i).getJSONObject("bookinfo")
			val userInfo = jsonArray.getJSONObject(i).getJSONObject("userinfo")
			val bookShelf = jsonArray.getJSONObject(i).getJSONObject("book_shelf")
			val readHistories =
				jsonArray.getJSONObject(i).getJSONArray("readHistories").getJSONObject(0)
			val wishList = jsonArray.getJSONObject(i).getJSONArray("wishList").getJSONObject(0)

			val book = BookInfo(
				bookIsbn = bookInfo.getString("isbn"),
				bookTitle = bookInfo.getString("title"),
				bookSubtitle = bookInfo.getString("sub_title"),
				bookAuthor = bookInfo.getString("author"),
				bookDescription = bookInfo.getString("description"),
				bookImageUrl = bookInfo.getString("image_url"),
				bookPublisher = bookInfo.getString("published_date"),
				bookContent = bookInfo.getString("content"),

				userInfoIndustryImportant = userInfo.getString("industry_important"),
				userInfoWorkImportant = userInfo.getString("work_important"),
				userInfoUserImportant = userInfo.getString("user_important"),
				userInfoPriority = userInfo.getString("priority"),
				userInfoPurchasedFlag = userInfo.getString("purchased_flag"),
				userInfoViewedFlag = userInfo.getString("viewed_flag"),

				bookInfoPurchased = bookShelf.getString("purchased"),
				bookInfoMemo = bookShelf.getString("memo"),

				readHistoriesViewStart = readHistories.getString("view_start"),
				readHistoriesViewEnd = readHistories.getString("view_end"),
				readHistoriesImpression = readHistories.getString("impression"),
				readHistoriesMemo = readHistories.getString("memo"),
				readHistoriesUnderstanding = readHistories.getString("understanding"),

				wishListMemo = wishList.getString("memo")
			)
			this.bookList.add(book)
		}
	}
}