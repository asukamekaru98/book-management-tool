package com.websarva.wings.android.book_management_tool.api

import android.util.Log
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.runBlocking
import kotlinx.coroutines.withContext
import org.json.JSONObject
import java.io.BufferedReader
import java.io.InputStreamReader
import java.net.HttpURLConnection
import java.net.URL

class ApiRequestSender {

	suspend fun SendRequest(request: i_ApiRequestCreator):ApiResponse {
		request.CreateRequest()
		val method = request.GetMethod()
		val uri = request.GetURI()
		val body = request.GetBody()

		require(method in listOf("GET", "POST", "PUT", "DELETE")) {
			"Invalid method"
		}

		require(uri.isNotEmpty()) {
			"Invalid URI"
		}

		//runBlocking{
		//CoroutineScope(Dispatchers.IO).launch {
		return if (body.isEmpty()) {
				accessAPI(
					method,
					uri,
					listOf("{ \"color\": \"green\", \"kana\": \"みどり\", \"code\": { \"rgba\": [0,255,0,1], \"hex\": \"#0F0\" } }")
				)
			} else {
				accessAPI(method, uri, body)
			}
		//}

	}

	private suspend fun accessAPI(
		methodStr: String,
		uriStr: String,
		body: List<String>
	):ApiResponse {

		val apiResponse: ApiResponse = ApiResponse(JSONObject("{message:{message:error}}"), 0)

		//Todo: ロード中のアニメーションを表示する

		withContext(Dispatchers.IO) {
		//CoroutineScope(Dispatchers.IO).launch {
		//runBlocking {
			try {
				Log.d("BookMgmtTool Access Method", methodStr)
				Log.d("BookMgmtTool Access URI", uriStr)

				val uri = URL(uriStr)
				val connection = uri.openConnection() as HttpURLConnection
				connection.doOutput = false
				connection.doInput = true
				connection.readTimeout = 0
				connection.connectTimeout = 0
				connection.requestMethod = methodStr

				connection.connect()

				apiResponse.code = connection.responseCode
				val responseBody = BufferedReader(InputStreamReader(connection.inputStream)).use {
					it.readText()
				}

				apiResponse.json = JSONObject(responseBody)

				Log.d("BookMgmtTool API Get Code", apiResponse.code.toString())
				Log.d("BookMgmtTool API Get Body", apiResponse.json.toString())

				connection.disconnect() // 切断

			} catch (e: Exception) {
				Log.d("BookMgmtTool Exc Error", e.toString())
				//throw Exception("Error:")
			}
		}

		return apiResponse
	}
}