package com.websarva.wings.android.book_management_tool.api

data class ApiResponse(val body:String,val code:Int) {

	fun getResponseBody(): String {
		return body
	}

	fun getResponseCode(): Int {
		return code
	}
}
