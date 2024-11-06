package com.websarva.wings.android.book_management_tool.http

import okhttp3.OkHttpClient
import okhttp3.Request
import okhttp3.ResponseBody
import okhttp3.ResponseBody.Companion.toResponseBody
import java.io.IOException

class UriSender(private val request: Request) {

	private var responseBody: ResponseBody = "error".toResponseBody()

	fun sendRequest() {

		val okHttpClient = OkHttpClient.Builder()
			.addInterceptor(RetryInterceptor()) // リトライ処理
			.build()

		okHttpClient.newCall(request).execute().use { response ->

			if (!response.isSuccessful) {
				throw IOException("Unexpected code $response") // 失敗
			}

			this.responseBody = response.body!!
		}
	}

	fun getResponseBody(): ResponseBody = this.responseBody

}