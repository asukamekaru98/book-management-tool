package com.websarva.wings.android.book_management_tool.abstruct

import com.websarva.wings.android.book_management_tool.api.ApiResponse
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import com.websarva.wings.android.book_management_tool.i_f.i_ApiResponseParser


abstract class AbstractAPIHandler
{
	protected var responseBody : String = ""
	protected var responseCode : Int = 0

	fun Execute() {
		val request = CreateRequest()
		val response = SendRequest(request)
		println(response)
		ParseResponse(response)
	}

	fun GetResponseResult(): ApiResponse {
		return ApiResponse(responseBody,responseCode)
	}

	/**
	 * リクエストを生成する
	 * @return i_ApiRequestCreator
	 */
	protected abstract fun CreateRequest(): i_ApiRequestCreator

	/**
	 * リクエストを送信する
	 * @param request i_ApiRequestCreator
	 * @return i_ApiResponseParser
	 */
	protected abstract fun SendRequest(request:i_ApiRequestCreator): ApiResponse

	/**
	 * レスポンスを解析する
	 * レスポンスボディとレスポンスコードを取得する
	 * @param response i_ApiResponseParser
	 */
	protected abstract fun ParseResponse(response:ApiResponse)


}