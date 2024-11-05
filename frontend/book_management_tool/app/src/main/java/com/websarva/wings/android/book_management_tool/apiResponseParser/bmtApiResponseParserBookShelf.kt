package com.websarva.wings.android.book_management_tool.apiResponseParser

import android.net.http.HttpException
import android.util.Log
import com.websarva.wings.android.book_management_tool.abstruct.abstructAPIResponseParser
import com.websarva.wings.android.book_management_tool.api.ApiResponse
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData
import com.websarva.wings.android.book_management_tool.i_f.i_ApiResponseParser
import org.json.JSONArray
import org.json.JSONObject

class bmtApiResponseParserBookShelf : abstructAPIResponseParser() {

	val bookList: MutableList<BookInfo> = mutableListOf()
	var message: String = "error"

	override fun parseResponse(apiResponse: ApiResponse) {
		// 本棚のAPIレスポンスを解析

		//val responseBody = apiResponse.getResponseBody()
		//Log.d("ResponseBody", responseBody) // デバッグログを追加

		if(apiResponse.code >= 400){
			throw HttpException(apiResponse.code)
		}

		parseBody(apiResponse.body)


		// 本棚のAPIレスポンスを解析
		val apiData = BookManagementToolApiData(
			responseCode = apiResponse.code,
			message = this.message,
			bookList = this.bookList
		)


	}

	override fun getResponseResult(): Any {
		TODO("Not yet implemented")
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
					book_isbn = bookInfo.getString("isbn"),
					book_title = bookInfo.getString("title"),
					book_subTitle = bookInfo.getString("subTitle"),
					book_author = bookInfo.getString("author"),
					book_description = bookInfo.getString("description"),
					book_imageURL = bookInfo.getString("imageURL"),
					book_publisher = bookInfo.getString("publisher"),
					book_content = bookInfo.getString("content"),

					userInfo_industry_important = userInfo.getString("industry_important"),
					userInfo_work_important = userInfo.getString("work_important"),
					userInfo_user_important = userInfo.getString("user_important"),
					userInfo_priority = userInfo.getString("priority"),
					userInfo_purchased_flag = userInfo.getString("purchased_flag"),
					userInfo_viewed_flag = userInfo.getString("viewed_flag"),

					bookInfo_purchased = bookShelf.getString("purchased"),
					bookInfo_memo = bookShelf.getString("memo"),

					readHistories_view_start = readHistories.getString("view_start"),
					readHistories_view_end = readHistories.getString("view_end"),
					readHistories_impression = readHistories.getString("impression"),
					readHistories_memo = readHistories.getString("memo"),
					readHistories_understanding = readHistories.getString("understanding"),

					wishList_memo = wishList.getString("wishList_memo")

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
				book_isbn = bookInfo.getString("isbn"),
				book_title = bookInfo.getString("title"),
				book_subTitle = bookInfo.getString("sub_title"),
				book_author = bookInfo.getString("author"),
				book_description = bookInfo.getString("description"),
				book_imageURL = bookInfo.getString("image_url"),
				book_publisher = bookInfo.getString("published_date"),
				book_content = bookInfo.getString("content"),

				userInfo_industry_important = userInfo.getString("industry_important"),
				userInfo_work_important = userInfo.getString("work_important"),
				userInfo_user_important = userInfo.getString("user_important"),
				userInfo_priority = userInfo.getString("priority"),
				userInfo_purchased_flag = userInfo.getString("purchased_flag"),
				userInfo_viewed_flag = userInfo.getString("viewed_flag"),

				bookInfo_purchased = bookShelf.getString("purchased"),
				bookInfo_memo = bookShelf.getString("memo"),

				readHistories_view_start = readHistories.getString("view_start"),
				readHistories_view_end = readHistories.getString("view_end"),
				readHistories_impression = readHistories.getString("impression"),
				readHistories_memo = readHistories.getString("memo"),
				readHistories_understanding = readHistories.getString("understanding"),

				wishList_memo = wishList.getString("memo")
			)
			this.bookList.add(book)
		}
	}
}