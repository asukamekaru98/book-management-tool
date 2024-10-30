package com.websarva.wings.android.book_management_tool.api

class ApiUriCreator(private val uri: String) {

    private val queryParameters = mutableListOf<String>()

	/**
	 * URIを取得するメソッド
	 * @return URI
	 * */
    fun GetURI(): String {
        return if (queryParameters.isNotEmpty()) {
            "$uri?" + queryParameters.joinToString("&")
        } else {
            uri
        }
    }

	/**
	 * クエリパラメータを設定するメソッド
	 */
    fun SetQueryParameter(query: String) {
        queryParameters.add(query)
    }
}