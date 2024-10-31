<?php

const BOOK_VIEWED_FLAG_NOVIEWED	= '0';		// 未読
const BOOK_VIEWED_FLAG_VIEWED	= '1';		// 読了
const BOOK_VIEWED_FLAG_ALL		= '2';		// 全て

# URI
// 本棚
const URI_BOOK_SHELF = 'book-shelf';
// ほしいものリスト
const URI_WISH_LIST = 'wish-list';
// 読書履歴
const URI_READ_HIST = 'read-histories';

# Query
// ISBN
const URI_QUERY_ISBN = 'isbn';
const URI_QUERY_DATA_FORMAT = 'format';
const URI_QUERY_VIEWED_FLAG = 'viewed-flag';

# Query設定値
const URI_QUERY_DATA_FORMAT_JSON = 'json';
const URI_QUERY_DATA_FORMAT_XML = 'xml';


# Query初期値
const INIT_URI_QUERY_ISBN = '0000000000000';
const INIT_URI_QUERY_DATA_FORMAT = URI_QUERY_DATA_FORMAT_JSON;
const INIT_URI_QUERY_VIEWED_FLAG = BOOK_VIEWED_FLAG_ALL;

#