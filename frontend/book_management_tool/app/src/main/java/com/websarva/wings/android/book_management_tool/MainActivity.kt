package com.websarva.wings.android.book_management_tool

//import com.webserva.wings.android.sending_json_over_http_sample.ui.theme.SendingJSONOverHTTP_SampleTheme

import android.os.Bundle
import android.view.View
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.Button
import android.widget.EditText
import android.widget.Spinner
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import com.websarva.wings.android.book_management_tool.databinding.ActivityMainBinding
import com.websarva.wings.android.book_management_tool.flagment.fragmentBookshelf
import com.websarva.wings.android.book_management_tool.flagment.fragmentReadHistories
import com.websarva.wings.android.book_management_tool.flagment.fragmentWishlist
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

	private lateinit var binding : ActivityMainBinding


	override fun onCreate(savedInstanceState: Bundle?) {
		super.onCreate(savedInstanceState)

		binding = ActivityMainBinding.inflate(layoutInflater)




		//setContentView(R.layout.activity_main)
		setContentView(binding.root)
		replaceFragment(fragmentBookshelf())

		binding.navView.setOnItemSelectedListener{

			when(it.itemId){
				R.id.BtmBtnBookShelf -> replaceFragment(fragmentBookshelf())
				R.id.BtmBtnReadHistories -> replaceFragment(fragmentReadHistories())
				R.id.BtmBtnWishList -> replaceFragment(fragmentWishlist())

				else->{

				}
			}

			true
		}

		//val httpMethodSpnrItems = arrayOf("GET","POST","PUT","DELETE","PATCH")
		val httpMethodSpinner = findViewById<Spinner>(R.id.httpMethodSpinner)
		val httpMethodSpinnerAdapter = ArrayAdapter(
			this,
			android.R.layout.simple_spinner_item,
			arrayOf("GET", "POST", "PUT", "DELETE", "PATCH")
		)
		httpMethodSpinnerAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
		httpMethodSpinner.adapter = httpMethodSpinnerAdapter

		var strHttpMethod = ""

		val ipAddressET = findViewById<EditText>(R.id.ipAddressET)
		val apiVersionET = findViewById<EditText>(R.id.apiVersionET)
		val apiFunctionET = findViewById<EditText>(R.id.apiFunctionET)
		val isbnCodeET = findViewById<EditText>(R.id.isbnCodeET)
		val jsonTV = findViewById<TextView>(R.id.jsonTV)

		//	val urlEditText = findViewById<EditText>(R.id.urlEditText)
		//	val loginIdEditText = findViewById<EditText>(R.id.loginIdEditText)
		//	val passwordEditText = findViewById<EditText>(R.id.passwordEditText)
		//	val customerIdEditText = findViewById<EditText>(R.id.customerIdEditText)
		//	val customerNameEditText = findViewById<EditText>(R.id.customerNameEditText)
		//val sendButton = findViewById<Button>(R.id.sendButton)
		val accessButton = findViewById<Button>(R.id.accessButton)

		// HTTPメソッド用プルダウンのOCL
		httpMethodSpinner.onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
			override fun onItemSelected(
				parent: AdapterView<*>,
				view: View?,
				position: Int,
				id: Long
			) {
				strHttpMethod = parent.getItemAtPosition(position) as String
				Toast.makeText(this@MainActivity, "Selected: $strHttpMethod", Toast.LENGTH_SHORT)
					.show()
			}

			override fun onNothingSelected(parent: AdapterView<*>) {
				// アイテムが選択されなかった場合の処理
			}
		}


		//	sendButton.setOnClickListener {
		//		val userUrl = urlEditText.text.toString().ifEmpty { DEFAULT_SERVER_URL }
		//		val loginId = loginIdEditText.text.toString()
		//		val password = passwordEditText.text.toString()
		//		val customerId = customerIdEditText.text.toString()
		//		val customerName = customerNameEditText.text.toString()
