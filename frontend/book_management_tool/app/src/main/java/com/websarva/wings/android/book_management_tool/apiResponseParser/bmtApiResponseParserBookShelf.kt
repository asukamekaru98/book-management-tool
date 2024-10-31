package com.websarva.wings.android.book_management_tool.apiResponseParser

import android.util.Log
import com.websarva.wings.android.book_management_tool.api.ApiResponse
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData
import com.websarva.wings.android.book_management_tool.i_f.i_ApiResponseParser
import org.json.JSONObject

class bmtApiResponseParserBookShelf : i_ApiResponseParser {
	override fun ParseResponse(apiResponse: ApiResponse) {
		// 本棚のAPIレスポンスを解析

		Log.d("AndroidRuntime2", apiResponse.getResponseBody())

		val apiBody = JSONObject(apiResponse.getResponseBody())

		val bookList: MutableList<BookInfo> = mutableListOf()

		if (apiBody.has("bookList")) {

			for (i in 0 until apiBody.getJSONArray("bookList").length()) {
				if (apiBody.has("bookList")) {
					val bookInfo = apiBody.getJSONArray("bookInfo").getJSONObject(i)
					val userInfo = apiBody.getJSONArray("userInfo").getJSONObject(i)
					val bookShelf = apiBody.getJSONArray("userInfo").getJSONObject(i)
					val readHistories = apiBody.getJSONArray("readHistories").getJSONObject(i)
					val wishList = apiBody.getJSONArray("wishList").getJSONObject(i)
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
					bookList.add(book)
				}
			}
		}

		// 本棚のAPIレスポンスを解析
		val apiData = BookManagementToolApiData(
			responseCode = apiResponse.getResponseCode(),
			message =
			if (apiBody.has("message")) {
				apiBody.getJSONObject("message").getString("message")
			} else {
				""
			},
			bookList = bookList
		)


	}
}