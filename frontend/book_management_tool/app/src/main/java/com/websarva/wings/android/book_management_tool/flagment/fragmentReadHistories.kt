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
import com.websarva.wings.android.book_management_tool.R
import com.websarva.wings.android.book_management_tool.adapter.RecyclerViewAdapter
import com.websarva.wings.android.book_management_tool.api.BookManagementToolAPIManager
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiData
import com.websarva.wings.android.book_management_tool.databinding.ActivityMainBinding
import com.websarva.wings.android.book_management_tool.databinding.FragmentReadHistoriesBinding
import com.websarva.wings.android.book_management_tool.downloader.ImageDownloader
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch

// TODO: Rename parameter arguments, choose names that match
// the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
private const val ARG_PARAM1 = "param1"
private const val ARG_PARAM2 = "param2"

/**
 * A simple [Fragment] subclass.
 * Use the [fragmentReadHistories.newInstance] factory method to
 * create an instance of this fragment.
 */
class fragmentReadHistories : Fragment() {
	// TODO: Rename and change types of parameters
	private var param1: String? = null
	private var param2: String? = null

	private val names: ArrayList<String> = arrayListOf()
	private val bitmaps: ArrayList<Bitmap> = arrayListOf()
	private var bookData: BookManagementToolApiData = BookManagementToolApiData()


	override fun onCreateView(
		inflater: LayoutInflater, container: ViewGroup?,
		savedInstanceState: Bundle?
	): View {
		// Inflate the layout for this fragment
		val listView = inflater.inflate(R.layout.fragment_read_histories, container, false)
		//val binding = ActivityMainBinding.inflate(layoutInflater)

		//val listView = binding.bookListView
		//listView.setHasFixedSize(true)

		//return listView

		Toast.makeText(requireActivity() , "履歴", Toast.LENGTH_SHORT).show()

		CoroutineScope(Dispatchers.Main).launch {
			bookData = try {
				BookManagementToolAPIManager().getAllReadHistories()
			} catch (e: Exception) {

				Log.e(
					"BookMgmtTool Exception",
					e.message.toString() + "/" + e.stackTraceToString() + "/" + e.cause.toString()
				)
				BookManagementToolApiData()
			}

			bookData.bookList.forEach {
				names.add(it.bookTitle)
				bitmaps.add(ImageDownloader(requireActivity()).downloadImage(it.bookImageUrl))
			}

			// RecyclerViewの設定

			val recyclerView = listView.findViewById<RecyclerView>(R.id.bookListView)

			val rLayoutManager: RecyclerView.LayoutManager = LinearLayoutManager(requireActivity())
			listView.layoutManager = rLayoutManager

			listView.adapter = RecyclerViewAdapter(bitmaps, names)
			//activity?.invalidateOptionsMenu()
		}
		return listView
	}

	companion object {

		@JvmStatic
		fun newInstance(param1: String, param2: String) = fragmentReadHistories()
	}
}