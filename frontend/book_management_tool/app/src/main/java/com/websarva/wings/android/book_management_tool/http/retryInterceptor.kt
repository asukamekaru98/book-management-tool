package com.websarva.wings.android.book_management_tool.http

import android.util.Log
import com.websarva.wings.android.book_management_tool.time.getCurrentTime
import okhttp3.Interceptor

/**
 * リトライインターセプタークラス
 */
class RetryInterceptor:Interceptor {

	/**
	 * インターセプト処理
	 *
	 * @param chain チェーン
	 * @return レスポンス
	 */
	override fun intercept(chain: Interceptor.Chain): okhttp3.Response {

		val currentTime = getCurrentTime("yyyy/MM/dd HH:mm:ss")
		val request = chain.request()

		var retryCount = 0
		var response = chain.proceed(request) // 最初のリクエストを行う

		// リクエストに失敗した場合、リトライを行う
		while (!response.isSuccessful && retryCount < 3) {
			retryCount++

			Log.d("BookMgmtTool", "リトライ:${retryCount}回目（${currentTime.GetTime()}）")

			response.close()
			response = chain.proceed(request)
		}
		return response
	}
}