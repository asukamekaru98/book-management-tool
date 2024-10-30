package com.websarva.wings.android.book_management_tool.api

import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import java.io.OutputStreamWriter
import java.net.HttpURLConnection
import java.net.URL

class ApiRequestSender {

	fun SendRequest(request: i_ApiRequestCreator): ApiResponse {
		val method = request.GetMethod()
		val uri = request.GetURI()
		val body = request.GetBody()

		require(method in listOf("GET", "POST", "PUT", "DELETE")) {
			"Invalid method"
		}

		require(uri.isNotEmpty()) {
			"Invalid URI"
		}

		return if (body.isEmpty()) {
			accessAPI(method, uri)
		} else {
			accessAPI(method, uri, body)
		}
	}

	private fun accessAPI(
		method: String,
		uri: String,
		body: List<String> = emptyList()
	): ApiResponse {

		lateinit var apiResponse: ApiResponse

		CoroutineScope(Dispatchers.IO).launch {
			try {
				val connection = (URL(uri).openConnection() as HttpURLConnection).apply {
					requestMethod = method
					doOutput = true
					setRequestProperty("Content-Type", "application/json; utf-8")
					setRequestProperty("Accept", "application/json")
				}

				OutputStreamWriter(connection.outputStream).use {
					it.write(body.joinToString(""))
				}

				apiResponse = ApiResponse(connection.responseMessage, connection.responseCode)

				connection.disconnect() // 切断

			} catch (e: Exception) {
				throw Exception("Error: ${e.message}")
			}
		}

		return apiResponse
	}
}