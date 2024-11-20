package com.websarva.wings.android.book_management_tool.flagment

import android.graphics.Bitmap
import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import android.util.Log
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ArrayAdapter
import android.widget.EditText
import android.widget.Toast
import com.websarva.wings.android.book_management_tool.R
import com.websarva.wings.android.book_management_tool.adapter.RecyclerViewAdapter
import com.websarva.wings.android.book_management_tool.api.BookManagementToolAPIManager
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData
import com.websarva.wings.android.book_management_tool.downloader.ImageDownloader
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import com.websarva.wings.android.book_management_tool.databinding.FragmentAddWishListBinding as Binding

class fragmentAddWishList : Fragment() {

	private lateinit var binding: Binding

	/**
	 * FragmentのViewを生成して返すメソッド
	 *
	 * @param inflater LayoutInflater
	 * @param container ViewGroup?
	 * @param savedInstanceState Bundle?
	 * @return View?
	 */
	override fun onCreateView(
		inflater: LayoutInflater, container: ViewGroup?,
		savedInstanceState: Bundle?
	): View {
		binding = Binding.inflate(inflater, container, false)

		this.setupSpinners() // スピナーの設定
		this.setupRegisterButton() // 登録ボタンの設定
		this.setupEditText() // 入力ボックスの設定


		return binding.root
	}

	/**
	 * 登録ボタンが押された時の処理
	 */
	private fun onClickRegisterButton() {
		val names: ArrayList<String> = arrayListOf()
		val bitmaps: ArrayList<Bitmap> = arrayListOf()

		val isbnCode = binding.root.findViewById<EditText>(R.id.isbn_code_edit_text).text.toString()

		if(isbnCode.length != 13) {
			Toast.makeText(requireContext(), "13文字入力してください", Toast.LENGTH_SHORT).show()
			return
		}

		CoroutineScope(Dispatchers.Main).launch {
			val bookData = try {
				BookManagementToolAPIManager().AddOneWishList(isbnCode)
			} catch (e: Exception) {
				Log.e(
					"BookMgmtTool Exception",
					e.message.toString() + "/" + e.stackTraceToString() + "/" + e.cause.toString()
				)
				BookManagementToolApiData() // 初期値を設定
			}

			Log.d("BookMgmtTool Button Click Result", bookData.message)

		}
	}

	// 登録ボタンの設定
	private fun setupRegisterButton() {
		binding.registerButton.setOnClickListener {
			onClickRegisterButton()
		}
	}

	// スピナーの設定
	private fun setupSpinners() {

		val adapter = ArrayAdapter(
			requireContext(),
			android.R.layout.simple_spinner_item,
			arrayOf("低", "中", "高")
		)

		binding.spinnerIndustryImportant.adapter = adapter
		binding.spinnerWorkImportant.adapter = adapter
		binding.spinnerUserImportant.adapter = adapter
	}

	// 入力ボックスの設定
	private fun setupEditText() {
		binding.root.findViewById<EditText>(R.id.isbn_code_edit_text).addTextChangedListener(
			object : TextWatcher {

				// 文字が変更される前の処理
				override fun beforeTextChanged(
					s: CharSequence?,
					start: Int,
					count: Int,
					after: Int
				) {
				}

				// 文字が入力された時の処理
				override fun onTextChanged(
					s: CharSequence?,
					start: Int,
					before: Int,
					count: Int
				) {
				}

				// 文字が変更された後の処理
				override fun afterTextChanged(s: Editable?) {
					if (s.toString().length == 13) {
						Toast.makeText(
							requireContext(),
							"13文字です",
							Toast.LENGTH_SHORT
						).show()
					}
				}
			})
	}
}