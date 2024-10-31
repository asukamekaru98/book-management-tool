package com.websarva.wings.android.book_management_tool.constants

data class bookManagementToolApiData(
	val responseCode: Int,              // レスポンスコード
	val isbn: String,                   // ISBN
	val title: String,                  // タイトル
	val subTitle: String,               // サブタイトル
	val author: String,                 // 著者
	val description: String,            // 説明
	val imageURL: String,                // 画像URL

)

