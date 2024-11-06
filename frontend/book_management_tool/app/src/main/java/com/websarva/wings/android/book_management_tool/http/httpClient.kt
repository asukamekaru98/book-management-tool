package com.websarva.wings.android.book_management_tool.http

import okhttp3.HttpUrl
import okhttp3.HttpUrl.Companion.toHttpUrlOrNull
import okhttp3.OkHttpClient
import okhttp3.Request
import okhttp3.RequestBody
import okhttp3.ResponseBody
import java.io.IOException


class httpClient(private val url: String) {

	private val client = OkHttpClient.Builder()
		.addInterceptor(RetryInterceptor()) // リトライ処理
		.build()

	/**
	 * GETリクエストを送信する
	 * @return レスポンスボディ
	 */
	fun runGetRequest():ResponseBody {

		val request = Request.Builder()
			.url(this.url)
			.build()


		client.newCall(request).execute().use { response ->

			if (!response.isSuccessful){
				throw IOException("Unexpected code $response") // 失敗
			}

			return response.body!!
		}
	}

	/**
	 * GETリクエストを送信する(クエリパラメータ付き)
	 * @param query クエリパラメータ
	 * @return レスポンスボディ
	 */
	fun runGetRequest(query: Map<String, String>):ResponseBody {
		val urlBuilder: HttpUrl.Builder = url.toHttpUrlOrNull()!!.newBuilder()

		val params: MutableMap<String, String> = HashMap()

		query.forEach { (key, value) ->
			urlBuilder.addQueryParameter(key, value)
		}

		val request = Request.Builder()
			.url(url)
			.build()

		client.newCall(request).execute().use { response ->

			if (!response.isSuccessful){
				throw IOException("Unexpected code $response") // 失敗
			}

			return response.body!!
		}
	}

	/**
	 * POSTリクエストを送信する
	 * @return レスポンスボディ
	 */
	fun runPostRequest(body: RequestBody,query: Map<String, String>):ResponseBody {

		val request = Request.Builder()
			.url(this.url)
			.post(null)
			.build()
	}

	@Throws(Exception::class)
	fun postJson() {
		val url = "http://localhost:8080/dog_json"
		val dog = Dog(100, "pome")
		val requestBody: RequestBody = create(JSON, mapper.writeValueAsString(dog))
		val request: Request = Builder()
			.url(url)
			.post(requestBody)
			.build()
		val okHttpClient: OkHttpClient = Builder()
			.build()
		okHttpClient.newCall(request).execute().use { response ->
			val responseCode = response.code()
			println("responseCode: $responseCode")
			if (!response.isSuccessful) {
				println("error!!")
			}
			if (response.body() != null) {
				println("body: " + response.body()!!.string())
			}
		}
	}

	/**
	 * POSTリクエストを送信する
	 * @param body リクエストボディ
	 * @return レスポンスボディ
	 */
	fun runPostRequest(body: String):ResponseBody {
		//var responseBody:ResponseBody = ResponseBody.create(null, "default response")

		val request = Request.Builder()
			.url(this.url)
			.post(body.toRequestBody())
			.build()
	}

	/**
	 * PUTリクエストを送信する
	 * @return レスポンスボディ
	 */
	fun runPutRequest():ResponseBody {
		//var responseBody:ResponseBody = ResponseBody.create(null, "default response")

		val request = Request.Builder()
			.url(this.url)
			.put(null)
			.build()
	}

	/**
	 * PUTリクエストを送信する
	 * @param body リクエストボディ
	 * @return レスポンスボディ
	 */
	fun runPutRequest(body: String):ResponseBody {
		//var responseBody:ResponseBody = ResponseBody.create(null, "default response")

		val request = Request.Builder()
			.url(this.url)
			.put(body.toRequestBody())
			.build()
	}

	/**
	 * DELETEリクエストを送信する
	 * @return レスポンスボディ
	 */
	fun runDeleteRequest():ResponseBody {
		//var responseBody:ResponseBody = ResponseBody.create(null, "default response")

		val request = Request.Builder()
			.url(this.url)
			.delete(null)
			.build()
	}

	/**
	 * DELETEリクエストを送信する
	 * @param body リクエストボディ
	 * @return レスポンスボディ
	 */
	fun runDeleteRequest(body: String):ResponseBody {
		//var responseBody:ResponseBody = ResponseBody.create(null, "default response")

		val request = Request.Builder()
			.url(this.url)
			.delete(body.toRequestBody())
			.build()
	}


}