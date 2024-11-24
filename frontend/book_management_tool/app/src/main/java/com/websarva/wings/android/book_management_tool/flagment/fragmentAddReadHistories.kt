package com.websarva.wings.android.book_management_tool.flagment

import android.os.Bundle
import android.util.Log
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.EditText
import android.widget.Spinner
import android.widget.Toast
import com.websarva.wings.android.book_management_tool.R
import com.websarva.wings.android.book_management_tool.api.BookManagementToolAPIManager
import com.websarva.wings.android.book_management_tool.apiBody.BmtAPIReadHistoriesRequestBodyCreator
import com.websarva.wings.android.book_management_tool.apiBody.BmtAPIWishListRequestBodyCreator
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiMaxLength
import com.websarva.wings.android.book_management_tool.databinding.FragmentAddWishListBinding
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext


class fragmentAddReadHistories : Fragment() {

	private lateinit var binding: FragmentAddWishListBinding

	val industryImportant = binding.root.findViewById<Spinner>(R.id.spinnerIndustryImportant).selectedItem.toString()
	val workImportant = binding.root.findViewById<Spinner>(R.id.spinnerWorkImportant).selectedItem.toString()
	val userImportant = binding.root.findViewById<Spinner>(R.id.spinnerUserImportant).selectedItem.toString()

	override fun onCreateView(
		inflater: LayoutInflater, container: ViewGroup?,
		savedInstanceState: Bundle?
	): View {
		binding = FragmentAddWishListBinding.inflate(inflater, container, false)

		this.setupSpinners() // スピナーの設定
		this.setupRegisterButton() // 登録ボタンの設定
		this.setupEditText() // 入力ボックスの設定


		return binding.root
	}

}/**
 * 登録ボタンが押された時の処理
 */
private fun onClickRegisterButton() {

	val isbnCode = binding.root.findViewById<EditText>(R.id.isbn_code_edit_text).text.toString()
	val memo = binding.root.findViewById<EditText>(R.id.memo_edit_text).text.toString()

	if(isbnCode.length != 13) {
		Toast.makeText(requireContext(), "13文字入力してください", Toast.LENGTH_SHORT).show()
		return
	}

	if(memo.length > BookManagementToolApiMaxLength.MAX_LENGTH_WISH_LIST_MEMO) {
		val message = "メモは${BookManagementToolApiMaxLength.MAX_LENGTH_WISH_LIST_MEMO}文字以内で入力してください"

		Toast.makeText(requireContext(), message, Toast.LENGTH_SHORT).show()
		return
	}



	val body = BmtAPIReadHistoriesRequestBodyCreator(
		importantToNumString(industryImportant),
		importantToNumString(workImportant),
		importantToNumString(userImportant),
		"0",
		"0",
		"",
		"",
		"",
		memo,
		"",
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