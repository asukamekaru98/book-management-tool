package com.websarva.wings.android.book_management_tool.i_f

import com.websarva.wings.android.book_management_tool.api.ApiResponse

interface i_ApiResponseParser {
	fun parseResponse(apiResponse: ApiResponse)
}