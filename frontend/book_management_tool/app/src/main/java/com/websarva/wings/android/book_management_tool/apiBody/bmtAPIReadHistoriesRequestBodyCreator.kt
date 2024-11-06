package com.websarva.wings.android.book_management_tool.apiBody

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIBodyCreator
import com.websarva.wings.android.book_management_tool.constants.BookManagementToolApiParameterName as API_PARAM
import java.util.Date

class BmtAPIReadHistoriesRequestBodyCreator(
	/* 必須 */
	private val industryImportant: String,
	private val workImportant: String,
	private val userImportant: String,
	private val priority: String,
	private val purchasedFlag: String,
	private val viewedFlag: String,
	/* 履歴 */
	private val viewStartDate: String,
	private val viewEndDate: String,
	private val impression: String,
	private val memo: String,
	private val understanding: String
) : AbstractAPIBodyCreator() {

	override fun get(): String {
		val body = mapOf(
			API_PARAM.DB_BOOKS_INDUSTRY_IMPORTANT       to industryImportant,
			API_PARAM.DB_BOOKS_WORK_IMPORTANT           to workImportant,
			API_PARAM.DB_BOOKS_USER_IMPORTANT           to userImportant,
			API_PARAM.DB_BOOKS_PRIORITY                 to priority,
			API_PARAM.DB_BOOKS_PURCHASED_FLAG           to purchasedFlag,
			API_PARAM.DB_BOOKS_VIEWED_FLAG              to viewedFlag,

			API_PARAM.DB_READ_HISTORIES_VIEW_START      to viewStartDate,
			API_PARAM.DB_READ_HISTORIES_VIEW_END        to viewEndDate,
			API_PARAM.DB_READ_HISTORIES_IMPRESSION      to impression,
			API_PARAM.DB_BOOKS_SHELF_MEMO               to memo,
			API_PARAM.DB_READ_HISTORIES_UNDERSTANDING   to understanding
		)
		return createBody(body)
	}

}