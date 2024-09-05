package com.websarva.wings.android.book_management_tool

//import com.webserva.wings.android.sending_json_over_http_sample.ui.theme.SendingJSONOverHTTP_SampleTheme

import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import org.json.JSONObject
import java.io.BufferedReader
import java.io.IOException
import java.io.InputStream
import java.io.InputStreamReader
import java.io.OutputStreamWriter
import java.net.HttpURLConnection
import java.net.URL


class MainActivity : AppCompatActivity() {

	// デフォルトのURLを定数として定義
	companion object {
		const val DEFAULT_SERVER_URL = "http://192.168.1.51/v1/read-histories" // 任意のデフォルトURLを設定
	}

	override fun onCreate(savedInstanceState: Bundle?) {
		super.onCreate(savedInstanceState)
		setContentView(R.layout.activity_main)

		val urlEditText = findViewById<EditText>(R.id.urlEditText)
		val loginIdEditText = findViewById<EditText>(R.id.loginIdEditText)
		val passwordEditText = findViewById<EditText>(R.id.passwordEditText)
		val customerIdEditText = findViewById<EditText>(R.id.customerIdEditText)
		val customerNameEditText = findViewById<EditText>(R.id.customerNameEditText)
		val sendButton = findViewById<Button>(R.id.sendButton)
		val accessButton = findViewById<Button>(R.id.accessButton)

		sendButton.setOnClickListener {
			val userUrl = urlEditText.text.toString().ifEmpty { DEFAULT_SERVER_URL }
			val loginId = loginIdEditText.text.toString()
			val password = passwordEditText.text.toString()
			val customerId = customerIdEditText.text.toString()
			val customerName = customerNameEditText.text.toString()

			// JSONデータの作成
			val jsonData = JSONObject().apply {
				put("loginId", loginId)
				put("password", password)
				put("customerId", customerId)
				put("customerName", customerName)
			}.toString()

			if (jsonData.isNotEmpty()) {
				// JSONデータを送信
				sendJsonData(userUrl, jsonData)
			} else {
				Toast.makeText(this, "すべてのフィールドを入力してください", Toast.LENGTH_SHORT).show()
			}
		}

		accessButton.setOnClickListener{
			val userUrl = urlEditText.text.toString().ifEmpty { DEFAULT_SERVER_URL }
			accessUrl(userUrl)
		}
	}

	private fun sendJsonData(urlString: String, jsonData: String) {
		CoroutineScope(Dispatchers.IO).launch {
			try {
				val url = URL(urlString)
				val connection = url.openConnection() as HttpURLConnection
				connection.requestMethod = "POST"
				connection.doOutput = true
				connection.setRequestProperty("Content-Type", "application/json; utf-8")
				connection.setRequestProperty("Accept", "application/json")

				// JSONデータを送信
				OutputStreamWriter(connection.outputStream).use { it.write(jsonData) }

				val responseCode = connection.responseCode
				val responseMessage = connection.responseMessage

				// UIスレッドでトーストを表示
				runOnUiThread {
					Toast.makeText(
						this@MainActivity,
						"Response: $responseCode - $responseMessage",
						Toast.LENGTH_LONG
					).show()
				}

				connection.disconnect()

			} catch (e: Exception) {
				// エラーが発生した場合もトーストを表示
				runOnUiThread {
					Toast.makeText(this@MainActivity, "Error: ${e.message} ~~~", Toast.LENGTH_LONG).show()
				}
			}
		}
	}

	private fun accessUrl(urlString: String) {
		CoroutineScope(Dispatchers.IO).launch {
			try {
				val url = URL(urlString)
				val connection = url.openConnection() as HttpURLConnection
				connection.doOutput = false
				connection.doInput = true
				connection.readTimeout = 0
				connection.connectTimeout = 0
				connection.requestMethod = "GET"

				//connection.connect()

				val responseCode = connection.responseCode
				val responseMessage = connection.responseMessage

				// レスポンスデータの読み込み
				//val str = connection.inputStream.bufferedReader(Charsets.UTF_8).use { br ->
				//	br.readLines().joinToString("")
				//}

				val response = BufferedReader(InputStreamReader(connection.inputStream)).use {
					it.readText()
				}

				// UIスレッドでレスポンスをトーストで表示
				runOnUiThread {
					Toast.makeText(
						this@MainActivity,
						"GET Response: $responseCode - $responseMessage\n$response",
						//"GET Response: $str",
						Toast.LENGTH_LONG
					).show()
				}

				connection.disconnect()

			} catch (e: Exception) {
				// エラーが発生した場合もトーストを表示
				runOnUiThread {
					Toast.makeText(this@MainActivity, "Error: ${e.message}", Toast.LENGTH_LONG).show()
				}
			}
		}
	}

}