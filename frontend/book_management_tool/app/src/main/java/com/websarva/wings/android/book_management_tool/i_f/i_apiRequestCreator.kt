package com.websarva.wings.android.book_management_tool.i_f

interface i_ApiRequestCreator {

	fun CreateRequest()
	fun GetMethod(): String
	fun GetURI(): String
	fun GetBody(): ArrayList<String>
}