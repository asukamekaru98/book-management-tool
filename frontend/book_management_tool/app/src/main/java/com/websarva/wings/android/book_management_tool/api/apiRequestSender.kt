package com.websarva.wings.android.book_management_tool.api

import android.util.Log
import com.google.gson.Gson
import com.google.gson.JsonParser
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.runBlocking
import kotlinx.coroutines.withContext
import org.json.JSONArray
import org.json.JSONObject
import java.io.BufferedReader
import java.io.InputStreamReader
import java.net.HttpURLConnection
import java.net.URL

class ApiRequestSender {

	suspend fun SendRequest(request: i_ApiRequestCreator): ApiResponse {
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

		return if (body.isEmpty()) {
			accessAPI(
				method, uri, listOf("{none}")
			)
		} else {
			accessAPI(
				method, uri, body
			)
		}
		return ApiResponse(JSONObject("{}"), 0)
	}

	private suspend fun accessAPI(
		methodStr: String,
		uriStr: String,
		body: List<String>
	): ApiResponse {

		var code : Int
		var json : Any // JSONObject or JSONArray


		withContext(Dispatchers.IO) {
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

				code = connection.responseCode

				val responseBody =
					BufferedReader(InputStreamReader(connection.inputStream, "UTF-8")).use {
						it.readText()
					}

				Log.d("BookMgmtTool API Raw Response", responseBody)

				json = if (responseBody.startsWith("\"[")) {
					//NOTE: [ で始まる場合はJSONArray
					JSONArray(responseBody)
				} else {
					//NOTE: { で始まる場合はJSONObject
					JSONObject(responseBody)
				}


				Log.d("BookMgmtTool API Get Code", code.toString())
				Log.d("BookMgmtTool API Get Body", json.toString())

				connection.disconnect()

			} catch (e: Exception) {
				Log.d("BookMgmtTool Exc Error", e.toString())

				json = JSONObject("{\"message\":{\"message\":\"${e.message}\"}}")
				code = HttpURLConnection.HTTP_INTERNAL_ERROR

			}
		}

		return ApiResponse(json, code)
	}
}