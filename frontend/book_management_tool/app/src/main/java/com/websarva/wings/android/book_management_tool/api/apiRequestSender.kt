package com.websarva.wings.android.book_management_tool.api

import android.util.Log
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.runBlocking
import org.json.JSONArray
import java.io.BufferedReader
import java.io.InputStreamReader
import java.io.OutputStreamWriter
import java.net.HttpURLConnection
import java.net.URL

class ApiRequestSender {

	var apiResponse: ApiResponse = ApiResponse("{ \"message\": { \"message\": \"error\"}}", 200)

	fun SendRequest(request: i_ApiRequestCreator): ApiResponse {
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

		if (body.isEmpty()) {
			accessAPI(method, uri, listOf("{ \"color\": \"green\", \"kana\": \"みどり\", \"code\": { \"rgba\": [0,255,0,1], \"hex\": \"#0F0\" } }"))
		} else {
			accessAPI(method, uri, body)
		}
		println("f")
		return apiResponse
	}

	private fun accessAPI(
		methodStr: String,
		uriStr: String,
		body: List<String>
	) {

		//Todo: ロード中のアニメーションを表示する

		CoroutineScope(Dispatchers.IO).launch {
		//runBlocking {
			try {
				println("hogehoge method: $methodStr")
				println("hogehoge uri: $uriStr")

				val url = URL(uriStr)
				val connection = url.openConnection() as HttpURLConnection
				connection.doOutput = false
				connection.doInput = true
				connection.readTimeout = 0
				connection.connectTimeout = 0
				connection.requestMethod = methodStr

				println("hogehoge before connection")

				connection.connect()

				println("hogehoge after connection")

				apiResponse.code = connection.responseCode

				println("hogehoge uri: $apiResponse ")

				apiResponse.body = BufferedReader(InputStreamReader(connection.inputStream)).use {
					it.readText()
				}
				//OutputStreamWriter(connection.outputStream).use {
				//	it.write(body.joinToString(""))
				//}

				println("hogehoge after body")

				connection.disconnect() // 切断
				//apiResponse.body = connection.responseMessage
				//apiResponse.code = connection.responseCode
			} catch (e: Exception) {
				Log.d("hogehoge Error", e.toString())
				//throw Exception("Error:")
			}
		}
	}
}