package com.websarva.wings.android.book_management_tool.time

import android.icu.text.SimpleDateFormat
import java.lang.System.currentTimeMillis
import java.util.Date

class getCurrentTime(private val pattern: String) {
	fun GetTime(): String {
		val sdf = SimpleDateFormat(pattern)
		return sdf.format(Date(currentTimeMillis()))
	}
}