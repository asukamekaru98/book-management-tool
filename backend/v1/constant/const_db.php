<?php

# 汎用エラー
const NO_PROB = 'NO_PROB'; // 問題なし
const ERR_COMM = 'ERR_COMM'; // エラー（汎用）
const ERR_DB_CONN = 'ERR_DB_CONN'; // データベース接続失敗
const ERR_DB_EXECUTION = 'ERR_DB_EXECUTE'; // データベース実行失敗

# error login
const ERR_LOGIN_NO_EXIST_USER = 'ERR_NO_EXIST_USER'; // ユーザ存在しない
const ERR_LOGIN_PW_MISSMATCH = 'ERR_PW_MISSMATCH'; // パスワード一致しない

# error create account
const ERR_CREATE_ACC_USER_NAME_DUPLICATE = 'ERR_USER_NAME_DUP'; // ユーザー名重複有り
const ERR_CREATE_ACC_NON_EXISTING_DEP = 'ERR_NO_EXIST_DEP'; // 部署存在しない

# error registration customers info
const ERR_REG_CUST_ID_DUPLICATE = 'ERR_CUSTOMER_ID_DUP'; // セットコード重複有り

# ツール権限
const TOOL_AUTH_ALL = 1; // 
const TOOL_AUTH_MANAGER = 2; // 
const TOOL_AUTH_EDITOR = 3; // 
const TOOL_AUTH_VIERER = 4; // 

/************************ データベース ************************/
# booksテーブル
const DB_BOOKS_TB_NAME				= 'books';
const DB_BOOKS_ISBN					= 'isbn';
const DB_BOOKS_TITLE				= 'title';
const DB_BOOKS_SUB_TITLE			= 'sub_title';
const DB_BOOKS_AUTHOR				= 'author';
const DB_BOOKS_DESCRIPTION			= 'description';
const DB_BOOKS_IMAGE_URL			= 'image_url';
const DB_BOOKS_PUBLISHED_DATE		= 'published_date';
const DB_BOOKS_CONTENT				= 'content';
const DB_BOOKS_INDUSTORY_IMPORTANT	= 'industry_important';
const DB_BOOKS_WORK_IMPORTANT		= 'work_important';
const DB_BOOKS_USER_IMPORTANT		= 'user_important';
const DB_BOOKS_PRIORITY				= 'priority';
const DB_BOOKS_PURCHASED_FLAG		= 'purchased_flag';
const DB_BOOKS_VIEWED_FLAG			= 'viewed_flag';
const DB_BOOKS_CREATE_TIME			= 'created_time';

# books_shelfテーブル
const DB_BOOKS_SHELF_TB_NAME		= 'books_shelf';
const DB_BOOKS_SHELF_ID				= 'book_id';
const DB_BOOKS_SHELF_ISBN			= 'isbn';
const DB_BOOKS_SHELF_PURCHASED		= 'purchased';
const DB_BOOKS_SHELF_MEMO			= 'memo';

# read_historiesテーブル
const DB_READ_HISTORIES_TB_NAME			= 'read_histories';
const DB_READ_HISTORIES_ID				= 'id';
const DB_READ_HISTORIES_ISBN			= 'isbn';
const DB_READ_HISTORIES_VIEW_START		= 'view_start';
const DB_READ_HISTORIES_VIEW_END		= 'view_end';
const DB_READ_HISTORIES_MEMO			= 'memo';
const DB_READ_HISTORIES_UNDERSTANDING	= 'understanding';

# wish_listsテーブル
const DB_WISH_LISTS_TB_NAME			= 'wish_lists';
const DB_WISH_LISTS_ID				= 'id';
const DB_WISH_LISTS_ISBN			= 'isbn';
const DB_WISH_LISTS_MEMO			= 'memo';
