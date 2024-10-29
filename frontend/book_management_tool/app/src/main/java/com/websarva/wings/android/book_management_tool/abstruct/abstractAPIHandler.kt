package com.websarva.wings.android.book_management_tool.abstruct

import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import com.websarva.wings.android.book_management_tool.i_f.i_ApiResponseParser


abstract class AbstractAPIHandler
{
	fun Execute() {
		val request = CreateRequest()
		val response = SendRequest(request)
		return ParseResponse(response)
	}

	protected abstract fun CreateRequest(): i_ApiRequestCreator
	protected abstract fun SendRequest(request:i_ApiRequestCreator): i_ApiResponseParser
	protected abstract fun ParseResponse(response:i_ApiResponseParser)

}