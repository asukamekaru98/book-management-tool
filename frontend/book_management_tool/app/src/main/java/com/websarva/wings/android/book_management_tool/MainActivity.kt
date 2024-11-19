package com.websarva.wings.android.book_management_tool

//import com.webserva.wings.android.sending_json_over_http_sample.ui.theme.SendingJSONOverHTTP_SampleTheme

import android.graphics.Bitmap
import android.os.Bundle
import android.util.Log
import android.view.Menu
import android.view.MenuItem
import android.view.Window
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.RecyclerView
import com.websarva.wings.android.book_management_tool.api.BookManagementToolAPIManager
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData as BMTApiData
import com.websarva.wings.android.book_management_tool.databinding.ActivityMainBinding
import com.websarva.wings.android.book_management_tool.flagment.fragmentAddBookShelf
import com.websarva.wings.android.book_management_tool.flagment.fragmentAddReadHistories
import com.websarva.wings.android.book_management_tool.flagment.fragmentAddWishList
import com.websarva.wings.android.book_management_tool.flagment.fragmentBookshelf
import com.websarva.wings.android.book_management_tool.flagment.fragmentReadHistories
import com.websarva.wings.android.book_management_tool.flagment.fragmentWishlist


class MainActivity : AppCompatActivity() {
	private lateinit var binding: ActivityMainBinding
	private lateinit var toolBar: androidx.appcompat.widget.Toolbar
	private lateinit var listView: RecyclerView


	private val names: ArrayList<String> = arrayListOf()
	private val bitmaps: ArrayList<Bitmap> = arrayListOf()
	private var bookData: BMTApiData = BMTApiData()

	override fun onCreate(savedInstanceState: Bundle?) {
		super.onCreate(savedInstanceState)


		// ここでActionBarを無効化
		supportRequestWindowFeature(Window.FEATURE_NO_TITLE)

		binding = ActivityMainBinding.inflate(layoutInflater)

		toolBar = binding.toolbar
		setSupportActionBar(toolBar)

		setContentView(binding.root)
		replaceFragment(fragmentBookshelf())


		// ボトムナビゲーションのアイテムが選択されたときの処理
		binding.navView.setOnItemSelectedListener {

			when (it.itemId) {
				R.id.BtmBtnBookShelf -> {
					Log.d("MainActivity", "icon_add")
					replaceFragment(fragmentBookshelf())
				}
				R.id.BtmBtnReadHistories -> replaceFragment(fragmentReadHistories())
				R.id.BtmBtnWishList -> replaceFragment(fragmentWishlist())

				else -> {
				}
			}

			true
		}

		// ツールバーのアイテムが選択されたときの処理
		binding.toolbar.setOnMenuItemClickListener {
			when (it.itemId) {
				R.id.icon_add -> {
					Log.d("MainActivity", "icon_add")
					val fragmentManager = supportFragmentManager

					when (fragmentManager.findFragmentById(R.id.frame_layout)) {
						is fragmentBookshelf -> replaceFragment(fragmentAddBookShelf())
						is fragmentReadHistories -> replaceFragment(fragmentAddReadHistories())
						is fragmentWishlist -> replaceFragment(fragmentAddWishList())
					}
				}
				R.id.icon_search -> Toast.makeText(this, "icon_search", Toast.LENGTH_SHORT).show()
				R.id.setting -> Toast.makeText(this, "setting", Toast.LENGTH_SHORT).show()
				else -> return@setOnMenuItemClickListener false
			}
			true
		}
	}

	// 画面遷移
	private fun replaceFragment(fragment: Fragment) {
		// FragmentManagerのインスタンスを取得
		val fragmentManager = supportFragmentManager
		val fragmentTransaction = fragmentManager.beginTransaction()
		// レイアウトのフレーム部分にフラグメントを表示
		fragmentTransaction.replace(R.id.frame_layout, fragment)
		// フラグメントの変更を反映
		fragmentTransaction.commit()
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
			else -> return false
		}

		return true
	}


}