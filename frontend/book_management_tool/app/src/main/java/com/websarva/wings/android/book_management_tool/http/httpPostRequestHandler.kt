package com.websarva.wings.android.book_management_tool.http

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIHandler
import okhttp3.OkHttpClient
import java.io.IOException

class HTTPPostRequestHandler(
	private val uri: String,
	private val body: String,
	private val query: Map<String, String>
) : AbstractAPIHandler() {

	private val okHttpClient = OkHttpClient.Builder()
		.addInterceptor(RetryInterceptor()) // リトライ処理
		.build()

	override fun createRequestBody(): String {

		// リクエストボディ無し
		return body
	}

	override fun createRequestQuery(): Map<String, String> {
		// クエリパラメータ無し
		return query
	}

	override suspend fun sendRequest(body: String, query: Map<String, String>?): String {
		return try {
			HttpClient(uri, okHttpClient).runPostRequest(body, query)
		} catch (e: IOException) {
			throw e
		}
	}
}