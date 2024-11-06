package com.websarva.wings.android.book_management_tool.abstruct

abstract class AbstractAPIBodyCreator {

	abstract fun get(): String

	protected fun createBody(body: Map<String, String>): String {
		var bodyString = ""

		body.forEach { (key, value) ->
			bodyString += "\"{$key}\":\"{$value}\","
		}

		return bodyString
	}
}