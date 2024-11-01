package com.websarva.wings.android.book_management_tool.abstruct

import com.websarva.wings.android.book_management_tool.api.ApiResponse
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.i_f.i_ApiResponseParser
import org.json.JSONArray
import org.json.JSONObject

abstract class abstructAPIResponseParser :i_ApiResponseParser{

	protected var jsonObject: JSONObject = JSONObject("{\"message\":{\"message\":\"JSONObject is not support\"}}")
	protected var jsonArray: JSONArray = JSONArray("[{\"message\":\"JSONArray is not support\"}]")

	abstract override fun ParseResponse(apiResponse: ApiResponse)

	protected fun parseBody(body: String) {

		if (body.startsWith("[")) {
			//NOTE: [ で始まる場合はJSONArray
			jsonArray = JSONArray(body)

			this.parseJSONArray()

		} else if(body.startsWith("{")) {
			//NOTE: { で始まる場合はJSONObject
			jsonObject = JSONObject(body)

			this.parseJSONObject()
		}
	}

	abstract fun parseJSONObject(): MutableList<BookInfo>
	abstract fun parseJSONArray(): MutableList<BookInfo>

}