package com.websarva.wings.android.book_management_tool.api

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIHandler
import com.websarva.wings.android.book_management_tool.apiRequest.BmtApiRequestCreatorFactory
import com.websarva.wings.android.book_management_tool.apiResponseParser.bmtApiResponseParserBookShelf
import com.websarva.wings.android.book_management_tool.constants.BookInfo
import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator

class BmtApiGetAllBookShelf: AbstractAPIHandler() {

	override fun CreateRequest(): i_ApiRequestCreator {
		return BmtApiRequestCreatorFactory().APIRequestCreator_GetAllBookShelf()
	}

	override suspend fun SendRequest(request: i_ApiRequestCreator):ApiResponse{
		return ApiRequestSender().SendRequest(request)
	}

	override fun ParseResponse(response: ApiResponse) {
		bmtApiResponseParserBookShelf().parseResponse(response)
	}

	override fun GetResponseResult(): MutableList<BookInfo> {
		return ApiResponse(responseJSON,responseCode)
	}

}