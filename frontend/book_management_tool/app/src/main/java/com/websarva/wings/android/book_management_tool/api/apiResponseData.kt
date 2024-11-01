package com.websarva.wings.android.book_management_tool.api

import org.json.JSONObject

data class ApiResponse(var json:JSONObject, var code:Int) {

	fun getJSONObject(): JSONObject {
		return json
	}

	fun getResponseCode(): Int {
		return code
	}
}
