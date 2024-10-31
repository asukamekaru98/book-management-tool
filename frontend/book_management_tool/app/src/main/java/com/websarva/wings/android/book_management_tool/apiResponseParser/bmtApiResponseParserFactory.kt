package com.websarva.wings.android.book_management_tool.apiResponseParser

import com.websarva.wings.android.book_management_tool.api.ApiResponse
import com.websarva.wings.android.book_management_tool.i_f.i_ApiResponseParser

class BmtApiResponseParserFactory {

	/**
	 * 本棚のAPIレスポンスを解析
	 * @return i_ApiResponseParser
	 */
	fun ApiResponseParser_BookShelf(): i_ApiResponseParser {
		return BmtApiResponseParserBookShelf()
	}

	/**
	 * 読書履歴のAPIレスポンスを解析
	 * @return i_ApiResponseParser
	 */
	fun ApiResponseParser_ReadHistory(): i_ApiResponseParser {
		return BmtApiResponseParserReadHistory()
	}

	/**
	 * ほしいものリストのAPIレスポンスを解析
	 * @return i_ApiResponseParser
	 */
	fun ApiResponseParser_WishList(): i_ApiResponseParser {
		return BmtApiResponseParserWishList()
	}
}