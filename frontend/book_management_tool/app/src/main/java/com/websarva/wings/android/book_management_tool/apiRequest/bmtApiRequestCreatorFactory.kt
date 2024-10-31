package com.websarva.wings.android.book_management_tool.apiRequest

import com.websarva.wings.android.book_management_tool.i_f.i_ApiRequestCreator

class BmtApiRequestCreatorFactory {

	// 本棚に本を追加する
	fun APIRequestCreator_AddOneBookShelf(): i_ApiRequestCreator {
		return BmtApiRequestCreatorAddOneBookShelf()
	}

	// 全ての本棚の情報を取得する
	fun APIRequestCreator_GetAllBookShelf(): i_ApiRequestCreator {
		return BmtApiRequestCreatorAddOneBookShelf()
	}
	/*
		// 一つの本棚の情報を取得する
		fun APIRequestCreator_GetOneBookShelf(): i_ApiRequestCreator {

		}

		// 一つの本の情報を修正する
		fun APIRequestCreator_UpdateOneBookShelf(): i_ApiRequestCreator {

		}

		// 本棚から本を削除する
		fun APIRequestCreator_DeleteOneBookShelf(): i_ApiRequestCreator {

		}

		// 読書履歴に本を追加する
		fun APIRequestCreator_AddOneReadHistory(): i_ApiRequestCreator {

		}

		// 全ての読書履歴を取得する
		fun APIRequestCreator_GetAllReadHistories(): i_ApiRequestCreator {

		}

		// 一つの読書履歴を取得する
		fun APIRequestCreator_GetOneReadHistory(): i_ApiRequestCreator {

		}

		// 読み終えた本の読書履歴を取得する
		fun APIRequestCreator_GetReadHistoryOfReadBooks(): i_ApiRequestCreator {

		}

		// 途中で読みかけの本の読書履歴を取得する
		fun APIRequestCreator_GetReadHistoryOfReadingBooks(): i_ApiRequestCreator {

		}

		// 読書履歴の情報を修正する
		fun APIRequestCreator_UpdateOneReadHistory(): i_ApiRequestCreator {

		}

		// 読書履歴から本を削除する
		fun APIRequestCreator_DeleteOneReadHistory(): i_ApiRequestCreator {

		}

		// すべての読書履歴を削除する
		fun APIRequestCreator_DeleteAllReadHistories(): i_ApiRequestCreator {

		}

		// ほしいものリストに本を追加する
		fun APIRequestCreator_AddOneWishList(): i_ApiRequestCreator {

		}

		// 全てのほしいものリストを取得する
		fun APIRequestCreator_GetAllWishList(): i_ApiRequestCreator {

		}

		// 一つのほしいものリストを取得する
		fun APIRequestCreator_GetOneWishList(): i_ApiRequestCreator {

		}

		// ほしいものリストの情報を修正する
		fun APIRequestCreator_UpdateOneWishList(): i_ApiRequestCreator {

		}

		// ほしいものリストから本を削除する
		fun APIRequestCreator_DeleteOneWishList(): i_ApiRequestCreator {

		}

	 */
}