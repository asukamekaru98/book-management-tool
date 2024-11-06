package com.websarva.wings.android.book_management_tool.api

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIHandler
import com.websarva.wings.android.book_management_tool.apiBody.BmtAPIBookShelfRequestBodyCreator
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.http.HttpClient
import com.websarva.wings.android.book_management_tool.http.RetryInterceptor
import okhttp3.OkHttpClient
import okhttp3.Response
import java.io.IOException

class BmtApiGetAllBookShelf(
	private val uri: String,
	private val bookInfo:BookInfo
	) : AbstractAPIHandler() {

	private val okHttpClient = OkHttpClient.Builder()
		.addInterceptor(RetryInterceptor()) // リトライ処理
		.build()

	override fun createRequestBody(): String {

		return BmtAPIBookShelfRequestBodyCreator(
			bookInfo.userInfoIndustryImportant,
			bookInfo.userInfoWorkImportant,
			bookInfo.userInfoUserImportant,
			bookInfo.userInfoPriority,
			bookInfo.userInfoPurchasedFlag,
			bookInfo.userInfoViewedFlag,
			bookInfo.bookInfoPurchased,
			bookInfo.bookInfoMemo
		).get()
	}

	override suspend fun sendRequest(request: String): Response {
		return try {
			HttpClient(uri, okHttpClient).runGetRequest()
		} catch (e: IOException) {
			throw e
		}
	}
}