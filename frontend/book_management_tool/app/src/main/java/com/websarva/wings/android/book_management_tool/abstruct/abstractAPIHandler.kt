package com.websarva.wings.android.book_management_tool.abstruct

import com.websarva.wings.android.book_management_tool.api.ApiResponse
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import com.websarva.wings.android.book_management_tool.i_f.i_ApiResponseParser
import org.json.JSONObject

/**
 * APIハンドラの抽象クラス
 * APIハンドラの基本的な機能を提供する
 */
abstract class AbstractAPIHandler
{
	protected var responseJSON : MutableList<BookInfo> = mutableListOf()
	protected var responseCode : Int = 0

	suspend fun Execute() {
		val request = CreateRequest()

		val response = SendRequest(request)

		ParseResponse(response)
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
	protected abstract suspend fun SendRequest(request:i_ApiRequestCreator):ApiResponse

	/**
	 * レスポンスを解析する
	 * レスポンスボディとレスポンスコードを取得する
	 * @param response i_ApiResponseParser
	 */
	protected abstract fun ParseResponse(response:ApiResponse)

	/**
	 * レスポンス結果を取得する
	 * @return Any
	 */
	protected abstract fun GetResponseResult():Any
}