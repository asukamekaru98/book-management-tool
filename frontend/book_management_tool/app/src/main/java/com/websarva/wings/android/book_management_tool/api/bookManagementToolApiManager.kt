package com.websarva.wings.android.book_management_tool.api

import com.websarva.wings.android.book_management_tool.abstruct.AbstractAPIHandler

class BookManagementToolAPIManager {


	/**
	 * 本棚に本を1冊追加する
	 * @return AbstractAPIHandler
	 */
	fun AddOneBookShelf()
	{

	}

	/**
	 * 本棚の情報を全て取得する
	 * @return AbstractAPIHandler
	 */
	fun GetAllBookShelf():ApiResponse
	{
		BmtApiGetAllBookShelf().Execute()
		return BmtApiGetAllBookShelf().GetResponseResult()
	}

	/**
	 * 本棚の情報を1つ取得する
	 * @return AbstractAPIHandler
	 */
	fun GetOneBookShelf(): AbstractAPIHandler
	{
		return BmtApiGetOneBookShelf()
	}

	/**
	 * 本棚の情報を1つ修正する
	 * @return AbstractAPIHandler
	 */
	fun UpdateOneBookShelf(): AbstractAPIHandler
	{
		return BmtApiUpdateOneBookShelf()
	}

	/**
	 * 本棚から本を1冊削除する
	 * @return AbstractAPIHandler
	 */
	fun DeleteOneBookShelf(): AbstractAPIHandler
	{
		return BmtApiDeleteOneBookShelf()
	}

	/**
	 * 読書履歴に本を1冊追加する
	 * @return AbstractAPIHandler
	 */
	fun AddOneReadHistory(): AbstractAPIHandler
	{
		return BmtApiAddOneReadHistory()
	}

	/**
	 * 読書履歴の情報を全て取得する
	 * @return AbstractAPIHandler
	 */
	fun GetAllReadHistories(): AbstractAPIHandler
	{
		return BmtApiGetAllReadHistories()
	}

	/**
	 * 読書履歴の情報を1つ取得する
	 * @return AbstractAPIHandler
	 */
	fun GetOneReadHistory(): AbstractAPIHandler
	{
		return BmtApiGetOneReadHistory()
	}

	/**
	 * 読み終えた本の読書履歴を取得する
	 * @return AbstractAPIHandler
	 */
	fun GetReadHistoryOfReadBooks(): AbstractAPIHandler
	{
		return BmtApiGetReadHistoryOfReadBooks()
	}

	/**
	 * 途中で読みかけの本の読書履歴を取得する
	 * @return AbstractAPIHandler
	 */
	fun GetReadHistoryOfReadingBooks(): AbstractAPIHandler
	{
		return BmtApiGetReadHistoryOfReadingBooks()
	}

	/**
	 * 読書履歴から本を1冊削除する
	 * @return AbstractAPIHandler
	 */
	fun DeleteOneReadHistory(): AbstractAPIHandler{
		return BmtApiDeleteOneReadHistory()
	}

	/**
	 * 読書履歴の情報を全て削除する
	 * @return AbstractAPIHandler
	 */
	fun DeleteAllReadHistories(): AbstractAPIHandler{
		return BmtApiDeleteAllReadHistories()
	}

	/**
	 * ほしいものリストに本を1冊追加する
	 * @return AbstractAPIHandler
	 */
	fun AddOneWishList(): AbstractAPIHandler{
		return BmtApiAddOneWishList()
	}

	/**
	 * ほしいものリストの情報を全て取得する
	 * @return AbstractAPIHandler
	 */
	fun GetAllWishLists(): AbstractAPIHandler{
		return BmtApiGetAllWishLists()
	}

	/**
	 * ほしいものリストの情報を1つ取得する
	 * @return AbstractAPIHandler
	 */
	fun GetOneWishList(): AbstractAPIHandler{
		return BmtApiGetOneWishList()
	}

	/**
	 * ほしいものリストの情報を1つ修正する
	 * @return AbstractAPIHandler
	 */
	fun UpdateOneWishList(): AbstractAPIHandler{
		return BmtApiUpdateOneWishList()
	}

	/**
	 * ほしいものリストから本を1冊削除する
	 * @return AbstractAPIHandler
	 */
	fun DeleteOneWishList(): AbstractAPIHandler{
		return BmtApiDeleteOneWishList()
	}

	/**
	 * ほしいものリストの情報を全て削除する
	 * @return AbstractAPIHandler
	 */
	fun DeleteAllWishLists(): AbstractAPIHandler{
		return BmtApiDeleteAllWishLists()
	}



}