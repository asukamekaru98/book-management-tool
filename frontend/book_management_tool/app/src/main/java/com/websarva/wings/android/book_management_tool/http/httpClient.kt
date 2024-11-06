package com.websarva.wings.android.book_management_tool.http

import android.util.Log
import okhttp3.HttpUrl
import okhttp3.HttpUrl.Companion.toHttpUrlOrNull
import okhttp3.Request
import okhttp3.RequestBody.Companion.toRequestBody
import okhttp3.ResponseBody
import java.io.IOException

/**
 * HTTPクライアントクラス
 * @param url URI
 */
class httpClient(private val url: String) {

	/**
	 * GETリクエストを送信する
	 * @return レスポンスボディ
	 */
	fun runGetRequest(): ResponseBody {

		Log.d("BookMgmtTool Access URI", this.url)

		val request = Request.Builder()
			.url(this.url)
			.build()

		return try {
			this.sendRequest(request)
		} catch (e: IOException) {
			throw e
		}
	}

	/**
	 * GETリクエストを送信する(クエリパラメータ付き)
	 * @param query クエリパラメータ
	 * @return レスポンスボディ
	 */
	fun runGetRequest(query: Map<String, String>): ResponseBody {
		val httpUriWithQuery: HttpUrl = createUriWithQuery(this.url, query)

		Log.d("BookMgmtTool Access URI", httpUriWithQuery.toString())

		val request: Request = Request.Builder()
			.url(httpUriWithQuery)
			.build()

		return try {
			this.sendRequest(request)
		} catch (e: IOException) {
			throw e
		}
	}

	/**
	 * POSTリクエストを送信する(クエリパラメータ無し)
	 * @return レスポンスボディ
	 */
	fun runPostRequest(body: String): ResponseBody {

		Log.d("BookMgmtTool Access URI", this.url)

		val request = Request.Builder()
			.url(this.url)
			.post(body.toRequestBody())
			.build()

		return try {
			this.sendRequest(request)
		} catch (e: IOException) {
			throw e
		}
	}


	/**
	 * POSTリクエストを送信する(クエリパラメータ有り)
	 * @param body リクエストボディ
	 * @param query クエリパラメータ
	 * @return レスポンスボディ
	 */
	fun runPostRequest(body: String, query: Map<String, String>): ResponseBody {
		val httpUriWithQuery: HttpUrl = createUriWithQuery(this.url, query)

		Log.d("BookMgmtTool Access URI", httpUriWithQuery.toString())

		val request = Request.Builder()
			.url(httpUriWithQuery)
			.post(body.toRequestBody())
			.build()

		return try {
			this.sendRequest(request)
		} catch (e: IOException) {
			throw e
		}
	}

	/**
	 * PUTリクエストを送信する
	 * @param body リクエストボディ
	 * @param query クエリパラメータ
	 * @return レスポンスボディ
	 */
	fun runPutRequest(body: String, query: Map<String, String>): ResponseBody {
		val httpUriWithQuery: HttpUrl = createUriWithQuery(this.url, query)

		Log.d("BookMgmtTool Access URI", httpUriWithQuery.toString())

		val request = Request.Builder()
			.url(httpUriWithQuery)
			.put(body.toRequestBody())
			.build()

		return try {
			this.sendRequest(request)
		} catch (e: IOException) {
			throw e
		}
	}

	/**
	 * DELETEリクエストを送信する
	 * @return レスポンスボディ
	 */
	fun runDeleteRequest(): ResponseBody {

		val request = Request.Builder()
			.url(this.url)
			.delete()
			.build()

		return try {
			this.sendRequest(request)
		} catch (e: IOException) {
			throw e
		}
	}

	/**
	 * DELETEリクエストを送信する
	 * @param query クエリパラメータ
	 * @return レスポンスボディ
	 */
	fun runDeleteRequest(query: Map<String, String>): ResponseBody {
		val httpUriWithQuery: HttpUrl = createUriWithQuery(this.url, query)

		Log.d("BookMgmtTool Access URI", httpUriWithQuery.toString())

		val request = Request.Builder()
			.url(httpUriWithQuery)
			.delete()
			.build()

		return try {
			this.sendRequest(request)
		} catch (e: IOException) {
			throw e
		}
	}

	/**
	 * URIにクエリパラメータを付与する
	 * @param uri URI
	 * @param query クエリパラメータ
	 * @return URI
	 */
	private fun createUriWithQuery(
		uri: String, query: Map<String, String>
	): HttpUrl {
		val httpUrl: HttpUrl.Builder = uri.toHttpUrlOrNull()!!.newBuilder()

		query.forEach { (key, value) ->
			httpUrl.addQueryParameter(key, value)
		}

		return httpUrl.build()
	}

	/**
	 * リクエストを送信する
	 * @param request リクエスト
	 * @return レスポンスボディ
	 */
	private fun sendRequest(request: Request): ResponseBody {

		return try {
			// リクエスト送信後、レスポンスボディを取得
			UriSender(request).apply {
				sendRequest()
			}.getResponseBody()
		} catch (e: IOException) {
			throw e
		}

	}
}