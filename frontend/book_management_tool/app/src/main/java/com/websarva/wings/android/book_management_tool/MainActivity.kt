package com.websarva.wings.android.book_management_tool

import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.appcompat.app.AppCompatActivity
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Surface
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.tooling.preview.Preview
//import com.webserva.wings.android.sending_json_over_http_sample.ui.theme.SendingJSONOverHTTP_SampleTheme
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import org.json.JSONObject
import java.io.OutputStreamWriter
import java.net.HttpURLConnection
import java.net.URL

class MainActivity : AppCompatActivity() {

	// デフォルトのURLを定数として定義
	companion object {
		const val DEFAULT_SERVER_URL = "https://192.168.1.51:80/v1/read-histories?format-json&isbn=9784863544109" // 任意のデフォルトURLを設定
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
					Toast.makeText(this@MainActivity, "Error: ${e.message}", Toast.LENGTH_LONG).show()
				}
			}
		}
	}
}