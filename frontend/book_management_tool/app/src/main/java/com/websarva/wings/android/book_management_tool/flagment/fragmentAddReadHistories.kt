package com.websarva.wings.android.book_management_tool.flagment

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import com.websarva.wings.android.book_management_tool.databinding.FragmentAddReadHistoriesBinding as Binding


class fragmentAddReadHistories : Fragment() {

	private lateinit var binding: Binding

	override fun onCreateView(
		inflater: LayoutInflater, container: ViewGroup?,
		savedInstanceState: Bundle?
	): View {
		binding = Binding.inflate(inflater, container, false)

		return binding.root
	}
}