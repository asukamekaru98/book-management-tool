package com.websarva.wings.android.book_management_tool.api

data class ApiResponse(var body:String, var code:Int) {

	fun getResponseBody(): String {
		return body
	}

	fun getResponseCode(): Int {
		return code
	}
}
