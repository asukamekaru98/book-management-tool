package com.websarva.wings.android.book_management_tool.api

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIHandler
import com.websarva.wings.android.book_management_tool.apiBody.BmtAPIBookShelfRequestBodyCreator
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.http.HTTPGetRequestHandler
import com.websarva.wings.android.book_management_tool.http.HttpClient
import com.websarva.wings.android.book_management_tool.http.RetryInterceptor
import okhttp3.OkHttpClient
import okhttp3.Response
import java.io.IOException

class BmtApiGetOneBookShelf(
	private val uri: String,
	private val isbn: String
) : HTTPGetRequestHandler(uri) {

	override fun createRequestQuery(): Map<String, String> {
		// クエリパラメータ無し
		return mapOf("isbn" to isbn)
	}
}