package com.websarva.wings.android.book_management_tool

//import com.webserva.wings.android.sending_json_over_http_sample.ui.theme.SendingJSONOverHTTP_SampleTheme

import android.graphics.Bitmap
import android.graphics.BitmapFactory
import android.os.Bundle
import android.provider.ContactsContract.CommonDataKinds.Note
import android.util.Log
import android.view.Menu
import android.view.MenuItem
import android.view.View
import android.view.Window
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.Button
import android.widget.EditText
import android.widget.Spinner
import android.widget.TextView
import android.widget.Toast
import android.widget.Toolbar
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.websarva.wings.android.book_management_tool.adapter.RecyclerViewAdapter
import com.websarva.wings.android.book_management_tool.api.ApiResponse
import com.websarva.wings.android.book_management_tool.api.BookManagementToolAPIManager
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData as BMTApiData
import com.websarva.wings.android.book_management_tool.databinding.ActivityMainBinding
import com.websarva.wings.android.book_management_tool.downloader.ImageDownloader
import com.websarva.wings.android.book_management_tool.flagment.fragmentBookshelf
import com.websarva.wings.android.book_management_tool.flagment.fragmentReadHistories
import com.websarva.wings.android.book_management_tool.flagment.fragmentWishlist
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.runBlocking
import kotlinx.coroutines.withContext
import org.json.JSONObject
import java.io.BufferedReader
import java.io.IOException
import java.io.InputStream
import java.io.InputStreamReader
import java.io.OutputStreamWriter
import java.net.HttpURLConnection
import java.net.URL


class MainActivity : AppCompatActivity() {
	private lateinit var binding: ActivityMainBinding
	private lateinit var toolBar: androidx.appcompat.widget.Toolbar
	private lateinit var listView: RecyclerView


	private val names: ArrayList<String> = arrayListOf()
	private val bitmaps: ArrayList<Bitmap> = arrayListOf()

	private var bookData: BMTApiData = BMTApiData()

	override fun onCreate(savedInstanceState: Bundle?) {
		super.onCreate(savedInstanceState)

		// APIリクエストの送信
		CoroutineScope(Dispatchers.Main).launch {
			bookData = try {
				BookManagementToolAPIManager().getAllBookShelf()
			} catch (e: Exception) {

				Log.e(
					"BookMgmtTool Exception",
					e.message.toString() + "/" + e.stackTraceToString() + "/" + e.cause.toString()
				)
				BMTApiData()
			}

			bookData.bookList.forEach {
				names.add(it.bookTitle)
				bitmaps.add(ImageDownloader(this@MainActivity).downloadImage(it.bookImageUrl))
			}
		}

		// ここでActionBarを無効化
		supportRequestWindowFeature(Window.FEATURE_NO_TITLE)

		binding = ActivityMainBinding.inflate(layoutInflater)

		toolBar = binding.toolbar
		setSupportActionBar(toolBar)

		listView = binding.bookListView
		listView.setHasFixedSize(true)
		val rLayoutManager: RecyclerView.LayoutManager = LinearLayoutManager(this)
		listView.layoutManager = rLayoutManager
		listView.adapter = RecyclerViewAdapter(bitmaps, names)

		//setContentView(R.layout.activity_main)
		setContentView(binding.root)
		replaceFragment(fragmentBookshelf())


		//val reqCreator = bmtApiRequestCreatorFactory::APIRequestCreator_AddOneBookShelf


		binding.navView.setOnItemSelectedListener {

			when (it.itemId) {
				R.id.BtmBtnBookShelf -> replaceFragment(fragmentBookshelf())
				R.id.BtmBtnReadHistories -> replaceFragment(fragmentReadHistories())
				R.id.BtmBtnWishList -> replaceFragment(fragmentWishlist())

				else -> {
				}
			}

			true
		}
		/*
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

		*/
	}

	private suspend fun getAPI() {
		//	val apiManager = BookManagementToolAPIManager()

		try {
			val data: BMTApiData = BookManagementToolAPIManager().getAllBookShelf()

			Toast.makeText(this, data.bookList.firstOrNull()?.bookIsbn, Toast.LENGTH_SHORT).show()

		} catch (e: Exception) {
			Log.e(
				"BookMgmtTool Exception",
				e.message.toString() + "/" + e.stackTraceToString() + "/" + e.cause.toString()
			)
		}
	}

	override fun onCreateOptionsMenu(menu: Menu): Boolean {
		getMenuInflater().inflate(R.menu.menu_header, menu)
		return true
	}

	override fun onOptionsItemSelected(item: MenuItem): Boolean {
		val itemID = item.getItemId()

		when (itemID) {
			R.id.BtmBtnBookShelf -> Toast.makeText(this, "BtmBtnBookShelf", Toast.LENGTH_SHORT)
				.show()

			R.id.BtmBtnReadHistories -> Toast.makeText(
				this,
				"BtmBtnReadHistories",
				Toast.LENGTH_SHORT
			).show()

			R.id.BtmBtnWishList -> Toast.makeText(this, "BtmBtnWishList", Toast.LENGTH_SHORT).show()
			R.id.setting -> Toast.makeText(this, "setting", Toast.LENGTH_SHORT).show()
			R.id.icon_add -> Toast.makeText(this, "icon_add", Toast.LENGTH_SHORT).show()
			R.id.icon_search -> Toast.makeText(this, "icon_search", Toast.LENGTH_SHORT).show()

			else -> return false
		}

		return true
	}

	private fun replaceFragment(fragment: Fragment) {
		val fragmentManager = supportFragmentManager
		val fragmentTransaction = fragmentManager.beginTransaction()
		fragmentTransaction.replace(R.id.frame_layout, fragment)
		fragmentTransaction.commit()
	}
}