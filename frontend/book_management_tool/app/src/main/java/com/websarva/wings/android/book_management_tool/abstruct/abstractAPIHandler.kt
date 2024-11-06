package com.websarva.wings.android.book_management_tool.abstruct

import com.websarva.wings.android.book_management_tool.api.ApiResponse
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import com.websarva.wings.android.book_management_tool.i_f.i_ApiResponseParser
import okhttp3.Response
import org.json.JSONObject

/**
 * APIハンドラの抽象クラス
 * APIハンドラの基本的な機能を提供する
 */
abstract class AbstractAPIHandler
{
	suspend fun execute():Response {
		val request = createRequestBody()

		return sendRequest(request)
	}

	/**
	 * リクエストを生成する
	 * @return i_ApiRequestCreator
	 */
	protected abstract fun createRequestBody(): String

	/**
	 * リクエストを送信する
	 * @param request i_ApiRequestCreator
	 * @return i_ApiResponseParser
	 */
	protected abstract suspend fun sendRequest(request:String): Response

}