package com.websarva.wings.android.book_management_tool.http

import okhttp3.HttpUrl
import okhttp3.HttpUrl.Companion.toHttpUrlOrNull
import okhttp3.Request


/**
 * URIのクエリパラメータを生成するクラス
 */
class UriWithQueryCreator(
	private val uri: String,
	private val query: Map<String, String>

) {

	/*	fun createQuery():HttpUrl.Builder
		{
			val urlBuilder: HttpUrl.Builder = this.uri.toHttpUrlOrNull()!!.newBuilder()

			query.forEach { (key, value) ->
				urlBuilder.addQueryParameter(key, value)
			}

			return urlBuilder
		}
	*/
	/*
	fun createUriWithQuery(): Request {
		val httpUrl: HttpUrl.Builder = this.uri.toHttpUrlOrNull()!!.newBuilder()

		query.forEach { (key, value) ->
			httpUrl.addQueryParameter(key, value)
		}

		return Request.Builder().url(httpUrl.build()).build()
	}
*/

}