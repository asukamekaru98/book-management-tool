package com.websarva.wings.android.book_management_tool.http

import okhttp3.OkHttpClient
import okhttp3.Request
import java.io.IOException


class httpClient(private val url: String) {

	private val client = OkHttpClient.Builder()
		.addInterceptor(RetryInterceptor())
		.build()

	fun get() {
		val request = Request.Builder()
			.url(this.url)
			.build()


		client.newCall(request).execute().use { response ->

			if (!response.isSuccessful){
				throw IOException("Unexpected code $response") // 失敗
			}

			for ((name, value) in response.headers) {
				println("$name: $value")
			}

			println(response.body!!.string())
		}
	}




}