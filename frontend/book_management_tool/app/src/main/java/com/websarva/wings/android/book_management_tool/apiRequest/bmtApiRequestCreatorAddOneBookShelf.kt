package com.websarva.wings.android.book_management_tool.apiRequest

import com.websarva.wings.android.book_management_tool.api.ApiUriCreator
import com.websarva.wings.android.book_management_tool.constants.method
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator

class BmtApiRequestCreatorAddOneBookShelf() : i_ApiRequestCreator {

	private var uri : String = ""
	private var requestBody : ArrayList<String> = ArrayList()


	override fun CreateRequest() {
		val uriCreator = ApiUriCreator("http://192.168.1.64/v1/book-shelf/")
		//uriCreator.SetQueryParameter("")
		uri = uriCreator.GetURI()
	}

	override fun GetMethod(): String {
		return method.GET
	}

	override fun GetURI(): String {
		return uri
	}

	override fun GetBody(): ArrayList<String> {
		return requestBody
	}
}