//
		//		// JSONデータの作成
		//		val jsonData = JSONObject().apply {
		//			put("loginId", loginId)
		//			put("password", password)
		//			put("customerId", customerId)
		//			put("customerName", customerName)
		//		}.toString()
//
		//		if (jsonData.isNotEmpty()) {
		//			// JSONデータを送信
		//			sendJsonData(selectedHttpMethod, userUrl, jsonData)
		//		} else {
		//			Toast.makeText(this, "すべてのフィールドを入力してください", Toast.LENGTH_SHORT)
		//				.show()
		//		}
		//	}

		accessButton.setOnClickListener {

			val strIPAddress = ipAddressET.text.toString().ifEmpty { "192.168.1.64" }
			val strAPIVersion = apiVersionET.text.toString().ifEmpty { "v1" }
			val strAPIFunction = apiFunctionET.text.toString().ifEmpty { "book-shelf" }
			val strISBNCode = isbnCodeET.text.toString().ifEmpty { "9784780802047" }

			if (strHttpMethod.isBlank() || strIPAddress.isBlank() || strAPIVersion.isBlank() || strAPIFunction.isBlank()) {
				Toast.makeText(this@MainActivity, "入力が不足しています", Toast.LENGTH_SHORT).show()
			} else {
				var sendURI = "http://$strIPAddress/$strAPIVersion/$strAPIFunction"

				// ISBNコードの入力があれば、クエリとして加える
				if (strISBNCode.isNotBlank()) {
					sendURI = "$sendURI?isbn=$strISBNCode"
				}

				accessUrl(strHttpMethod, sendURI,jsonTV)
			}

			//var sendURI : String = "http://$ipAddressET/$apiVersionET/$apiFunctionET"


			//val userUrl = urlEditText.text.toString().ifEmpty { DEFAULT_SERVER_URL }
		}


	}

	private fun replaceFragment(fragment: Fragment)
	{
		val fragmentManager = supportFragmentManager
		val fragmentTransaction = fragmentManager.beginTransaction()
		fragmentTransaction.replace(R.id.frame_layout,fragment)
		fragmentTransaction.commit()
	}

	/*
	private fun sendJsonData(httpMethod:String,  urlString: String, jsonData: String) {
		CoroutineScope(Dispatchers.IO).launch {
			try {
				val url = URL(urlString)
				val connection = url.openConnection() as HttpURLConnection
				connection.requestMethod = httpMethod
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
					Toast.makeText(this@MainActivity, "Error: ${e.message} ~~~", Toast.LENGTH_LONG)
						.show()
				}
			}
		}
	}
*/

	private fun accessUrl(httpMethod: String, urlString: String,jsonTV: TextView) {
		CoroutineScope(Dispatchers.IO).launch {
			try {
				val url = URL(urlString)
				val connection = url.openConnection() as HttpURLConnection
				connection.doOutput = false
				connection.doInput = true
				connection.readTimeout = 0
				connection.connectTimeout = 0
				connection.requestMethod = httpMethod

				connection.connect()

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
				/*runOnUiThread {
					Toast.makeText(
						this@MainActivity,
						"GET Response: $responseCode - $responseMessage\n$response",
						//"GET Response: $str",
						Toast.LENGTH_LONG
					).show()
				}
				 */

				runOnUiThread {
					jsonTV.text = "Response: $responseCode - $responseMessage\n$response"
				}

				/*
				runOnUiThread {
					Toast.makeText(
						this@MainActivity,
						"GET Response: $responseCode - $responseMessage",
						//"GET Response: $str",
						Toast.LENGTH_LONG
					).show()
				}
				*/

				connection.disconnect()

			} catch (e: Exception) {
				// エラーが発生した場合もトーストを表示
				runOnUiThread {
					Toast.makeText(this@MainActivity, "Error: ${e.message} ", Toast.LENGTH_LONG)
						.show()
				}
			}
		}
	}

}