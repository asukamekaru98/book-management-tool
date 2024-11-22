package com.websarva.wings.android.book_management_tool.apiBody

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIBodyCreator
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiParameterName as API_PARAM

class BmtAPIWishListRequestBodyCreator(
	/* 必須 */
	private val industryImportant: String,
	private val workImportant: String,
	private val userImportant: String,
	private val purchasedFlag: String,
	private val viewedFlag: String,
	/* ほしいものリスト */
	private val memo: String
) : AbstractAPIBodyCreator() {

	override fun get(): String {

		val body = mapOf(
			API_PARAM.API_PARAM_USER_INFO_INDUSTRY_IMPORTANT  to industryImportant,
			API_PARAM.API_PARAM_USER_INFO_WORK_IMPORTANT      to workImportant,
			API_PARAM.API_PARAM_USER_INFO_USER_IMPORTANT      to userImportant,
			API_PARAM.API_PARAM_USER_INFO_PURCHASED_FLAG      to purchasedFlag,
			API_PARAM.API_PARAM_USER_INFO_VIEWED_FLAG         to viewedFlag,

			API_PARAM.API_PARAM_WISH_LIST_MEMO           to memo
		)
		return createBody(body)
	}

}