package com.websarva.wings.android.book_management_tool.http

import android.util.Log
import com.websarva.wings.android.book_management_tool.apiResponseParser.ApiResponseCodeParser
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext
import okhttp3.HttpUrl
import okhttp3.HttpUrl.Companion.toHttpUrlOrNull
import okhttp3.OkHttpClient
import okhttp3.Request
import okhttp3.RequestBody.Companion.toRequestBody
import okhttp3.Response
import okhttp3.ResponseBody
import java.io.IOException

/**
 * HTTPクライアントクラス
 * @param url URI
 */
class HttpClient(
	private val url: String,
	private val okHttpClient: OkHttpClient
) {

	/**
	 * GETリクエストを送信する(クエリパラメータ付き)
	 * @param query クエリパラメータ
	 * @return レスポンスボディ
	 */
	suspend fun runGetRequest(query: Map<String, String>? = null): String {

		val httpURI =
			query?.let {
				createUriWithQuery(this.url, it)
			} ?: url.toHttpUrlOrNull()!!

		Log.d("BookMgmtTool Access URI", httpURI.toString())

		val request: Request = Request.Builder()
			.url(httpURI)
			.build()

		return withContext(Dispatchers.IO) {
			try {
				sendRequest(request)
			} catch (e: IOException) {
				throw e
			}
		}
	}

	/**
	 * POSTリクエストを送信する(クエリパラメータ有り)
	 * @param body リクエストボディ
	 * @param query クエリパラメータ
	 * @return レスポンスボディ
	 */
	fun runPostRequest(body: String, query: Map<String, String>? = null): String {

		val httpURI =
			query?.let {
				createUriWithQuery(this.url, it)
			} ?: url.toHttpUrlOrNull()!!

		Log.d("BookMgmtTool Access URI", httpURI.toString())

		val request = Request.Builder()
			.url(httpURI)
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
	fun runPutRequest(body: String, query: Map<String, String>? = null): String {
		val httpURI =
			query?.let {
				createUriWithQuery(this.url, it)
			} ?: url.toHttpUrlOrNull()!!

		Log.d("BookMgmtTool Access URI", httpURI.toString())

		val request = Request.Builder()
			.url(httpURI)
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
	 * @param query クエリパラメータ
	 * @return レスポンスボディ
	 */
	fun runDeleteRequest(query: Map<String, String>? = null): String {
		val httpURI =
			query?.let {
				createUriWithQuery(this.url, it)
			} ?: url.toHttpUrlOrNull()!!

		Log.d("BookMgmtTool Access URI", httpURI.toString())

		val request = Request.Builder()
			.url(httpURI)
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
	private fun sendRequest(request: Request): String {

		return this.okHttpClient.newCall(request).execute().use { response ->

			if (!response.isSuccessful) {
				throw IOException("Unexpected code $response") // 失敗
			}

			try{
				ApiResponseCodeParser(response.code).parse()
			}catch (e: Exception){
				throw e
			}

			// CAUTION: response.body!!.string()は一度しか呼び出せない
			val body = response.body!!.string()

			Log.d("BookMgmtTool Response", body)

			body
		}
	}
}