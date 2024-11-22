package com.websarva.wings.android.book_management_tool.abstruct

abstract class AbstractAPIBodyCreator {

	abstract fun get(): String

	protected fun createBody(body: Map<String, String>): String {
		val jsonBody = StringBuilder("{")

		body.forEach { (key, value) ->
			jsonBody.append("\"$key\":\"$value\",")
		}

		if (jsonBody.length > 1) {
			jsonBody.setLength(jsonBody.length - 1) // 最後のカンマを削除
		}

		jsonBody.append("}")

		return jsonBody.toString()
	}
}
