package com.websarva.wings.android.book_management_tool.flagment

import android.graphics.Bitmap
import android.os.Bundle
import android.util.Log
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.websarva.wings.android.book_management_tool.MainActivity
import com.websarva.wings.android.book_management_tool.R
import com.websarva.wings.android.book_management_tool.adapter.RecyclerViewAdapter
import com.websarva.wings.android.book_management_tool.api.BookManagementToolAPIManager
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData
import com.websarva.wings.android.book_management_tool.databinding.ActivityMainBinding
import com.websarva.wings.android.book_management_tool.databinding.FragmentBookshelfBinding as Binding
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData as BMTApiData
import com.websarva.wings.android.book_management_tool.downloader.ImageDownloader
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch

class fragmentBookshelf : Fragment() {

	private lateinit var binding: Binding

	private val names: ArrayList<String> = arrayListOf()
	private val bitmaps: ArrayList<Bitmap> = arrayListOf()
	private var bookData: BMTApiData = BMTApiData()

	override fun onCreateView(
		inflater: LayoutInflater, container: ViewGroup?,
		savedInstanceState: Bundle?
	): View {
		binding = Binding.inflate(inflater, container, false)
		val listView = binding.bookListView
		listView.setHasFixedSize(true)

		this.setupAddButton()

		val rLayoutManager: RecyclerView.LayoutManager = LinearLayoutManager(requireContext())

		CoroutineScope(Dispatchers.Main).launch {
			bookData = try {
				BookManagementToolAPIManager().getAllBookShelf()
			} catch (e: Exception) {
				Log.e(
					"BookMgmtTool Exception",
					e.message.toString() + "/" + e.stackTraceToString() + "/" + e.cause.toString()
				)
				BookManagementToolApiData() // 初期値を設定
			}

			bookData.bookList.forEach {
				names.add(it.bookTitle)
				bitmaps.add(ImageDownloader(requireContext()).downloadImage(it.bookImageUrl))
			}

			listView.layoutManager = rLayoutManager
			listView.adapter = RecyclerViewAdapter(bitmaps, names)
		}

		return binding.root
	}

	private fun setupAddButton() {
		val addButton = binding.addButton

		addButton.setOnClickListener {
			(requireActivity() as MainActivity).replaceFragment(fragmentAddBookShelf())
		}
	}
}