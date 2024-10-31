package com.websarva.wings.android.book_management_tool.api

import android.util.Log
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.runBlocking
import org.json.JSONArray
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
		method: String,
		uri: String,
		body: List<String>
	) {

		//CoroutineScope(Dispatchers.IO).launch {
		runBlocking {
			try {
				println("method: $method")
				println("uri: $uri")
				val connection = (URL(uri).openConnection() as HttpURLConnection).apply {
					requestMethod = method
					doOutput = true
					setRequestProperty("Content-Type", "application/json; utf-8")
					setRequestProperty("Accept", "application/json")
				}
				println("b")
				OutputStreamWriter(connection.outputStream).use {
					it.write(body.joinToString(""))
				}
				println("c")
				connection.disconnect() // 切断
				println("d")
				apiResponse.body = connection.responseMessage
				apiResponse.code = connection.responseCode
				println("e")
			} catch (e: Exception) {
				Log.d("Error", e.toString())
				//throw Exception("Error:")
			}
		}
	}
}