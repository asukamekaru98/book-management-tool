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
 * Use the [fragmentWishlist.newInstance] factory method to
 * create an instance of this fragment.
 */
class fragmentWishlist : Fragment() {
	// TODO: Rename and change types of parameters
	private var param1: String? = null
	private var param2: String? = null

	private val names: ArrayList<String> = arrayListOf()
	private val bitmaps: ArrayList<Bitmap> = arrayListOf()
	private var bookData: BookManagementToolApiData = BookManagementToolApiData()

	override fun onCreate(savedInstanceState: Bundle?) {
		super.onCreate(savedInstanceState)
		arguments?.let {
			param1 = it.getString(ARG_PARAM1)
			param2 = it.getString(ARG_PARAM2)
		}

		Toast.makeText(requireActivity() , "干芋", Toast.LENGTH_SHORT).show()

		CoroutineScope(Dispatchers.Main).launch {
			bookData = try {
				BookManagementToolAPIManager().getAllWishLists()
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
			val binding = ActivityMainBinding.inflate(layoutInflater)

			val listView = binding.bookListView
			listView.setHasFixedSize(true)

			val rLayoutManager: RecyclerView.LayoutManager = LinearLayoutManager(requireActivity())
			listView.layoutManager = rLayoutManager
			listView.adapter = RecyclerViewAdapter(bitmaps, names)
			activity?.invalidateOptionsMenu()
		}
	}

	override fun onCreateView(
		inflater: LayoutInflater, container: ViewGroup?,
		savedInstanceState: Bundle?
	): View? {
		// Inflate the layout for this fragment
		return inflater.inflate(R.layout.fragment_wishlist, container, false)

	}

	companion object {
		/**
		 * Use this factory method to create a new instance of
		 * this fragment using the provided parameters.
		 *
		 * @param param1 Parameter 1.
		 * @param param2 Parameter 2.
		 * @return A new instance of fragment fragmentWishlist.
		 */
		// TODO: Rename and change types and number of parameters
		@JvmStatic
		fun newInstance(param1: String, param2: String) =
			fragmentWishlist().apply {
				arguments = Bundle().apply {
					putString(ARG_PARAM1, param1)
					putString(ARG_PARAM2, param2)
				}
			}
	}
}