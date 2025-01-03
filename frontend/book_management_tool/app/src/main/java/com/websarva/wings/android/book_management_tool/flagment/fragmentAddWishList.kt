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
import android.widget.Spinner
import android.widget.Toast
import com.websarva.wings.android.book_management_tool.R
import com.websarva.wings.android.book_management_tool.api.BookManagementToolAPIManager
import com.websarva.wings.android.book_management_tool.apiBody.BmtAPIWishListRequestBodyCreator
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiMaxLength as MaxLength
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import com.websarva.wings.android.book_management_tool.databinding.FragmentAddWishListBinding as Binding

class fragmentAddWishList : Fragment() {

	private lateinit var binding: Binding

	private lateinit var spinnerIndustory: Spinner
	private lateinit var spinnerWork: Spinner
	private lateinit var spinnerUser: Spinner

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

		val isbnCode = binding.root.findViewById<EditText>(R.id.isbn_code_edit_text).text.toString()
		val memo = binding.root.findViewById<EditText>(R.id.memo_edit_text).text.toString()

		if(isbnCode.length != 13) {
			Toast.makeText(requireContext(), "13文字入力してください", Toast.LENGTH_SHORT).show()
			return
		}

		if(memo.length > MaxLength.MAX_LENGTH_WISH_LIST_MEMO) {
			val message = "メモは${MaxLength.MAX_LENGTH_WISH_LIST_MEMO}文字以内で入力してください"

			Toast.makeText(requireContext(), message, Toast.LENGTH_SHORT).show()
			return
		}

		val body = BmtAPIWishListRequestBodyCreator(
			importantToNumString(spinnerIndustory.selectedItem.toString()),
			importantToNumString(spinnerWork.selectedItem.toString()),
			importantToNumString(spinnerUser.selectedItem.toString()),
			"0",
			"0",
			memo
		)

		Log.d("BookMgmtTool Button Click Result", body.get())

		CoroutineScope(Dispatchers.Main).launch {
			try {
				withContext(Dispatchers.IO) {
					BookManagementToolAPIManager().addOneWishList(isbnCode, body.get())
				}
				Toast.makeText(requireContext(), "登録しました", Toast.LENGTH_SHORT).show()

			} catch (e: Exception) {

				// 409エラーの場合は、すでに登録されている旨のメッセージを表示
				if (e.message.toString().contains("409")) {
					Toast.makeText(requireContext(), "すでに登録されています", Toast.LENGTH_SHORT).show()
				} else {
					Toast.makeText(requireContext(), "エラーが発生しました", Toast.LENGTH_SHORT).show()
				}


				Log.e(
					"BookMgmtTool Exception",
					e.message.toString() + "/" + e.stackTraceToString() + "/" + e.cause.toString()
				)
			}

			//Log.d("BookMgmtTool Button Click Result", bookData.message)

		}
	}

	private fun importantToNumString(important: String): String {
		return when (important) {
			"高" -> "3"
			"中" -> "2"
			else -> "1"
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

		spinnerIndustory = binding.root.findViewById<Spinner>(R.id.spinnerIndustryImportant)
		spinnerWork = binding.root.findViewById<Spinner>(R.id.spinnerWorkImportant)
		spinnerUser = binding.root.findViewById<Spinner>(R.id.spinnerUserImportant)

		val adapter = ArrayAdapter(
			requireContext(),
			android.R.layout.simple_spinner_item,
			arrayOf("低", "中", "高")
		)

		// スピナーの選択時の処理
		spinnerIndustory.adapter = adapter
		spinnerWork.adapter = adapter
		spinnerUser.adapter = adapter
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