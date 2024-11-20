package com.websarva.wings.android.book_management_tool.flagment

import android.os.Bundle
import android.text.Editable
import android.text.TextWatcher
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.EditText
import android.widget.Toast
import com.websarva.wings.android.book_management_tool.R
import com.websarva.wings.android.book_management_tool.databinding.FragmentAddBookShelfBinding as Binding

class fragmentAddBookShelf : Fragment() {

	private lateinit var binding: Binding

	override fun onCreateView(
		inflater: LayoutInflater, container: ViewGroup?,
		savedInstanceState: Bundle?
	): View {
		binding = Binding.inflate(inflater, container, false)

		this.setupRegisterButton() // 登録ボタンの設定
		this.setupEditText() // 入力ボックスの設定


		return binding.root
	}



	// 登録ボタンの設定
	private fun setupRegisterButton() {
		binding.registerButton.setOnClickListener {
			val text = binding.root.findViewById<EditText>(R.id.isbn_code_edit_text).text.toString()
			Toast.makeText(requireContext(), text, Toast.LENGTH_SHORT).show()
		}
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