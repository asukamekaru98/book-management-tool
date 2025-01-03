package com.websarva.wings.android.book_management_tool.http

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIHandler
import okhttp3.OkHttpClient
import java.io.IOException

/**
 * このクラスは、HTTP GETリクエストを送信するためのクラスです。
 * GETは、リソースの取得を行うためのメソッドです。
 */
open class HTTPGetRequestHandler(
	private val uri: String
) : AbstractAPIHandler() {

	private val okHttpClient = OkHttpClient.Builder()
		.addInterceptor(RetryInterceptor()) // リトライ処理
		.build()

	override fun createRequestBody(): String {

		// リクエストボディ無し
		return ""
	}

	override fun createRequestQuery(): Map<String, String> {
		// クエリパラメータ無し
		return mapOf()
	}

	override suspend fun sendRequest(body:String,query: Map<String, String>?): String {
		return try {
			HttpClient(uri, okHttpClient).runGetRequest(query)
		} catch (e: IOException) {
			throw e
		}
	}
}