package com.websarva.wings.android.book_management_tool.api

import android.net.http.HttpException
import android.util.Log
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.withContext
import okhttp3.OkHttpClient
import java.io.BufferedReader
import java.io.InputStreamReader
import java.net.HttpURLConnection
import java.net.URL


class ApiRequestSender {

	@Throws(Exception::class)
	fun get() {
		val url = "http://localhost:8080/hello"
		val request: Request = Builder()
			.url(url)
			.build()
		val okHttpClient: OkHttpClient = Builder()
			.build()
		okHttpClient.newCall(request).execute().use { response ->
			val responseCode = response.code()
			println("responseCode: $responseCode")
			if (!response.isSuccessful) {
				println("error!!")
			}
			if (response.body() != null) {
				val body = response.body()!!.string()
				println("body: $body")
				val dog: Dog = mapper.readValue(body, Dog::class.java)
				println("deserialized: $dog")
			}
		}
	}

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

	}

	//Todo: ここでAPIの解析までする必要はないので、APIの解析はAPIResponseParserで行う
	//ここで返す値は、APIのレスポンスコードとレスポンスボディのみ。JSONに変換するのはAPIResponseParserで行う

	private suspend fun accessAPI(
		methodStr: String,
		uriStr: String,
		body: List<String>
	): ApiResponse {

		var apiCode : Int
		var apiBody : String

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

				apiCode = connection.responseCode
				Log.d("BookMgmtTool API Response Code", apiCode.toString())

				apiBody =
					BufferedReader(InputStreamReader(connection.inputStream, "UTF-8")).use {
						it.readText()
					}

				Log.d("BookMgmtTool API Response Body", apiBody)
/*
				if (responseBody.startsWith("[")) {
					//NOTE: [ で始まる場合はJSONArray
					val jsonArray = JSONArray(responseBody)
					json = JSONObject().put("data", jsonArray)


				} else if(responseBody.startsWith("{")) {
					//NOTE: { で始まる場合はJSONObject
					json = JSONObject(responseBody)
				}
				Log.d("BookMgmtTool API Get JSON", json.toString())
*/
				connection.disconnect()

			} catch (e: HttpException) {

				throw HttpException(e.code, e.message)

				Log.d("BookMgmtTool Exc Error", e.toString())

				apiBody = "{\"message\":{\"message\":\"${e.message}\"}}"
				apiCode = HttpURLConnection.HTTP_INTERNAL_ERROR
			}
		}
		return ApiResponse(apiBody, apiCode)
	}
}