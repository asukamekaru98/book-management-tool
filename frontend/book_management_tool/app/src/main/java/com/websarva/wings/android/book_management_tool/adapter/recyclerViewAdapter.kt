package com.websarva.wings.android.book_management_tool.adapter

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.websarva.wings.android.book_management_tool.R

class RecyclerViewAdapter(
	private val iImages: ArrayList<Int>,
	private val iNames: ArrayList<String>
) :
	RecyclerView.Adapter<RecyclerViewAdapter.ViewHolder>() {

	// Provide a reference to the type of views
	// that you are using (custom ViewHolder).
	class ViewHolder(view: View) : RecyclerView.ViewHolder(view) {
		val textView: TextView
		val imageView: ImageView

		init {
			// Define click listener for the ViewHolder's View.
			textView = view.findViewById(R.id.text_view)
			imageView = view.findViewById(R.id.image_view)
		}
	}

	// Create new views (invoked by the layout manager)
	override fun onCreateViewHolder(viewGroup: ViewGroup, viewType: Int):
			ViewHolder {
		// Create a new view, which defines the UI of the list item
		val itemView = LayoutInflater.from(viewGroup.context)
			.inflate(R.layout.book_list_view, viewGroup, false)
		return ViewHolder(itemView)
	}

	// Replace the contents of a view (invoked by the layout manager)
	override fun onBindViewHolder(viewHolder: ViewHolder, position: Int) {

		// Get element from your dataset at this position and replace the
		// contents of the view with that element
		viewHolder.imageView.setImageResource(iImages.get(position))
		viewHolder.textView.text = iNames[position]

	}

	// Return the size of your dataset (invoked by the layout manager)
	override fun getItemCount() = iNames.size

}