package com.websarva.wings.android.book_management_tool.uri

import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiUri as URI

class UriFetcher {
	fun bmtAPIBookShelf(): String
	{
		return "${URI.API_URI}/${URI.API_VERSION}/${URI.API_FUNC_BOOK_SHELF}"
	}

	fun bmtAPIReadHistories(): String
	{
		return "${URI.API_URI}/${URI.API_VERSION}/${URI.API_FUNC_READ_HISTORIES}"
	}

	fun bmtAPIWishList(): String
	{
		return "${URI.API_URI}/${URI.API_VERSION}/${URI.API_FUNC_WISH_LIST}"
	}
}